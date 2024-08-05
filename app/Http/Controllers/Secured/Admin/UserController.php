<?php

namespace App\Http\Controllers\Secured\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Secured\StoreUserRequest;
use App\Http\Requests\Secured\UpdateUserRequest;

class UserController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function enableDisable(User $user)
    {
        $user_status = $user->is_active;

        $user->update(["is_active"=> !$user_status]);

        return response()->json(["data"=> $user]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('secured.pages.admin.users',  ['activeMenu' => 'users']);
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
