<?php

namespace App\Http\Controllers\Secured\Admin\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\AccountActivateMail;
use App\Mail\AccountDeactivateMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountCreationByAdminMail;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Secured\StoreAdminRequest;

/**
 * Controller for managing User-related API operations.
 */
class UserController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $headerKey = \md5('key');
        if($request->hasHeader($headerKey) && $request->header($headerKey) != null){
            return DataTables::eloquent(User::where('id', '<>', $request->header($headerKey)))
            ->escapeColumns(['password'])
            ->toJson();
        }

        return DataTables::eloquent(User::select())
            ->escapeColumns(['password'])
            ->toJson();
    }

    /**
     * Store a newly created admin user in storage.
     *
     * @param  \App\Http\Requests\Secured\StoreAdminRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreAdminRequest $request)
    {
        $validated = $request->validated();
        $user = null;

        try {
            $generated_password = Str::random(rand(8, 15));
            // Create a new admin user
            $user = User::create([
                'email' => $validated['email'],
                'password' => bcrypt($generated_password),
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'phone' => $validated['phone'],
                'role' => 'admin',
                'is_active' => 0,
            ]);

            // Queue email notification
            Mail::to($user->email)->queue(new AccountCreationByAdminMail($user, $generated_password));

            return response()->json([
                'data' => $user,
                'msg' => "{$validated['first_name']} {$validated['last_name']} admin account created."
            ], 200);
        } catch (\Exception $e) {
            // Delete the user if creation failed
            if (isset($user)) {
                $user->forceDelete();
            }
            return response()->json([
                'data' => null,
                'msg' => 'There was an error processing your request. ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle the active status of a specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleStatus(User $user)
    {
        $new_status = !$user->is_active;
        $user->update(['is_active' => $new_status]);

        if($new_status){
            Mail::to($user->email)->queue(new AccountActivateMail($user));

        }else{
            Mail::to($user->email)->queue(new AccountDeactivateMail($user));
        }



        return response()->json(['data' => $user]);
    }
}
