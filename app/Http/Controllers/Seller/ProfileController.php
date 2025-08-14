<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\SellerProfile;
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
        return view('admin.sellers.index', [
            'users' => User::whereNot('id', auth()->user()->id)
                ->where('role', 'seller')
                ->with('sellerProfile')
                ->latest()
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sellers.create');
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
            'farm_name' => 'required|string|max:255',
            'document_type' => 'required|string|in:cnic,license,other',
            'document_number' => 'required|string|max:255',
            'document_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string',
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
            'role' => 'seller',
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
        ]);

        // Handle profile image
        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $profileImagePath;
            $user->save();
        }

        // Handle document image
        $documentImagePath = null;
        if ($request->hasFile('document_image')) {
            $documentImagePath = $request->file('document_image')->store('seller_documents', 'public');
        }

        // Create seller profile
        SellerProfile::create([
            'user_id' => $user->id,
            'creater_id' => auth()->id(),
            'farm_name' => $request->farm_name,
            'bio' => $request->bio,
            'document_type' => $request->document_type,
            'document_number' => $request->document_number,
            'document_image' => $documentImagePath,
        ]);

        return redirect()->route('sellers.index')->with('success', 'Seller created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SellerProfile $sellerProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SellerProfile $sellerProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SellerProfile $sellerProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SellerProfile $sellerProfile)
    {
        //
    }
}
