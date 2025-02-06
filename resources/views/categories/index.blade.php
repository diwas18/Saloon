@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-center mb-6">Categories</h1>
    <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white p-2 rounded mb-4 inline-block">Add New Category</a>

    <div class="mt-6">
        @if (session('success'))
            <div class="bg-green-200 p-2 mb-4">{{ session('success') }}</div>
        @endif

        <table class="min-w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Description</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr class="odd:bg-gray-50">
                        <td class="border px-4 py-2">{{ $category->name }}</td>
                        <td class="border px-4 py-2">{{ $category->description }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-500">Edit</a>
                            |
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
