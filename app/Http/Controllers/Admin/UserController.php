<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::whereNot('id', auth()->user()->id)->latest()->get(),
        ]);
    }

    public function sellers()
    {
        return view('admin.users.sellers', [
            'users' => User::whereNot('id', auth()->user()->id)->where('role', 'seller')->latest()->get(),
        ]);
    }

    public function buyers()
    {
        return view('admin.users.buyers', [
            'users' => User::whereNot('id', auth()->user()->id)->where('role', 'buyer')->latest()->get(),
        ]);
    }

    public function admins()
    {
        return view('admin.users.admins', [
            'users' => User::whereNot('id', auth()->user()->id)->where('role', 'admin')->latest()->get(),
        ]);
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
    public function store(Request $request)
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
    public function update(Request $request, User $user)
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
