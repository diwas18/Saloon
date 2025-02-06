<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Service;
use App\Models\Category;
use App\Models\Expert;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Show the list of services
    public function index()
    {
        // Retrieve all services, including related category and expert data
        $services = Service::with('category', 'expert')->get();

        // Pass the $services variable to the view
        return view('services.index', compact('services'));
    }

    // Show the form for creating a new service
    public function create()
    {
        // Get all categories and experts for the form
        $categories = Category::all();  // Get all categories
        $experts = Expert::all();  // Get all experts
        return view('services.create', compact('categories', 'experts'));
    }

    // Store a newly created service
    public function store(Request $request)
    {
        try {
            // Validate input data
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'duration' => 'required|integer',
                'price' => 'required|numeric',
                'category_id' => 'required|exists:categories,id',
                'appointment_type' => 'required|in:appointment,walk-in',
                'expert_id' => 'required|exists:experts,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Image validation
            ]);

            // Handle the image upload if available
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('services', 'public');  // Store the image in 'public/services'
            }

            // Create the service
            Service::create([
                'name' => $request->name,
                'image' => $imagePath,
                'description' => $request->description,
                'duration' => $request->duration,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'appointment_type' => $request->appointment_type,
                'expert_id' => $request->expert_id,
            ]);

            // Redirect to index page with success message
            return redirect()->route('services.index')->with('success', 'Service created successfully.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Show the form for editing an existing service
    public function edit($id)
    {
        try {
            $service = Service::findOrFail($id);
            $categories = Category::all();  // Get all categories
            $experts = Expert::all();  // Get all experts
            return view('services.edit', compact('service', 'categories', 'experts'));
        } catch (\Exception $e) {
            return redirect()->route('services.index')->with('error', 'Service not found.');
        }
    }

    // Update the specified service
    public function update(Request $request, $id)
    {
        try {
            // Validate input data
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'duration' => 'required|integer',
                'price' => 'required|numeric',
                'category_id' => 'required|exists:categories,id',
                'appointment_type' => 'required|in:appointment,walk-in',
                'expert_id' => 'required|exists:experts,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Image validation
            ]);

            // Find the service to be updated
            $service = Service::findOrFail($id);

            // Handle the image upload if available
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($service->image) {
                    Storage::delete('public/' . $service->image);
                }

                // Store the new image
                $imagePath = $request->file('image')->store('services', 'public');
            } else {
                $imagePath = $service->image;  // Keep the old image if no new image is uploaded
            }

            // Update the service
            $service->update([
                'name' => $request->name,
                'image' => $imagePath,
                'description' => $request->description,
                'duration' => $request->duration,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'appointment_type' => $request->appointment_type,
                'expert_id' => $request->expert_id,
            ]);

            // Redirect to the service index page with success message
            return redirect()->route('services.index')->with('success', 'Service updated successfully.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Delete the specified service
    public function destroy($id)
    {
        try {
            // Find the service to delete
            $service = Service::findOrFail($id);

            // Delete the image if exists
            if ($service->image) {
                Storage::delete('public/' . $service->image);
            }

            // Delete the service
            $service->delete();

            // Redirect to index page with success message
            return redirect()->route('services.index')->with('success', 'Service deleted successfully.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
