<?php

namespace App\Http\Controllers\Unsecured;

use App\Http\Controllers\Controller;
use App\Models\TAppointment;
use App\Models\TRequest;
use Illuminate\Http\Request;

class TrackRepairPageController extends Controller
{


    public function __invoke(Request $request)
    {
        try {
            $activeMenu = 'track-repair';
            $reference = $request->reference;
            $demand = TRequest::where('reference', $request->reference)->first();
            $error = $demand ? null : "No request associated with the reference '{$request->reference}' was found in our database.";
            $appointment = $demand ? TAppointment::where('request_id', $demand->id)->where('is_current', true)->first() : null;

            return view('unsecured.pages.track-repair', compact(['activeMenu', 'demand', 'reference', 'error', 'appointment']));
        } catch (\Exception $e) {
            $error_500 =  'Failed to create demand: ' . $e->getMessage();
            return view('unsecured.pages.track-repair', compact(['activeMenu', 'error_500']));
        }
    }
}
