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
    public function uploadImages(Request $request, Animal $animal)
    {
        try {
            $validator = Validator::make($request->all(), [
                'image' => [
                    'required',
                    'image',
                    'mimes:jpeg,png,jpg,gif,webp',
                    'max:2048'
                ],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first(),
                    'errors' => $validator->errors()
                ], 422);
            }

            if (!$request->file('image')->isValid()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid image file'
                ], 422);
            }

            $path = Storage::disk('website')->putFile('animal_images', $request->file('image'));

            $image = $animal->images()->create([
                'image_path' => $path,
                'is_primary' => false,
            ]);

            return response()->json([
                'success' => true,
                'image_id' => $image->id,
                'path' => Storage::disk('website')->url($path) // Get full URL
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
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

        // Handle temp images
        $tempImages = session('temp_animal_images', []);
        foreach ($tempImages as $tempImage) {
            $newPath = str_replace('temp/', '', $tempImage);
            Storage::disk('website')->move($tempImage, $newPath);

            $animal->images()->create([
                'image_path' => $newPath,
                'is_primary' => false
            ]);
        }
        session()->forget('temp_animal_images');

        return redirect()->route('animals.index')
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

        return view('admin.animals.create', compact('animal', 'categories', 'sellers'));
    }

    public function destroyImage(AnimalImage $image)
    {
        try {
            // Delete file from storage
            if (Storage::disk('website')->exists($image->image_path)) {
                Storage::disk('website')->delete($image->image_path);
            }

            // Delete record from database
            $image->delete();

            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting image: ' . $e->getMessage()
            ], 500);
        }
    }
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
        if ($request->filled('removed_images')) {
            $removedIds = explode(',', $request->removed_images);
            $imagesToDelete = $animal->images()->whereIn('id', $removedIds)->get();

            foreach ($imagesToDelete as $image) {
                if (Storage::disk('website')->exists($image->image_path)) {
                    Storage::disk('website')->delete($image->image_path);
                }
                $image->delete();
            }
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = Storage::disk('website')->putFile('animal_images', $image);

                $animal->images()->create([
                    'image_path' => $path,
                    'is_primary' => false,
                ]);
            }
        }

        return redirect()->route('animals.index')
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

        return redirect()->route('animals.index')
            ->with('success', 'Animal deleted successfully.');
    }

    public function uploadTempImages(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'image' => [
                    'required',
                    'image',
                    'mimes:jpeg,png,jpg,gif',
                    'max:2048'
                ],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            $path = Storage::disk('website')->putFile('temp/animal_images', $request->file('image'));

            // Store in session temporarily
            $tempImages = session('temp_animal_images', []);
            $tempImages[] = $path;
            session(['temp_animal_images' => $tempImages]);

            return response()->json([
                'success' => true,
                'path' => Storage::disk('website')->url($path),
                'temp_path' => $path
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteTempImage($image)
    {
        try {
            $tempImages = session('temp_animal_images', []);

            if (($key = array_search($image, $tempImages)) !== false) {
                unset($tempImages[$key]);
                session(['temp_animal_images' => $tempImages]);
            }

            Storage::disk('website')->delete($image);

            return response()->json([
                'success' => true,
                'message' => 'Image deleted'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting image'
            ], 500);
        }
    }
}
