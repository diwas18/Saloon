@extends('layouts.master')

@section('content')
    <div class="container mx-auto p-6 mt-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Branch Image -->
            <div class="space-y-4">
                <img src="{{ asset('storage/' . $branch->image) }}"
                     alt="{{ $branch->name }}"
                     class="w-full h-72 object-cover rounded-lg shadow-md">
            </div>

            <!-- Branch Details -->
            <div>
                <h2 class="text-2xl font-bold text-blue-600">{{ $branch->name }}</h2>
                <p class="text-gray-700 mt-2">{{ $branch->description }}</p>

                <div class="mt-6 space-y-2">
                    <p><strong>Location:</strong> {{ $branch->location }}</p>
                    <p><strong>📅 Established:</strong>
                        {{ $branch->created_at ? $branch->created_at->format('d M Y') : 'Not Set' }}
                    </p>
                    <p><strong> Contact:</strong> {{ $branch->contact_number }}</p>
                </div>
            </div>
        </div>

        <!-- Services Available at This Branch -->
        <div class="mt-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Available Services</h2>

            @if ($services->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($services as $service)
                        <!-- Link to Service Detail Page -->
                        <a href="{{ route('serviceview', $service->id) }}" class="border rounded-lg bg-gray-100 hover:-translate-y-2 transition-transform duration-300 shadow hover:shadow-lg">
                            <img src="{{ asset('storage/' . $service->image) }}"
                                 class="w-full h-40 object-cover rounded-t-lg">

                            <div class="p-4">
                                <h3 class="text-lg font-bold text-indigo-600">{{ $service->name }}</h3>
                                <p class="text-xl font-semibold text-green-700">₹{{ number_format($service->price, 2) }}</p>
                                <p class="text-black font-medium mt-2">{{ Str::limit($service->description, 50) }}</p>

                                <p class="text-gray-600 mt-1">
                                    <strong> Category:</strong> {{ $service->category->name ?? 'N/A' }}
                                </p>
                                <p class="text-gray-600">
                                    <strong>Expert:</strong> {{ $service->expert->name ?? 'N/A' }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600 text-center mt-6">⚠️ No services available for this branch.</p>
            @endif
        </div>
    </div>
@endsection
