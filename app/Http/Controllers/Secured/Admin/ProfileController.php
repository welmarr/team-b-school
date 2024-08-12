<?php

namespace App\Http\Controllers\Secured\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Secured\UpdateUserProfileRequest;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function index()
    {
        $activeMenu = 'profile';
        $user = Auth::user();
        return view('secured.pages.admin.profile', compact(['user', 'activeMenu']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserProfileRequest $request)
    {

    }
}
