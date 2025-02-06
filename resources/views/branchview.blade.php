@extends('layouts.master')

@section('content')
    <div class="container mx-auto p-6 mt-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Branch Image -->
            <div class="space-y-4">
                <img src="{{ asset('storage/' . $branch->image) }}" alt="{{ $branch->name }}" class="w-full h-72 object-cover rounded-lg">

            </div>

            <!-- Branch Details -->
            <div>
                <h2 class="text-2xl font-bold text-blue-600">{{ $branch->name }}</h2>
                <p class="text-gray-700 mt-2">{{ $branch->description }}</p>

                <div class="mt-6">
                    <p><strong>Location:</strong> {{ $branch->location }}</p>
                    <p><strong>Established:</strong> {{ $branch->established_at ? $branch->established_at->format('d M Y') : 'Not Set' }}</p>
                </div>

                <div class="mt-6">
                    <p><strong>Contact:</strong> {{ $branch->contact_number }}</p>
                </div>
            </div>
        </div>

        <!-- Related Branches Section -->
        <div class="mt-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Related Branches</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($relatedBranches as $relatedBranch)
                    <a href="{{ route('branchview', $relatedBranch->id) }}">
                        <div class="border rounded-lg bg-gray-100 hover:-translate-y-2 duration-300 shadow hover:shadow-lg">
                            <img src="{{ asset('storage/' . $relatedBranch->photo) }}" class="w-full h-40 object-cover rounded-t-lg">
                            <div class="p-4">
                                <h3 class="text-lg font-bold">{{ $relatedBranch->name }}</h3>
                                <p class="text-black font-bold text-lg">{{ Str::limit($relatedBranch->description, 50) }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
