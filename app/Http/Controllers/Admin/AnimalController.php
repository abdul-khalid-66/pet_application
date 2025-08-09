<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\AnimalCategory;
use App\Models\User;
use App\Models\AnimalImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $animals = Animal::with(['category', 'seller', 'images'])
            ->latest()
            ->get();

        return view('admin.animals.index', compact('animals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = AnimalCategory::all();
        $sellers = User::where('role', 'seller')->get();

        return view('admin.animals.create', compact('categories', 'sellers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:animal_categories,id',
            'seller_id' => 'required|exists:users,id',
            'price' => 'required|numeric|min:0',
            'sale_type' => 'required|in:fixed,auction,group',
            'age' => 'required|integer|min:0',
            'date_of_birth' => 'nullable|date',
            'gender' => 'required|in:male,female,other',
            'weight' => 'required|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
            'color' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'health_info' => 'nullable|string',
            'feed_details' => 'nullable|string',
            'status' => 'required|in:available,sold,not_for_sale,expired',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $animal = Animal::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'seller_id' => $request->seller_id,
            'price' => $request->price,
            'sale_type' => $request->sale_type,
            'age' => $request->age,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'weight' => $request->weight,
            'height' => $request->height,
            'color' => $request->color,
            'location' => $request->location,
            'health_info' => $request->health_info,
            'feed_details' => $request->feed_details,
            'status' => $request->status,
            'is_featured' => $request->has('is_featured'),
        ]);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('animals/images', 'public');

                AnimalImage::create([
                    'animal_id' => $animal->id,
                    'image_path' => $path,
                    'is_primary' => false, // You can set the first image as primary if you want
                ]);
            }
        }

        return redirect()->route('admin.animals.index')
            ->with('success', 'Animal created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Animal $animal)
    {
        $animal->load(['category', 'seller', 'images']);

        return view('admin.animals.show', compact('animal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Animal $animal)
    {
        $categories = AnimalCategory::all();
        $sellers = User::where('role', 'seller')->get();
        $animal->load('images');

        return view('admin.animals.edit', compact('animal', 'categories', 'sellers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Animal $animal)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:animal_categories,id',
            'seller_id' => 'required|exists:users,id',
            'price' => 'required|numeric|min:0',
            'sale_type' => 'required|in:fixed,auction,group',
            'age' => 'required|integer|min:0',
            'date_of_birth' => 'nullable|date',
            'gender' => 'required|in:male,female,other',
            'weight' => 'required|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
            'color' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'health_info' => 'nullable|string',
            'feed_details' => 'nullable|string',
            'status' => 'required|in:available,sold,not_for_sale,expired',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $animal->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'seller_id' => $request->seller_id,
            'price' => $request->price,
            'sale_type' => $request->sale_type,
            'age' => $request->age,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'weight' => $request->weight,
            'height' => $request->height,
            'color' => $request->color,
            'location' => $request->location,
            'health_info' => $request->health_info,
            'feed_details' => $request->feed_details,
            'status' => $request->status,
            'is_featured' => $request->has('is_featured'),
        ]);

        // Handle new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('animals/images', 'public');

                AnimalImage::create([
                    'animal_id' => $animal->id,
                    'image_path' => $path,
                    'is_primary' => false,
                ]);
            }
        }

        return redirect()->route('admin.animals.index')
            ->with('success', 'Animal updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Animal $animal)
    {
        // Delete associated images first
        foreach ($animal->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        $animal->delete();

        return redirect()->route('admin.animals.index')
            ->with('success', 'Animal deleted successfully.');
    }

    /**
     * Remove an individual image
     */
    public function destroyImage(AnimalImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return response()->json(['success' => true]);
    }
}
