@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-center mb-6">Edit Category</h1>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-lg font-semibold">Category Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" class="w-full p-3 border border-gray-300 rounded-md" required>
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-lg font-semibold">Description</label>
            <textarea id="description" name="description" rows="4" class="w-full p-3 border border-gray-300 rounded-md">{{ old('description', $category->description) }}</textarea>
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">Update Category</button>
        </div>
    </form>
</div>
@endsection
