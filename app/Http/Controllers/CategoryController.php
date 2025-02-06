<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Show the list of categories
    public function index()
    {
        $categories = Category::all(); // Retrieve all categories
        return view('categories.index', compact('categories'));
    }

    // Show the form for creating a new category
    public function create()
    {
        return view('categories.create');
    }

    // Store a newly created category
    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
        ]);

        // Create the category
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Redirect to the category index page with success message
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    // Show the form for editing an existing category
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    // Update the specified category
    public function update(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string',
        ]);

        // Find the category to update
        $category = Category::findOrFail($id);

        // Update the category
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Redirect to the category index page with success message
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    // Delete the specified category
    public function destroy($id)
    {
        // Find the category to delete
        $category = Category::findOrFail($id);

        // Delete the category
        $category->delete();

        // Redirect to the category index page with success message
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
