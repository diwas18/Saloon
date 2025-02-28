@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-semibold text-blue-600 transform hover:scale-105 transition-all duration-300">Services</h1>
            <a href="{{ route('services.create') }}" class="bg-blue-500 text-white p-2 rounded mt-4 hover:bg-blue-600 transform hover:scale-105 transition-all duration-300">
                Add New Service
            </a>
        </div>

        <div class="mt-6">
            @if (session('success'))
                <div class="bg-green-200 p-2 mb-4">{{ session('success') }}</div>
            @endif

            <!-- Services Table -->
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Name</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Image</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Description</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Duration</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Price</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Category</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Expert</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Branch</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Appointment Type</th>
                        <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr class="transition-all duration-300 hover:bg-gray-100">
                            <td class="border px-4 py-2">{{ $service->name }}</td>
                            <td class="border px-4 py-2">
                                @if ($service->image)
                                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="w-16 h-16 object-cover rounded">
                                @else
                                    <span>No image</span>
                                @endif
                            </td>
                            <td class="border px-4 py-2">{{ $service->description }}</td>
                            <td class="border px-4 py-2">{{ $service->duration }} min</td>
                            <td class="border px-4 py-2">₹{{ number_format($service->price, 2) }}</td>
                            <td class="border px-4 py-2">{{ $service->category->name ?? 'N/A' }}</td>
                            <td class="border px-4 py-2">{{ $service->expert->name ?? 'N/A' }}</td>
                            <td class="border px-4 py-2">{{ $service->branch->name ?? 'N/A' }}</td>
                            <td class="border px-4 py-2">{{ ucfirst($service->appointment_type) }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('services.edit', $service->id) }}" class="text-blue-500 hover:text-blue-700 transform hover:scale-105 transition-all duration-300">Edit</a>
                                |
                                <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">
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
