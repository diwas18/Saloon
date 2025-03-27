<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Service;
use App\Models\Category;
use App\Models\Branch;
use App\Models\Expert;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Show the list of services
    public function index()
    {
        $services = Service::with('category', 'expert', 'branches')->get();
        return view('services.index', compact('services'));
    }

    // Show the form for creating a new service
    public function create()
    {
        $branches = Branch::all();
        $categories = Category::all();
        $experts = Expert::all();
        return view('services.create', compact('categories', 'branches', 'experts'));
    }

    // Store a newly created service
   // Store a newly created service
public function store(Request $request)
{
    try {
        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'duration' => 'required|integer',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'appointment_type' => 'required|in:appointment,walk-in',
            'expert_id' => 'required|exists:experts,id',
            'branch_id' => 'required|exists:branches,id', // Primary branch
            'branch_ids' => 'nullable|array',
            'branch_ids.*' => 'exists:branches,id',
        ]);

        // Handle the image upload if available
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('services', 'public');
        }

        // Create the service
        $service = Service::create([
            'name' => $request->name,
            'image' => $imagePath,
            'description' => $request->description,
            'duration' => $request->duration,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'appointment_type' => $request->appointment_type,
            'expert_id' => $request->expert_id,
            'branch_id' => $request->branch_id, // Primary branch
        ]);

        // Link the service to the related branches
        $branchIds = $request->branch_ids ?? [];
        $branchIds[] = $request->branch_id; // Ensure primary branch is included

        $service->branches()->sync($branchIds); // Sync with pivot table

        return redirect()->route('services.index')->with('success', 'Service created and linked to branches successfully.');
    } catch (\Exception $e) {
        return back()->withErrors(['error' => $e->getMessage()]);
    }
}

    // Show the form for editing an existing service
    public function edit($id)
    {
        try {
            $branches = Branch::all();
            $service = Service::findOrFail($id);
            $categories = Category::all();
            $experts = Expert::all();
            return view('services.edit', compact('service', 'branches', 'categories', 'experts'));
        } catch (\Exception $e) {
            return redirect()->route('services.index')->with('error', 'Service not found.');
        }
    }

    // Update the specified service
   // Update the specified service
public function update(Request $request, $id)
{
    try {
        // Validate input data
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'sometimes|string',
            'duration' => 'sometimes|integer',
            'price' => 'sometimes|numeric',
            'category_id' => 'sometimes|exists:categories,id',
            'appointment_type' => 'sometimes|in:appointment,walk-in',
            'expert_id' => 'sometimes|exists:experts,id',
            'branch_id' => 'sometimes|exists:branches,id',
            'branch_ids' => 'nullable|array',
            'branch_ids.*' => 'exists:branches,id',
        ]);

        // Find the service
        $service = Service::findOrFail($id);

        // Handle the image upload if available
        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::delete('public/' . $service->image);
            }
            $imagePath = $request->file('image')->store('services', 'public');
        } else {
            $imagePath = $service->image;
        }

        // Update the service
        $service->update([
            'name' => $request->name ?? $service->name,
            'image' => $imagePath,
            'description' => $request->description ?? $service->description,
            'duration' => $request->duration ?? $service->duration,
            'price' => $request->price ?? $service->price,
            'category_id' => $request->category_id ?? $service->category_id,
            'appointment_type' => $request->appointment_type ?? $service->appointment_type,
            'expert_id' => $request->expert_id ?? $service->expert_id,
            'branch_id' => $request->branch_id ?? $service->branch_id,
        ]);

        // Update the related branches
        $branchIds = $request->branch_ids ?? [];
        if ($request->has('branch_id')) {
            $branchIds[] = $request->branch_id;
        }

        $service->branches()->sync($branchIds);

        return redirect()->route('services.index')->with('success', 'Service updated and linked to branches successfully.');
    } catch (\Exception $e) {
        return back()->withErrors(['error' => $e->getMessage()]);
    }
}

    // Delete the specified service
    public function destroy($id)
    {
        try {
            // Find the service
            $service = Service::findOrFail($id);

            // Delete the image if exists
            if ($service->image) {
                Storage::delete('public/' . $service->image);
            }

            // Detach from branches before deleting
            $service->branches()->detach();

            // Delete the service
            $service->delete();

            return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
