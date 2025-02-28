@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-semibold text-blue-600 transform hover:scale-105 transition-all duration-300">Add New Service</h1>
        </div>

        <div class="mt-6">
            <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-2 gap-6">
                @csrf

                <!-- Left Partition -->
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-lg font-semibold text-gray-700">Service Name</label>
                        <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded mt-2" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-lg font-semibold text-gray-700">Description</label>
                        <textarea name="description" id="description" class="w-full p-2 border border-gray-300 rounded mt-2" rows="4" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="duration" class="block text-lg font-semibold text-gray-700">Duration (min)</label>
                        <input type="number" name="duration" id="duration" class="w-full p-2 border border-gray-300 rounded mt-2" value="{{ old('duration') }}" required>
                        @error('duration')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="price" class="block text-lg font-semibold text-gray-700">Price (₹)</label>
                        <input type="number" name="price" id="price" class="w-full p-2 border border-gray-300 rounded mt-2" value="{{ old('price') }}" required>
                        @error('price')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-lg font-semibold text-gray-700">Category</label>
                        <select name="category_id" id="category_id" class="w-full p-2 border border-gray-300 rounded mt-2" required>
                            <option value="" disabled selected>Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Right Partition -->
                <div class="space-y-4">
                    <div>
                        <label for="expert_id" class="block text-lg font-semibold text-gray-700">Expert</label>
                        <select name="expert_id" id="expert_id" class="w-full p-2 border border-gray-300 rounded mt-2" required>
                            <option value="" disabled selected>Select Expert</option>
                            @foreach($experts as $expert)
                                <option value="{{ $expert->id }}" {{ old('expert_id') == $expert->id ? 'selected' : '' }}>{{ $expert->name }}</option>
                            @endforeach
                        </select>
                        @error('expert_id')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="branch_id" class="block text-lg font-semibold text-gray-700">
                            Branch
                        </label>
                        <select name="branch_id" id="branch_id" class="w-full p-2
                        border border-gray-300 rounded mt-2" required>
                        <option value="" disabled selected>
                            Select Branch
                        </option>
                        @foreach($branches as $branch)
                        <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                            {{ $branch->name }}
                        </option>
                        @endforeach
                        </select>
                        @error('branch_id')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>


                    <div>
                        <label for="appointment_type" class="block text-lg font-semibold text-gray-700">Appointment Type</label>
                        <select name="appointment_type" id="appointment_type" class="w-full p-2 border border-gray-300 rounded mt-2" required>
                            <option value="appointment" {{ old('appointment_type') == 'appointment' ? 'selected' : '' }}>Appointment</option>
                            <option value="walk-in" {{ old('appointment_type') == 'walk-in' ? 'selected' : '' }}>Walk-in</option>
                        </select>
                        @error('appointment_type')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="image" class="block text-lg font-semibold text-gray-700">Image</label>
                        <input type="file" name="image" id="image" class="w-full p-2 border border-gray-300 rounded mt-2" accept="image/*">
                        @error('image')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex justify-center mt-6">
                        <button type="submit" class="bg-blue-500 text-white p-3 rounded hover:bg-blue-600 transform hover:scale-105 transition-all duration-300">
                            Save Service
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
