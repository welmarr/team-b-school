<?php

namespace App\Http\Controllers\Secured;

use App\Models\User;
use App\Http\Requests\Secured\StoreUserProfileRequest;
use App\Http\Requests\Secured\UpdateUserProfileRequest;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{


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
    public function update(UpdateUserProfileRequest $request, User $user)
    {
        //
    }
}
