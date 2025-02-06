@extends('layouts.master')

@section('content')
    <div class="container mx-auto p-6 mt-20">
        <!-- Expert Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Expert Image -->
            <div>
                <img id="main-image" src="{{ asset('storage/' . $expert->profile_picture) }}" alt="{{ $expert->name }}" class="w-full h-72 object-cover rounded-lg">
            </div>

            <!-- Expert Information -->
            <div>
                <h2 class="text-3xl font-semibold text-gray-800">{{ $expert->name }}</h2>
                <p class="text-lg text-blue-900 font-bold">{{ $expert->specialization }}</p>

                <div class="mt-6">
                    <p><strong>Experience:</strong> {{ $expert->experience_years }} years</p>
                    <p><strong>Rating:</strong> {{ $expert->rating ?? 'N/A' }}</p>
                    <p><strong>Availability:</strong> {{ $expert->availability }}</p>
                </div>

                <div class="mt-6">
                    <p><strong>About:</strong></p>
                    <p class="text-gray-700">{{ $expert->bio ?? 'No bio available' }}</p>
                </div>

                <!-- Contact Button -->
                <div class="mt-6">
                    <a href="mailto:{{ $expert->email }}" class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Contact {{ $expert->name }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Expert Photos -->
        <div class="mt-10">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Photos</h3>
            <div class="flex space-x-4">
                @if($expert->photo1)
                    <img src="{{ asset('storage/' . $expert->photo1) }}" class="w-24 h-24 object-cover rounded cursor-pointer" onclick="changeMainImage('{{ asset('storage/' . $expert->photo1) }}')">
                @endif
                @if($expert->photo2)
                    <img src="{{ asset('storage/' . $expert->photo2) }}" class="w-24 h-24 object-cover rounded cursor-pointer" onclick="changeMainImage('{{ asset('storage/' . $expert->photo2) }}')">
                @endif
                @if($expert->photo3)
                    <img src="{{ asset('storage/' . $expert->photo3) }}" class="w-24 h-24 object-cover rounded cursor-pointer" onclick="changeMainImage('{{ asset('storage/' . $expert->photo3) }}')">
                @endif
            </div>
        </div>

        <!-- Related Experts Section -->
        <div class="mt-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Related Experts</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($relatedExperts as $relatedExpert)
                    <a href="{{ route('expertview', $relatedExpert->id) }}">
                        <div class="border rounded-lg bg-gray-100 hover:-translate-y-2 duration-300 shadow hover:shadow-lg">
                            <img src="{{ asset('storage/' . $relatedExpert->profile_picture) }}" alt="{{ $relatedExpert->name }}"
                                class="w-full h-40 object-cover rounded-t-lg">
                            <div class="p-4">
                                <h3 class="text-lg font-bold">{{ $relatedExpert->name }}</h3>
                                <p class="text-black font-bold text-lg">{{ $relatedExpert->specialization }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        // JavaScript function to change the main image when clicked
        function changeMainImage(imageUrl) {
            document.getElementById('main-image').src = imageUrl;
        }
    </script>
@endsection
