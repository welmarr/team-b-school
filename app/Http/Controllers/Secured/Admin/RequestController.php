<?php

namespace App\Http\Controllers\Secured\Admin;


use App\Models\TImage;
use App\Models\TRequest;
use App\Models\TAppointment;
use Illuminate\Http\Request;
use App\Models\TRequestHistory;
use App\Mail\EstimationSubmitMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\EstimationCompletedMail;
use App\Models\TToolInventoryMovement;
use App\Mail\EstimationRequestStartWorkMail;
use App\Mail\EstimationAppointmentByAdminMail;
use App\Http\Requests\Secured\AppointmentRequest;
use App\Http\Requests\Secured\SubmitEstimationRequest;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('secured.pages.admin.requests',  ['activeMenu' => 'requests']);
    }


    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $activeMenu = "requests";
        $demand = TRequest::where('id', $id)->with(['car.brand', 'car.model', 'createdBy'])->first();
        $files = TImage::where('request_id', $id)->get();
        $inventories = TToolInventoryMovement::where('request_id', $id)->where('type', 'Used')->get();

        //dd($inventories);

        $appointment = $demand ? TAppointment::where('request_id', $demand->id)->where('is_current', true)->first() : null;
        return view('secured.pages.admin.request-treatment', compact("demand", "activeMenu", "files", "appointment", 'inventories'));
    }


    /**
     * Display the specified resource.
     */
    public function estimating(SubmitEstimationRequest $request, int $id)
    {
        try {

            $validated = $request->validated();

            $demand = TRequest::where('id', $id)->first();

            if ($demand->status == "init") {
                $demand->update([
                    'finish_by' => $validated['duration'],
                    'estimation' => $validated['budget'],
                    'status' => 'estimated'
                ]);

                TRequestHistory::create([
                    'status' => $demand->status,
                    'request_id' => $demand->id,
                    'data' => json_encode([
                        'finish_by' => $validated['duration'],
                        'estimation' => $validated['budget'],
                        'status' => 'estimated'
                    ])
                ]);

                Mail::to($demand->createdBy->email)->queue(new EstimationSubmitMail($demand));
            } elseif ($demand->status == "estimated") {
                Mail::to($demand->createdBy->email)->queue(new EstimationSubmitMail($demand));
            } else {
                return redirect()->back()->with('error', "The estimation stage has already been finalized.");
            }

            return redirect()->back()->with('success', "Estimation already submitted.");
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'There was an error processing your request. ' . $e->getMessage());
        }
    }

    public function appointment(AppointmentRequest $request, int $id)
    {


        try {
            $demand = TRequest::where('id', $id)->first();

            if ($demand->status == "accepted") {

                $last_appointment = TAppointment::where('request_id', $demand->id)->where('is_current', true)->first();

                TAppointment::where('request_id', $demand->id)->update(['is_current' => false]);

                $datetime_string = $request->input('appointment_date') . ' ' . $request->input('appointment_time');

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


                Mail::to($demand->createdBy->email)->queue(new EstimationAppointmentByAdminMail($demand, $appointment_datetime, $last_appointment ? $last_appointment->appointment_date : null));

                return redirect()->back()->with('success', 'Appointment added and email sent to the client.');
            } else {
                return redirect()->back()->with('error', 'The appointment stage has already been finalized.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'There was an error processing your request. ' . $e->getMessage());
        }
    }

    public function start(Request $request,  int $id)
    {


        try {
            $demand = TRequest::where('id', $id)->first();
            $error = "";

            if ($demand->status == "accepted") {

                $last_appointment = TAppointment::where('request_id', $demand->id)->where('is_current', true)->first();

                if ($last_appointment) {
                    $demand->update([
                        'status' => 'in_progress'
                    ]);

                    TRequestHistory::create([
                        'status' => $demand->status,
                        'request_id' => $demand->id,
                        'data' => json_encode([
                            'status' => $demand->status,
                        ])
                    ]);

                    Mail::to($demand->createdBy->email)->queue(new EstimationRequestStartWorkMail($demand));

                    return redirect()->back();
                } else {
                    $error = 'Please, reach out the client to take appointment.';
                }
            } else {
                $error = 'The request estimation need to be accept and one appointment need to be take by the client.';
            }

            return redirect()->back()->with('error_start', $error);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error_start', 'There was an error processing your request. ' . $e->getMessage());
        }
    }

    public function complete(Request $request,  int $id)
    {


        try {
            $demand = TRequest::where('id', $id)->first();
            $error = "";

            if ($demand->status == "in_progress") {
                $demand->update([
                    'status' => 'completed'
                ]);

                TRequestHistory::create([
                    'status' => $demand->status,
                    'request_id' => $demand->id,
                    'data' => json_encode([
                        'status' => $demand->status,
                    ])
                ]);

                Mail::to($demand->createdBy->email)->queue(new EstimationCompletedMail($demand));

                return redirect()->back();
            } else {
                $error = 'The request need to pass to in progress before completed.';
            }

            return redirect()->back()->with('error_completed', $error);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withInput()->with('error_completed', 'There was an error processing your request. ' . $e->getMessage());
        }
    }
}
