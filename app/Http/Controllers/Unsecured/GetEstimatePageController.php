<?php

namespace App\Http\Controllers\Unsecured;

use Carbon\Carbon;
use App\Models\TCar;
use App\Models\TImage;
use App\Models\TClient;
use App\Models\TAddress;
use App\Models\TCarBrand;
use Illuminate\Support\Str;
use App\Models\TTemporaryFile;
use App\Mail\EstimationCreateMail;
use App\Models\TRequest as TDemand;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Unsecured\StoreDemandRequest;

/**
 * Class GetEstimatePageController
 *
 * @package App\Http\Controllers\Unsecured
 */
class GetEstimatePageController extends Controller
{
    /**
     * Display the get estimate view.
     *
     * @return \Illuminate\View\View
     */
    public function view()
    {
        $brands = TCarBrand::all();
        $years = TCar::select('year')->distinct()->orderBy('year', 'desc')->get()->pluck('year');
        $states = USA_states();
        $activeMenu = 'get-estimate';
        return view('unsecured.pages.get-estimate', compact('brands', 'years', 'activeMenu', 'states'));
    }

    /**
     * Create a new estimate request.
     *
     * @param StoreDemandRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(StoreDemandRequest $request)
    {
        $validated = $request->validated();
        $demand = null;
        $address = null;
        $client = null;
        $files = [];

        try {
            $car = TCar::where([
                'year' => $validated['year'],
                'make_id' => $validated['brand'],
                'model_id' => $validated['model']
            ])->first();

            if ($car == null) {
                return redirect()->back()->with('error', 'Oups! Something wrong with the car information.');
            }

            $address = TAddress::create([
                'address_line_1' => $validated['address1'],
                'address_line_2' => $validated['address2'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'zip' => $validated['zipcode'],
            ]);

            $client = TClient::create([
                'first_name' => $validated['firstname'],
                'last_name' => $validated['lastname'],
                'email' => $validated['email'],
                'phone' => $validated['phonenumber'],
                'address_id' => $address->id,
            ]);

            $demand = TDemand::create([
                'memo' => $validated['memo'],
                'reference' => Carbon::now()->format('md') . Str::random(rand(3, 5)),
                'car_id' => $car->id,
                'created_by_id' => $client->id,
                'created_by_type' => TClient::class
            ]);

            $tmp_images = null;

            if ($request->has('filepond') && count($request->filepond) > 0) {
                $tmp_images = TTemporaryFile::whereIn('folder', $request->input('filepond'))->get();
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

                    array_push($files, $file);

                    Storage::deleteDirectory($temp_folder);
                    $image->delete();
                }
            }
            Mail::to($client->email)->queue(new EstimationCreateMail($demand));


            return redirect()->back()->with('success', 'Demand created successfully!');
        } catch (\Exception $e) {


            if ($address) {
                $address->forceDelete();
            }

            if ($client) {
                $client->forceDelete();
            }

            if ($demand) {
                TImage::where('request_id', $demand->id)->forceDelete();
                $demand->forceDelete();
            }

            if ($request->has('filepond') && count($request->filepond) > 0) {
                $tmp_images = TTemporaryFile::whereIn('folder', $request->input('filepond'))->get();
                if ($tmp_images) {
                    foreach ($tmp_images as $image) {
                        $temp_folder = 'requests' . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR . $image->folder;
                        Storage::deleteDirectory($temp_folder);
                        $image->delete();
                    }
                }
            }

            return redirect()->back()->withInput()->with('error', 'Failed to create demand: ' . $e->getMessage());
        }
    }
}
