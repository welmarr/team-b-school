<?php

namespace App\Http\Controllers\Secured\Admin;

use App\Http\Controllers\Controller;
use App\Models\TImage;

/**
 * Class DownloadImageController
 *
 * @package App\Http\Controllers\Secured\Admin
 */
class DownloadImageController extends Controller
{
    /**
     * Handle the incoming request to download an image.
     *
     * @param string $public_uri The public URI of the image to download.
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|\Illuminate\Http\Response
     */
    public function __invoke($public_uri)
    {

        // Find the image by its public URI
        $image = TImage::where('public_uri', $public_uri)->first();

        if (isset($image)) {
            $filePath = $image->path;

            // Check if the file exists and return it for download
            if (file_exists($filePath)) {
                return response()->download($filePath);
            }
        }

        // If the image is not found or the file doesn't exist, return a 404 error
        abort(404, 'File not found.');
    }
}
