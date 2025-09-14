<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnimalCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = AnimalCategory::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = AnimalCategory::orderBy('depth')->get();
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:animal_categories',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'parent_id' => 'nullable|exists:animal_categories,id' // Add validation for parent_id
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = Storage::disk('website')->putFile('category_images', $request->file('image'));
        }


        $validated['slug'] = Str::slug($validated['name']);

        // Calculate depth if parent is selected
        if (!empty($validated['parent_id'])) {
            $parent = AnimalCategory::find($validated['parent_id']);
            $validated['depth'] = $parent->depth + 1;
        }

        AnimalCategory::create($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AnimalCategory $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnimalCategory $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnimalCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:animal_categories,name,' . $category->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if (!empty($category->image) && Storage::disk('website')->exists($category->image)) {
                Storage::disk('website')->delete($category->image);
            }
            $validated['image'] = Storage::disk('website')->putFile('category_images', $request->file('image'));
        }


        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnimalCategory $category)
    {
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
