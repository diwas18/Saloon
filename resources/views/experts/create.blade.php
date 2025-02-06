@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold">Add New Expert</h1>

        <form action="{{ route('experts.store') }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('name') border-red-500 @enderror" required>
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="specialization" class="block text-sm font-medium text-gray-700">Specialization</label>
                    <input type="text" id="specialization" name="specialization" value="{{ old('specialization') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('specialization') border-red-500 @enderror" required>
                    @error('specialization') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="experience_years" class="block text-sm font-medium text-gray-700">Experience (Years)</label>
                    <input type="number" id="experience_years" name="experience_years" value="{{ old('experience_years') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('experience_years') border-red-500 @enderror" required>
                    @error('experience_years') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="availability" class="block text-sm font-medium text-gray-700">Availability</label>
                    <input type="text" id="availability" name="availability" value="{{ old('availability') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('availability') border-red-500 @enderror" required>
                    @error('availability') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="rating" class="block text-sm font-medium text-gray-700">Rating (1-5)</label>
                    <input type="number" id="rating" name="rating" value="{{ old('rating') }}" min="1" max="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('rating') border-red-500 @enderror">
                    @error('rating') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="contact_info" class="block text-sm font-medium text-gray-700">Contact Info</label>
                    <input type="text" id="contact_info" name="contact_info" value="{{ old('contact_info') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('contact_info') border-red-500 @enderror">
                    @error('contact_info') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="languages_spoken" class="block text-sm font-medium text-gray-700">Languages Spoken</label>
                    <input type="text" id="languages_spoken" name="languages_spoken" value="{{ old('languages_spoken') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('languages_spoken') border-red-500 @enderror">
                    @error('languages_spoken') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="certifications" class="block text-sm font-medium text-gray-700">Certifications</label>
                    <input type="text" id="certifications" name="certifications" value="{{ old('certifications') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('certifications') border-red-500 @enderror">
                    @error('certifications') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="social_media_link" class="block text-sm font-medium text-gray-700">Social Media Link</label>
                    <input type="url" id="social_media_link" name="social_media_link" value="{{ old('social_media_link') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('social_media_link') border-red-500 @enderror">
                    @error('social_media_link') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>



                <div>
                    <label for="profile_picture" class="block text-sm font-medium text-gray-700">Profile Picture</label>
                    <input type="file" id="profile_picture" name="profile_picture" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('profile_picture') border-red-500 @enderror">
                    @error('profile_picture') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <button type="submit" class="bg-blue-500 text-white p-2 rounded mt-4">Save Expert</button>
            <a href="{{ route('experts.index') }}" class="bg-gray-500 text-white p-2 rounded mt-4 ml-4">Cancel</a>

        </form>
    </div>
@endsection
