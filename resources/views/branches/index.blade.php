@extends('layouts.app')

@section('content')
    <div class="container mb-12">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-semibold text-blue-600 transform hover:scale-105 transition-all duration-300">Salon Branches</h1>
            <a href="{{ route('branches.create') }}" class="bg-blue-500 text-white p-2 rounded mt-4 hover:bg-blue-600 transform hover:scale-105 transition-all duration-300">
                + Add New Branch
            </a>
        </div>

        <div class="mt-6">
            @if (session('success'))
                <div class="bg-green-200 p-2 mb-4">{{ session('success') }}</div>
            @endif

            <!-- Branches Table -->
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Name</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Image</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Location</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Contact</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($branches as $branch)
                        <tr class="transition-all duration-300 hover:bg-gray-100">
                            <td class="border px-4 py-2">{{ $branch->name }}</td>
                            <td class="border px-4 py-2">
                                @if ($branch->image)
                                    <img src="{{ asset('storage/' . $branch->image) }}" alt="{{ $branch->name }}" class="w-16 h-16 object-cover rounded">
                                @else
                                    <span>No image</span>
                                @endif
                            </td>
                            <td class="border px-4 py-2">{{ $branch->location }}</td>
                            <td class="border px-4 py-2">{{ $branch->contact_number }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('branches.show', $branch->id) }}" class="text-green-500 hover:text-green-700 transform hover:scale-105 transition-all duration-300">View</a>
                                |
                                <a href="{{ route('branches.edit', $branch->id) }}" class="text-blue-500 hover:text-blue-700 transform hover:scale-105 transition-all duration-300">Edit</a>
                                |
                                <form action="{{ route('branches.destroy', $branch->id) }}" method="POST" style="display:inline;">
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
