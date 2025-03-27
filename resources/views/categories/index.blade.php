@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-semibold text-blue-600 transform hover:scale-105 transition-all duration-300">Categories</h1>
            <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white p-2 rounded mb-4 inline-block transform hover:scale-105 transition-all duration-300">
                Add New Category
            </a>
        </div>

        <div class="mt-6">


            <!-- Categories Table -->
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Name</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Description</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="transition-all duration-300 hover:bg-gray-100">
                            <td class="border px-4 py-2">{{ $category->name }}</td>
                            <td class="border px-4 py-2">{{ $category->description }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-500 hover:text-blue-700 transform hover:scale-105 transition-all duration-300">Edit</a>
                                |
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 transform hover:scale-105 transition-all duration-300">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
