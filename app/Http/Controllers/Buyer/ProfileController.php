<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\BuyerProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.buyers.index', [
            'users' => User::whereNot('id', auth()->user()->id)
                ->where('role', 'buyer')
                ->with('buyerProfile')
                ->latest()
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.buyers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'preferred_animal_type' => 'nullable|string|in:cattle,sheep,goat,poultry,other',
            'shipping_address' => 'required|string',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'buyer',
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
        ]);

        $user->assignRole('buyer');
        // Handle profile image
        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $profileImagePath;
            $user->save();
        }

        // Create buyer profile
        BuyerProfile::create([
            'user_id' => $user->id,
            'creater_id' => auth()->id(),
            'preferred_animal_type' => $request->preferred_animal_type,
            'shipping_address' => $request->shipping_address,
        ]);

        return redirect()->route('buyers.index')->with('success', 'Buyer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BuyerProfile $buyerProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BuyerProfile $buyerProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BuyerProfile $buyerProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BuyerProfile $buyerProfile)
    {
        //
    }
}
