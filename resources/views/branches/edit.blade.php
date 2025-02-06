@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-semibold text-blue-600 transform hover:scale-105 transition-all duration-300">Edit Branch</h1>
        </div>

        <div class="mt-6">
            <form action="{{ route('branches.update', $branch->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-2 gap-6">
                @csrf
                @method('PUT')

                <!-- Left Section -->
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-lg font-semibold text-gray-700">Branch Name</label>
                        <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded mt-2" value="{{ old('name', $branch->name) }}" required>
                        @error('name')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="location" class="block text-lg font-semibold text-gray-700">Location</label>
                        <input type="text" name="location" id="location" class="w-full p-2 border border-gray-300 rounded mt-2" value="{{ old('location', $branch->location) }}" required>
                        @error('location')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Right Section -->
                <div class="space-y-4">
                    <div>
                        <label for="contact_number" class="block text-lg font-semibold text-gray-700">Contact Number</label>
                        <input type="text" name="contact_number" id="contact_number" class="w-full p-2 border border-gray-300 rounded mt-2" value="{{ old('contact_number', $branch->contact_number) }}" required>
                        @error('contact_number')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="image" class="block text-lg font-semibold text-gray-700">Branch Image</label>
                        <input type="file" name="image" id="image" class="w-full p-2 border border-gray-300 rounded mt-2" accept="image/*">
                        @if ($branch->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $branch->image) }}" class="w-32 h-32 object-cover rounded">
                            </div>
                        @endif
                        @error('image')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex justify-center mt-6 space-x-4">
                        <a href="{{ route('branches.index') }}" class="bg-gray-500 text-white px-5 py-3 rounded hover:bg-gray-600 transform hover:scale-105 transition-all duration-300">
                            Cancel
                        </a>
                        <button type="submit" class="bg-blue-500 text-white px-5 py-3 rounded hover:bg-blue-600 transform hover:scale-105 transition-all duration-300">
                            Update Branch
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
