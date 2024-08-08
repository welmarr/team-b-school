<?php

namespace App\Http\Controllers\Secured\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Secured\StoreAdminRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('secured.pages.admin.users', ['activeMenu' => 'users']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeApi(StoreAdminRequest $request)
    {

        $validated = $request->validated();
        try {
            // Create and return a new user
            $user = User::create([
                'email' => $validated['email'],
                'password' => bcrypt(Str::random(50)),
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'phone' => $validated['phone'],
                'role' => 'admin',
            ]);

            return response()->json(['data' => $user, 'msg' => $validated['first_name'].' '.$validated['last_name'].' admin account created.'], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => null, 'msg' => 'There was an error processing your request. '.$e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function enableDisableApi(User $user)
    {
        $user_status = $user->is_active;

        $user->update(['is_active' => ! $user_status]);

        return response()->json(['data' => $user]);
    }

    /**
     * Display a listing of the resource.
     */
    public function indexDataTableApi(Request $request)
    {
        return DataTables::eloquent(User::select())
            ->escapeColumns(['password'])
            ->toJson();
    }
}
