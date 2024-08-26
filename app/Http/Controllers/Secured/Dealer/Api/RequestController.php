<?php

namespace App\Http\Controllers\Secured\Dealer\Api;

use App\Models\TImage;
use App\Models\TRequest;
use App\Models\TAppointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class RequestController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request, int $user_id)
    {

        return DataTables::eloquent(TRequest::where('created_by_id', $user_id)->where('created_by_type', User::class)->with(['car.brand', 'car.model', 'createdBy'])->select())
            ->escapeColumns(['created_by_id'])
            ->toJson();
    }



    public function images(int $id)
    {
        $images = TImage::where('request_id', $id)->get();

        $data = [];
        foreach ($images as $image) {
            array_push($data, ['name' => $image->name, 'type' => $image->take_when, 'url' => route('secured.admin.file.download', ['public_uri' => $image->public_uri])]);
        }


        return response()->json(['data' => $data, 'msg' => ""], 200);
    }


    public function dashboardListAppointment(Request $request, $user_id)
    {
        try {
            // Validate the incoming request
            $request->validate([
                'year' => 'required|integer|min:1900|max:2100',
                'month' => 'required|integer|min:1|max:12',
            ]);


            // Fetch appointments for the given year and month
            $appointments = TAppointment::whereYear('appointment_date', $request->year)
                ->whereMonth('appointment_date', $request->month)
                ->where('is_current', true)
                ->whereHas('request', function ($query) use ($user_id) {
                    $query->where('created_by_id', $user_id)->where('created_by_type', User::class);
                })
                ->pluck('appointment_date');


            // Convert the dates to an array of strings in 'YYYY-MM-DD' format and remove duplicates
            $enabledDates = $appointments->map(function ($date) {
                return explode(" ", $date)[0];
            })->unique()->values(); // Remove duplicates and reset keys

            //dd($appointments, $enabledDates  );
            // Return the dates as a JSON response
            return response()->json(['data' => $enabledDates, 'msg' => "Enabled dates fetched successfully."], 200);
        } catch (\Exception $e) {

            // Return the current date if there's an error
            $currentDate = \Carbon\Carbon::now()->format('Y-m-d');
            return response()->json(['data' => [$currentDate], 'msg' => "An error occurred. Returning the current date."], 200);
        }
    }

    public function dashboardListRequest(Request $request, $user_id)
    {
        try {
            // Validate the incoming request
            $request->validate([
                'date' => 'required|date',
            ]);


            $date = $request->date;

            $demands = TRequest::with(['car.brand', 'car.model'])
                ->whereHas('appointments', function ($query) use ($date) {
                    $query->whereDate('appointment_date', $date)
                        ->where('is_current', true);
                })->whereHas('request', function ($query) use ($user_id) {
                    $query->where('created_by_id', $user_id)->where('created_by_type', User::class);
                })
                ->get(['estimation', 'reference', 'car_id']); // Select only specific fields from TRequest

            // Transform the data to include car brand, model, and year
            $demands = $demands->map(function ($demand) {
                return [
                    'estimation' => $demand->estimation,
                    'reference'  => $demand->reference,
                    'car_id'     => $demand->car_id,
                    'car_brand'  => optional($demand->car->brand)->name,
                    'car_model'  => optional($demand->car->model)->name,
                    'car_year'   => $demand->car->year,
                ];
            });


            return response()->json(['data' => $demands->values(), 'msg' => "Enabled dates fetched successfully."], 200);
        } catch (\Exception $e) {
            //dd($e->getMessage());
            // Log the error for debugging

            return response()->json(['data' => [], 'msg' => "An error occurred. Returning the current date."], 200);
        }
    }
}
