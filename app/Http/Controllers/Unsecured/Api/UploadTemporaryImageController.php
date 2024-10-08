<?php

namespace App\Http\Controllers\Unsecured\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TTemporaryFile;

class UploadTemporaryImageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $image = null;
        if ($request->hasFile("filepond") && count($request->file("filepond")) > 0) {
            $image = $request->file("filepond")[0];
        } elseif (isset($request->cars) && count($request->cars) > 0) {

            $cars = $request->all()['cars'];
            $firstCar = reset($cars);


            if (isset($firstCar['filepond']) && count($firstCar['filepond']) > 0) {
                $image = $firstCar['filepond'][0];
            }
        }


        if ($image) {
            $filename = $image->getClientOriginalName();
            $folder = uniqid("image-", true);

            $image->storeAs("requests/tmp/" . $folder, $filename);

            TTemporaryFile::create(['folder' => $folder, 'file' => $filename]);

            return $folder;
        }
        return 'Empty';
    }
}
