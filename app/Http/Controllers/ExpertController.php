<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpertController extends Controller
{
    // Show the list of experts
    public function index()
    {
        // Retrieve all experts, including related category data
        $experts = Expert::with('category')->get();

        // Pass the $experts variable to the view
        return view('experts.index', compact('experts'));
    }

    // Show the form for creating a new expert
    public function create()
    {
        // Get all categories for the form
        $categories = Category::all();
        return view('experts.create', compact('categories'));
    }

    // Store a newly created expert
    public function store(Request $request)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'experience_years' => 'required|integer',
            'availability' => 'required|string',
            'rating' => 'nullable|numeric|min:1|max:5',
            'contact_info' => 'nullable|string',
            'languages_spoken' => 'nullable|string',
            'certifications' => 'nullable|string',
            'social_media_link' => 'nullable|url',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Image validation
        ]);

        // Handle the profile picture upload if available
        if ($request->hasFile('profile_picture')) {
            // Store the image in the 'experts' folder in public storage
            $imagePath = $request->file('profile_picture')->store('experts', 'public');
        } else {
            // Set image path to null if no image is uploaded
            $imagePath = null;
        }

        // Create the expert
        Expert::create([
            'name' => $request->name,
            'specialization' => $request->specialization,
            'experience_years' => $request->experience_years,
            'availability' => $request->availability,
            'rating' => $request->rating,
            'contact_info' => $request->contact_info,
            'languages_spoken' => $request->languages_spoken,
            'certifications' => $request->certifications,
            'social_media_link' => $request->social_media_link,
            'profile_picture' => $imagePath,
        ]);

        // Redirect to the experts index page with success message
        return redirect()->route('experts.index')->with('success', 'Expert created successfully.');
    }

    // Show the form for editing an existing expert
    public function edit($id)
    {
        $expert = Expert::findOrFail($id);
        $categories = Category::all();
        return view('experts.edit', compact('expert', 'categories'));
    }

    // Update the specified expert
    public function update(Request $request, $id)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'experience_years' => 'required|integer',
            'availability' => 'required|string',
            'rating' => 'nullable|numeric|min:1|max:5',
            'contact_info' => 'nullable|string',
            'languages_spoken' => 'nullable|string',
            'certifications' => 'nullable|string',
            'social_media_link' => 'nullable|url',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Image validation
        ]);

        // Find the expert to be updated
        $expert = Expert::findOrFail($id);

        // Handle the profile picture upload if available
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($expert->profile_picture) {
                Storage::delete('public/' . $expert->profile_picture);
            }

            // Store the new profile picture
            $imagePath = $request->file('profile_picture')->store('experts', 'public');
        } else {
            // Keep the old profile picture if no new image is uploaded
            $imagePath = $expert->profile_picture;
        }

        // Update the expert
        $expert->update([
            'name' => $request->name,
            'specialization' => $request->specialization,
            'experience_years' => $request->experience_years,
            'availability' => $request->availability,
            'rating' => $request->rating,
            'contact_info' => $request->contact_info,
            'languages_spoken' => $request->languages_spoken,
            'certifications' => $request->certifications,
            'social_media_link' => $request->social_media_link,
            'profile_picture' => $imagePath
        ]);

        // Redirect to the expert index page with success message
        return redirect()->route('experts.index')->with('success', 'Expert updated successfully.');
    }

    // Delete the specified expert
    public function destroy($id)
    {
        // Find the expert to delete
        $expert = Expert::findOrFail($id);

        // Delete the profile picture if exists
        if ($expert->profile_picture) {
            Storage::delete('public/' . $expert->profile_picture);
        }

        // Delete the expert
        $expert->delete();

        // Redirect to the experts index page with success message
        return redirect()->route('experts.index')->with('success', 'Expert deleted successfully.');
    }
}
