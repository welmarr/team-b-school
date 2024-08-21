<?php

namespace App\Http\Controllers\Unsecured\Api;

use App\Http\Controllers\Controller;
use App\Models\TTemporaryFile;
use Illuminate\Support\Facades\Storage;

class DeleteTemporaryImageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $temporaryImage = TTemporaryFile::where("folder", request()->getContent())->first();
        if ($temporaryImage) {
            Storage::deleteDirectory("requests/tmp/" .$temporaryImage->folder);
            $temporaryImage->delete();
        }

        return response()->noContent();
    }
}
