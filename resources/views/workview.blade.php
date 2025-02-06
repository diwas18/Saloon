@extends('layouts.master')

@section('content')
    <div class="container mx-auto p-6 mt-20"> <!-- Added mt-20 to create space from the navbar -->
        <div class="flex justify-between items-center mb-4">

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Work Image -->
            <div class="space-y-4">
                <img id="mainImage" src="{{ asset('storage/' . $work->photo1) }}" class="w-full h-72 object-cover rounded-lg">
            </div>

            <!-- Work Details -->
            <div>
                <h2 class="text-2xl font-bold text-blue-600">{{ $work->name }}</h2>
                <p class="text-gray-700 mt-2">{{ $work->description }}</p>

                <div class="mt-6">
                    <p><strong>Expert:</strong> {{ $work->expert->name }}</p>
                    <p><strong>Completed At:</strong> {{ $work->completed_at ? $work->completed_at->format('d M Y, h:i A') : 'Not Set' }}</p>
                </div>

                <div class="mt-6">
                    <p class="text-sm text-gray-600">
                        <strong>Photos:</strong>
                        <span class="text-blue-500">{{ $work->photo1 ? 'Photo 1' : 'No Photos' }}</span>
                        @if ($work->photo2) | <span class="text-blue-500">Photo 2</span> @endif
                        @if ($work->photo3) | <span class="text-blue-500">Photo 3</span> @endif
                    </p>
                </div>

                <div class="mt-6">
                    <a href="{{ route('works.edit', $work->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transform hover:scale-105 transition-all duration-300">
                        ✏️ Edit Work
                    </a>
                </div>
            </div>
        </div>

        <!-- Photo Thumbnails -->
        <div class="mt-6 flex space-x-4">
            @if ($work->photo1)
                <img src="{{ asset('storage/' . $work->photo1) }}" alt="Photo 1" class="w-16 h-16 object-cover rounded-lg cursor-pointer" onclick="changeImage('{{ asset('storage/' . $work->photo1) }}')">
            @endif
            @if ($work->photo2)
                <img src="{{ asset('storage/' . $work->photo2) }}" alt="Photo 2" class="w-16 h-16 object-cover rounded-lg cursor-pointer" onclick="changeImage('{{ asset('storage/' . $work->photo2) }}')">
            @endif
            @if ($work->photo3)
                <img src="{{ asset('storage/' . $work->photo3) }}" alt="Photo 3" class="w-16 h-16 object-cover rounded-lg cursor-pointer" onclick="changeImage('{{ asset('storage/' . $work->photo3) }}')">
            @endif
        </div>

        <!-- Related Works Section -->
        <div class="mt-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Related Works</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($relatedWorks as $relatedWork)
                    <a href="{{ route('workview', $relatedWork->id) }}">
                        <div class="border rounded-lg bg-gray-100 hover:-translate-y-2 duration-300 shadow hover:shadow-lg">
                            <img src="{{ asset('storage/' . $relatedWork->photo1) }}" class="w-full h-40 object-cover rounded-t-lg">
                            <div class="p-4">
                                <h3 class="text-lg font-bold">{{ $relatedWork->name }}</h3>
                                <p class="text-black font-bold text-lg">{{ Str::limit($relatedWork->description, 50) }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        // JavaScript function to change the main image when clicking on thumbnails
        function changeImage(imageUrl) {
            document.getElementById('mainImage').src = imageUrl;
        }
    </script>
@endsection
