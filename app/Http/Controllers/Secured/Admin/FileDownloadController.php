<?php

namespace App\Http\Controllers\Secured\Admin;

use App\Models\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FileDownloadController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($public_uri)
    {
         // Find the file by its public_uri

         //dd()
         $file = File::where('public_uri', $public_uri)->firstOrFail();

         // Get the file path from the storage
         $filePath = $file->path; // Assuming you have a 'path' field in your File model

         // Check if the file exists in storage
         if (!Storage::exists($filePath)) {
             return response()->json(['error' => 'File not found.'], 404);
         }

         // Return the file as a download response
         return Storage::download($filePath, $file->name);

    }
}
