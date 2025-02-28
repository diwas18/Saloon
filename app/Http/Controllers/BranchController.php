<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Service;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    // Show list of branches
    public function index()
    {

        $branches = Branch::all();
        return view('branches.index', compact('branches'));
    }

    // Show form to create a new branch
    public function create()
    {
        return view('branches.create');
    }

    // Store the new branch
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'contact_number' => 'required|string|max:15',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $branch = new Branch();
        $branch->name = $request->name;
        $branch->contact_number = $request->contact_number;
        $branch->location = $request->location;
        $branch->description = $request->description;
        $branch->status = true; // Default status is active

        // Handle image upload if available
        if ($request->hasFile('image')) {
            $branch->image = $request->file('image')->store('branches', 'public');
        }

        $branch->save();

        return redirect()->route('branches.index')->with('success', 'Branch created successfully.');
    }

    // Show form to edit a branch
    public function edit(Branch $branch)
    {
        return view('branches.edit', compact('branch'));
    }

    // Update the branch
    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'contact_number' => 'required|string|max:15',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $branch->name = $request->name;
        $branch->contact_number = $request->contact_number;
        $branch->location = $request->location;
        $branch->description = $request->description;

        // Handle image upload if available
        if ($request->hasFile('image')) {
            $branch->image = $request->file('image')->store('branches', 'public');
        }

        $branch->save();

        return redirect()->route('branches.index')->with('success', 'Branch updated successfully.');
    }

    // Delete a branch
    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->route('branches.index')->with('success', 'Branch deleted successfully.');
    }
    public function getServiceExperts($service_id)
{
    $services = Service::findOrFail($service_id);

    $experts = $services->expert()->select('id', 'name')->get();

    return response()->json($experts);
}

}
