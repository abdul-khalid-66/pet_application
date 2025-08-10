<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GroupSale;
use App\Models\Animal;
use Illuminate\Http\Request;

class GroupSaleController extends Controller
{
    public function index()
    {
        $groupSales = GroupSale::with(['seller', 'animals'])->latest()->get();
        return view('admin.group-sales.index', compact('groupSales'));
    }

    public function create()
    {
        // $animals = Animal::available()->where('sale_type', 'group')->get();
        $animals = Animal::where('sale_type', 'group')->get();
        return view('admin.group-sales.create', compact('animals'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'group_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'total_price' => 'required|numeric|min:0',
            'animal_ids' => 'required|array',
            'animal_ids.*' => 'exists:animals,id'
        ]);

        $validated['seller_id'] = auth()->id();
        $validated['animal_count'] = count($validated['animal_ids']);

        $groupSale = GroupSale::create($validated);
        $groupSale->animals()->sync($validated['animal_ids']);

        // Update animals sale status
        Animal::whereIn('id', $validated['animal_ids'])
            ->update(['status' => 'not_for_sale']);

        return redirect()->route('group-sales.index')
            ->with('success', 'Group sale created successfully.');
    }

    public function show(GroupSale $groupSale)
    {
        return view('admin.group-sales.show', compact('groupSale'));
    }

    public function edit(GroupSale $groupSale)
    {
        $animals = Animal::where('sale_type', 'group')
            ->where(function ($query) use ($groupSale) {
                $query->where('status', 'available')
                    ->orWhereIn('id', $groupSale->animals->pluck('id'));
            })->get();

        return view('admin.group-sales.edit', compact('groupSale', 'animals'));
    }

    public function update(Request $request, GroupSale $groupSale)
    {
        $validated = $request->validate([
            'group_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'total_price' => 'required|numeric|min:0',
            'animal_ids' => 'required|array',
            'animal_ids.*' => 'exists:animals,id'
        ]);

        $validated['animal_count'] = count($validated['animal_ids']);

        // Reset previously associated animals to available
        $groupSale->animals()->update(['status' => 'available']);

        $groupSale->update($validated);
        $groupSale->animals()->sync($validated['animal_ids']);

        // Update new animals status
        Animal::whereIn('id', $validated['animal_ids'])
            ->update(['status' => 'not_for_sale']);

        return redirect()->route('group-sales.index')
            ->with('success', 'Group sale updated successfully.');
    }

    public function destroy(GroupSale $groupSale)
    {
        // Reset animals status before deleting
        $groupSale->animals()->update(['status' => 'available']);
        $groupSale->delete();

        return redirect()->route('group-sales.index')
            ->with('success', 'Group sale deleted successfully.');
    }
}
