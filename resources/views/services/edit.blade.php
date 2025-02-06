@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-center mb-6">Edit Service</h1>

    <div class="grid grid-cols-2 gap-6">
        <!-- Left Partition -->
        <div>
            <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-lg font-semibold">Service Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $service->name) }}" class="w-full p-3 border border-gray-300 rounded-md" required>
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-lg font-semibold">Description</label>
                    <textarea id="description" name="description" rows="4" class="w-full p-3 border border-gray-300 rounded-md" required>{{ old('description', $service->description) }}</textarea>
                    @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="duration" class="block text-lg font-semibold">Duration (mins)</label>
                    <input type="number" id="duration" name="duration" value="{{ old('duration', $service->duration) }}" class="w-full p-3 border border-gray-300 rounded-md" required>
                    @error('duration') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-lg font-semibold">Price</label>
                    <input type="number" id="price" name="price" value="{{ old('price', $service->price) }}" step="0.01" class="w-full p-3 border border-gray-300 rounded-md" required>
                    @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
        </div>

        <!-- Right Partition -->
        <div>
            <div class="mb-4">
                <label for="category_id" class="block text-lg font-semibold">Category</label>
                <select id="category_id" name="category_id" class="w-full p-3 border border-gray-300 rounded-md" required>
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $service->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="appointment_type" class="block text-lg font-semibold">Appointment Type</label>
                <select id="appointment_type" name="appointment_type" class="w-full p-3 border border-gray-300 rounded-md" required>
                    <option value="appointment" {{ old('appointment_type', $service->appointment_type) == 'appointment' ? 'selected' : '' }}>Appointment</option>
                    <option value="walk-in" {{ old('appointment_type', $service->appointment_type) == 'walk-in' ? 'selected' : '' }}>Walk-in</option>
                </select>
                @error('appointment_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="expert_id" class="block text-lg font-semibold">Expert</label>
                <select id="expert_id" name="expert_id" class="w-full p-3 border border-gray-300 rounded-md" required>
                    <option value="">Select Expert</option>
                    @foreach ($experts as $expert)
                        <option value="{{ $expert->id }}" {{ old('expert_id', $service->expert_id) == $expert->id ? 'selected' : '' }}>{{ $expert->name }}</option>
                    @endforeach
                </select>
                @error('expert_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-lg font-semibold">Service Image</label>
                <input type="file" id="image" name="image" class="w-full p-3 border border-gray-300 rounded-md">

                <!-- Display current image if it exists -->
                @if ($service->image)
                    <div class="mt-2">
                        <p>Current Image:</p>
                        <img src="{{ asset('storage/' . $service->image) }}" alt="Current Image" class="w-40 h-40 object-cover rounded-md mt-2">
                    </div>
                @endif

                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">Update Service</button>
            </div>
        </div>
    </form>
</div>
</div>
@endsection
