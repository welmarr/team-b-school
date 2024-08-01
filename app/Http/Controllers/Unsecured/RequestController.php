<?php

namespace App\Http\Controllers\Unsecured;

use Carbon\Carbon;
use App\Models\File;
use Illuminate\Support\Str;
use App\Models\TemporaryFile;
use App\Models\Request as Demand;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Unsecured\StoreDemandRequest;

class RequestController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreDemandRequest $request)
    {

        $validated = $request->validated();
        $demand = null;
        $files = [];

        //dd($validated['year'], $validated['brand'], $validated['model'], $validated['memo'], $validated);

        try {
            $demand = Demand::create([
                'first_name' => $validated['firstname'],
                'last_name' => $validated['lastname'],
                'email' => $validated['email'],
                'phone' => $validated['phonenumber'],
                'memo' => $validated['memo'],
                'address_line_1' => $validated['address1'],
                'address_line_2' => $validated['address2'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'reference' => Carbon::now()->format('md') . Str::random(rand(3,5)),
                'zip' => $validated['zipcode'],
                'year' => $validated['year'],
                'make_id' => $validated['brand'],
                'model_id' => $validated['model'],
            ]);


            $tmp_images = null;

            if ($request->has('filepond') && count($request->filepond) > 0) {
                $tmp_images = TemporaryFile::whereIn('folder', $request->input('filepond'))->get();
            }
            if ($demand && $tmp_images) {
                foreach ($tmp_images as $image) {
                    $temp_folder = 'requests/tmp/' . $image->folder;
                    $destination_folder = 'requests/' . $image->folder;
                    $filename = $demand->id . '-' . time() . '-' . $image->file;

                    Storage::copy($temp_folder . '/' . $image->file, $destination_folder . '/' . $filename);

                    $file = File::create([
                        'name' => $filename,
                        'path' => Storage::disk("public")->path($destination_folder . '/' . $filename),
                        'mime_type' => Storage::disk("public")->mimeType($destination_folder . '/' . $filename),
                        'size' => Storage::disk("public")->size($destination_folder . '/' . $filename),
                        'extension' => pathinfo("/public" . $destination_folder . '/' . $filename, PATHINFO_EXTENSION),
                        'folder' => $destination_folder,
                        'public_uri' => (string) Str::uuid(),
                        'morph_type' => Demand::class,
                        'morph_id' => $demand->id
                    ]);

                    array_push($files, $file);

                    Storage::deleteDirectory($temp_folder);
                    $image->delete();
                }
            }
            return redirect()->back()->with('success', 'Demand created successfully!');
        } catch (\Exception $e) {

            if ($demand) {
                $demand->forceDelete();
                File::where('morph_id', $demand->id)->where('morph_type', Demand::class)->forceDelete();
            }

            if ($request->has('filepond') && count($request->filepond) > 0) {
                $tmp_images = TemporaryFile::whereIn('folder', $request->input('filepond'))->get();
                if ($tmp_images) {
                    foreach ($tmp_images as $image) {
                        $temp_folder = 'requests/tmp/' . $image->folder;
                        Storage::deleteDirectory($temp_folder);
                        $image->delete();
                    }
                }
            }

            return redirect()->back()->withInput()->with('error', 'Failed to create demand: ' . $e->getMessage());
        }
    }
}
