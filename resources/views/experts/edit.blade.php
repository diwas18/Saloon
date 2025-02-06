@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Expert</h1>

        <form action="{{ route('experts.update', $expert->id) }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $expert->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('name') border-red-500 @enderror" required>
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="specialization" class="block text-sm font-medium text-gray-700">Specialization</label>
                    <input type="text" id="specialization" name="specialization" value="{{ old('specialization', $expert->specialization) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('specialization') border-red-500 @enderror" required>
                    @error('specialization') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="experience_years" class="block text-sm font-medium text-gray-700">Experience (Years)</label>
                    <input type="number" id="experience_years" name="experience_years" value="{{ old('experience_years', $expert->experience_years) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('experience_years') border-red-500 @enderror" required>
                    @error('experience_years') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                    <input type="number" step="0.1" id="rating" name="rating" value="{{ old('rating', $expert->rating) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('rating') border-red-500 @enderror">
                    @error('rating') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="availability" class="block text-sm font-medium text-gray-700">Availability</label>
                    <input type="text" id="availability" name="availability" value="{{ old('availability', $expert->availability) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('availability') border-red-500 @enderror" required>
                    @error('availability') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="profile_picture" class="block text-sm font-medium text-gray-700">Profile Picture</label>
                    <input type="file" id="profile_picture" name="profile_picture" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('profile_picture') border-red-500 @enderror">
                    @error('profile_picture') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

                    @if ($expert->profile_picture)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $expert->profile_picture) }}" alt="Profile Picture" width="100" class="rounded">
                        </div>
                    @endif
                </div>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Update Expert</button>
            <a href="{{ route('experts.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mt-4 ml-4">Cancel</a>
        </form>
    </div>
@endsection
