@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold text-blue-600 transform hover:scale-105 transition-all duration-300">Bookings</h1>

        <div class="mt-6">


            <!-- Bookings Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse border border-gray-300 shadow-md rounded-lg">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">ID</th>
                            <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Name</th>
                            <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Service</th>
                            <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Branch</th>
                            <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Expert</th>
                            <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Booking Date</th>
                            <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Booking Time</th>
                            <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Status</th>
                            <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr class="transition-all duration-300 hover:bg-gray-100">
                                <td class="border px-4 py-2">{{ $booking->id }}</td>
                                <td class="border px-4 py-2">{{ $booking->name }}</td>
                                <td class="border px-4 py-2">{{ $booking->service?->name ?? 'No Service' }}</td>
                                <td class="border px-4 py-2">{{ $booking->branch->name }}</td>
                                <td class="border px-4 py-2">{{ $booking->expert ? $booking->expert->name : 'N/A' }}</td>
                                <td class="border px-4 py-2">{{ $booking->booking_date }}</td>
                                <td class="border px-4 py-2">{{ $booking->booking_time }}</td>
                                <td class="border px-4 py-2">
                                    <span class="bg-{{ $booking->status == 'pending' ? 'yellow-300' : ($booking->status == 'confirmed' ? 'green-300' : 'gray-300') }} text-gray-800 px-2 py-1 rounded">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td class="border px-4 py-2">

                                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 transform hover:scale-105 transition-all duration-300" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
