<?php

namespace App\Http\Controllers\Unsecured;

use App\Models\TRequest;
use App\Models\TAppointment;
use Illuminate\Http\Request;
use App\Models\TRequestHistory;
use App\Http\Controllers\Controller;
use App\Mail\EstimationAcceptedMail;
use App\Mail\EstimationCanceledMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\EstimationAppointmentBySimpleUserMail;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function accepted(string $reference)
    {
        $demand = TRequest::where('reference', $reference)->first();

        if (isset($demand) && $demand->status == "estimated") {
            $demand->update([
                'status' => 'accepted'
            ]);

            TRequestHistory::create([
                'status' => $demand->status,
                'request_id' => $demand->id,
                'data' => json_encode([
                    'status' => 'accepted'
                ])
            ]);

            Mail::to($demand->createdBy->email)->queue(new EstimationAcceptedMail($demand));

            return view('unsecured.pages.accepted-request', compact(["reference"]));
        } else {
            return redirect()->route('track-repair.view')->with('error', 'The estimation stage has already been finalized. Please, check the updated status by using this form and contact us if need.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function canceled(string $reference)
    {

        $demand = TRequest::where('reference', $reference)->first();

        if ($demand->status == "estimated") {
            $demand->update([
                'status' => 'canceled'
            ]);

            TRequestHistory::create([
                'status' => $demand->status,
                'request_id' => $demand->id,
                'data' => json_encode([
                    'status' => 'canceled'
                ])
            ]);

            Mail::to($demand->createdBy->email)->queue(new EstimationCanceledMail($demand));

            return view('unsecured.pages.canceled-request');
        } else {
            return redirect()->route('track-repair.view')->with('error', 'The estimation stage has already been finalized. Please, check the updated status by using this form and contact us if need.');
        }
    }



    /**
     * Show the form for creating a new resource.
     */
    public function appointment(Request $request, string $reference)
    {


        $validator = Validator::make($request->all(), [
            'appointment_date' => ['required', 'date', 'after:today'],
            'appointment_time' => ['required', 'regex:/^(?:[01]?[0-9]|2[0-3]):[0-5][0-9]$/'], // 24-hour format validation
        ], [
            'appointment_date.required' => 'Please select an appointment date.',
            'appointment_date.date' => 'The appointment date must be a valid date.',
            'appointment_date.after' => 'The appointment date must be a future date.',
            'appointment_time.required' => 'Please select an appointment time.',
            'appointment_time.regex' => 'The appointment time must be in a valid 24-hour format (e.g., 15:00).',
        ]);

        if ($validator->fails()) {
            $error_msg_array = $validator->errors()->messages();
            return redirect()->back()
                ->with('appointment_error', reset($error_msg_array)[0]);
        }

        $demand = TRequest::where('reference', $reference)->first();

        if ($demand->status == "accepted") {
            TAppointment::where('request_id', $demand->id)->update(['is_current' => false]);
            // Combine the date and time into a datetime string
            $datetime_string = $request->input('appointment_date') . ' ' . $request->input('appointment_time');

            // Format the DateTime object for database storage (Y-m-d H:i:s)
            $appointment_datetime = (new \DateTime($datetime_string))->format('Y-m-d H:i:s');

            $appointment = TAppointment::create(['appointment_date' => $appointment_datetime, 'request_id' => $demand->id]);

            TRequestHistory::create([
                'status' => $demand->status,
                'request_id' => $demand->id,
                'data' => json_encode([
                    'status' => '_appointment',
                    'related_to' => TAppointment::class,
                    'related_to_id' => $appointment->id,
                ])
            ]);

            Mail::to($demand->createdBy->email)->queue(new EstimationAppointmentBySimpleUserMail($demand, $appointment_datetime));

            return redirect()->route('track-repair.view', ['request' => $reference]);
        } else {
            return redirect()->route('track-repair.view', ['request' => $reference])->with('appointment_error', 'The estimation stage has already been finalized. Please, check the updated status by using this form and contact us if need.');
        }
    }
}
