<?php

namespace App\Http\Controllers\Secured\Admin;

use App\Http\Controllers\Controller;
use App\Models\TRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('secured.pages.admin.users', ['activeMenu' => 'users']);
    }

    /**
     * Display the details of a specific user.
     *
     * @param int $id The ID of the user to display
     * @return \Illuminate\View\View
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function show(int $id)
    {
        $activeMenu = 'users';
        $user = User::findOrFail($id);
        $requestInitialized = TRequest::where('created_by_type', User::class)->where('created_by_id', $id)->where('status', 'init')->count();
        $requestEstimated = TRequest::where('created_by_type', User::class)->where('created_by_id', $id)->where('status', 'estimated')->count();
        $requestAccepted = TRequest::where('created_by_type', User::class)->where('created_by_id', $id)->where('status', 'accepted')->count();
        $requestProgress = TRequest::where('created_by_type', User::class)->where('created_by_id', $id)->where('status', 'in_progress')->count();
        $requestCompleted = TRequest::where('created_by_type', User::class)->where('created_by_id', $id)->where('status', 'completed')->count();
        $requestCanceled = TRequest::where('created_by_type', User::class)->where('created_by_id', $id)->where('status', 'canceled')->count();
        return view('secured.pages.admin.users-details', compact(['activeMenu', 'user', 'requestInitialized', 'requestEstimated', 'requestAccepted', 'requestProgress', 'requestCompleted', 'requestCanceled']));
    }
}
