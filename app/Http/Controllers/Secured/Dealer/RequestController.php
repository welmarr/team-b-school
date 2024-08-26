<?php

namespace App\Http\Controllers\Secured\Dealer;


use Carbon\Carbon;
use App\Models\TCar;
use App\Models\User;
use App\Models\TImage;
use App\Models\TCarBrand;
use Illuminate\Support\Str;
use App\Models\TAppointment;
use Illuminate\Http\Request;
use App\Models\TTemporaryFile;
use App\Models\TRequestHistory;
use App\Models\TRequest as Demand;
use App\Http\Controllers\Controller;
use App\Mail\EstimationAcceptedMail;
use App\Mail\EstimationCanceledMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Secured\AppointmentRequest;
use App\Http\Requests\Secured\StoreDemandRequest;
use App\Http\Requests\Secured\UpdateDemandRequest;
use App\Mail\EstimationAppointmentBySimpleUserMail;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('secured.pages.dealer.requests',  ['activeMenu' => 'requests']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()

    {

        $brands = TCarBrand::all();
        $years = TCar::select('year')->distinct()->orderBy('year', 'desc')->get()->pluck('year');
        $states = USA_states();
        $activeMenu = 'requests';
        return view('secured.pages.dealer.request-create',   compact('brands', 'years', 'activeMenu', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDemandRequest $request)
    {


        $validated = $request->validated();
        $demands = [];
        $files = [];
        $carInfos = $validated['cars'];
        try {
            foreach ($carInfos as $info) {
                $demand = null;
                $car = TCar::where([
                    'year' => $info['year'],
                    'make_id' => $info['brand'],
                    'model_id' => $info['model']
                ])->first();

                $reqGroup = requestGroupCode(rand(3, 5)) . Auth::user()->id;
                $demand = Demand::create([
                    'memo' => $info['memo'],
                    'reference' => Carbon::now()->format('md') . Str::random(rand(3, 5)),
                    'request_group' => $reqGroup,
                    'car_id' => $car->id,
                    'created_by_id' => Auth::user()->id,
                    'created_by_type' => User::class
                ]);

                array_push($demands, $demand);
                $images = [];

                $tmp_images = null;

                if (isset($info['filepond']) && count($info['filepond']) > 0) {
                    $tmp_images = TTemporaryFile::whereIn('folder', $info['filepond'])->get();
                }
                if ($demand && $tmp_images) {


                    foreach ($tmp_images as $image) {
                        $temp_folder = 'requests' . DIRECTORY_SEPARATOR  . 'tmp' . DIRECTORY_SEPARATOR  . $image->folder;
                        $destination_folder = 'requests' . DIRECTORY_SEPARATOR  . $image->folder;
                        $filename = $demand->id . '-' . time() . '-' . $image->file;

                        Storage::copy($temp_folder . DIRECTORY_SEPARATOR  . $image->file, $destination_folder . DIRECTORY_SEPARATOR  . $filename);

                        $file = TImage::create([
                            'name' => $filename,
                            'path' => Storage::disk("public")->path($destination_folder . DIRECTORY_SEPARATOR  . $filename),
                            'mime_type' => Storage::disk("public")->mimeType($destination_folder . DIRECTORY_SEPARATOR  . $filename),
                            'size' => Storage::disk("public")->size($destination_folder . DIRECTORY_SEPARATOR  . $filename),
                            'extension' => pathinfo(DIRECTORY_SEPARATOR . "public" . $destination_folder . DIRECTORY_SEPARATOR  . $filename, PATHINFO_EXTENSION),
                            'folder' => $destination_folder,
                            'public_uri' => (string) Str::uuid(),
                            'request_id' => $demand->id
                        ]);

                        array_push($images, $file);

                        Storage::deleteDirectory($temp_folder);
                        $image->delete();
                    }

                    $files[$demand->id] = $images;
                }
            }

            return redirect()->back()->with('success', 'Demand created successfully!');
        } catch (\Exception $e) {

            foreach ($demands as $demand) {
                if ($demand) {
                    TImage::where('request_id', $demand->id)->forceDelete();
                    $demand->forceDelete();
                }
            }


            foreach ($carInfos as $info) {
                if (isset($info['filepond']) && count($info['filepond']) > 0) {
                    $tmp_images = TTemporaryFile::whereIn('folder', $info['filepond'])->get();
                    if ($tmp_images) {
                        foreach ($tmp_images as $image) {
                            $temp_folder = 'requests' . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR . $image->folder;
                            Storage::deleteDirectory($temp_folder);
                            $image->delete();
                        }
                    }
                }
            }


            return redirect()->back()->withInput()->with('error', 'Failed to create demand: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {

        $activeMenu = "requests";
        $demand = Demand::where('id', $id)->with(['car.brand', 'car.model', 'createdBy'])->first();
        $files = TImage::where('request_id', $id)->get();

        $appointment = $demand ? TAppointment::where('request_id', $demand->id)->where('is_current', true)->first() : null;
        return view('secured.pages.dealer.request-treatment', compact("demand", "activeMenu", "files", "appointment"));
    }

    public function cancel(Request $request,  int $id)
    {
        try {
            $demand = Demand::where('id', $id)->first();

            if ($demand->status == "init") {

                $demand->update([
                    'status' => 'canceled'
                ]);

                TRequestHistory::create([
                    'status' => $demand->status,
                    'request_id' => $demand->id,
                    'data' => json_encode([
                        'status' => $demand->status,
                    ])
                ]);

                Mail::to($demand->createdBy->email)->queue(new EstimationCanceledMail($demand));

                return redirect()->back()->with('success_cancel', "The request " . $demand->reference . " un the group request " . $demand->request_group . " is already canceled");
            } else {
                return redirect()->back()->with('error_cancel', 'The request estimation need to be accept and one appointment need to be take by the client.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error_cancel', 'There was an error processing your request. ' . $e->getMessage());
        }
    }
    public function appointment(AppointmentRequest $request, int $id)
    {

        try {
            $demand = Demand::where('id', $id)->first();

            if ($demand->status == "accepted") {

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


                Mail::to($demand->createdBy->email)->queue(new EstimationAppointmentBySimpleUserMail($demand, $appointment_datetime));

                return redirect()->back()->with('success_appointment', 'Appointment saved.');
            } else {
                return redirect()->back()->with('error_appointment', 'The appointment stage has already been finalized.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error_appointment', 'There was an error processing your request. ' . $e->getMessage());
        }
    }

    public function accept(Request $request,  int $id)
    {


        try {
            $demand = Demand::where('id', $id)->first();

            if ($demand->status == "estimated") {

                $demand->update([
                    'status' => 'accepted'
                ]);

                TRequestHistory::create([
                    'status' => $demand->status,
                    'request_id' => $demand->id,
                    'data' => json_encode([
                        'status' => $demand->status,
                    ])
                ]);

                Mail::to($demand->createdBy->email)->queue(new EstimationAcceptedMail($demand));

                return redirect()->back()->with('success_accept', "The request " . $demand->reference . " un the group request " . $demand->request_group . " is already canceled");
            } else {
                return redirect()->back()->with('error_accept', 'The request need to be estimated.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error_accept', 'There was an error processing your request. ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Demand $demand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDemandRequest $request, Demand $demand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Demand $demand)
    {
        //
    }
}
