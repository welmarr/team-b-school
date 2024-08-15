<?php

namespace App\Http\Controllers\Unsecured;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Unsecured\TrackRepairRequest; // Correct the class name if necessary
use App\Models\TRequest;
use App\Models\TClient;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class TrackRepairController extends Controller
{
    public function submit(TrackRepairRequest $request)
    {
        $reference = $request->input('reference');

        try {
            $repairRequest = TRequest::where('reference', $reference)->firstOrFail();
            $client = TClient::findOrFail($repairRequest->created_by_id);

            Mail::send('emails.track-repair-notification', ['repairRequest' => $repairRequest], function($message) use ($client) {
                $message->to($client->email)
                        ->subject('Repair Request Update');
            });
            dd($client->email);

            return redirect()->back()->with('success', 'Email sent successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->withErrors('Repair request or client not found.');

        } catch (\Exception $e) {
            Log::error('Failed to send repair request update: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors('Failed to send repair request update: ' . $e->getMessage());
        }
    }
}
