<?php

namespace App\Http\Controllers\Unsecured;

use Carbon\Carbon;
use App\Models\User;
use App\Http\Controllers\Controller;

class ValidateEmailController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id, $hash)
    {
        if (isset($id) && isset($hash)) {
            $user = User::where("id", $id)->first();

            if (hash_equals(sha1($user->id . $user->email . $user->created_at), (string) $hash)) {
                if ($user->role == 'admin') {
                    $user->update(['email_verified_at' => Carbon::now(), 'is_active' => 1,]);
                } else {
                    $user->update(['email_verified_at' => Carbon::now(), 'is_active' => 1]);
                }
                return redirect()->route("login")->with("success", "Your email is verified. You can login.");
            }
        }
        return redirect()->route("login")->with("error", "Sorry, this token is invalid. Contact us if the issue repeat.");
    }
}
