@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-semibold text-blue-600 transform hover:scale-105 transition-all duration-300">Works</h1>
            <a href="{{ route('works.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transform hover:scale-105 transition-all duration-300">
                ➕ Add New Work
            </a>
        </div>

        <div class="mt-6">


            <!-- Works Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">#</th>
                            <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Name</th>
                            <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Photos</th>
                            <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Description</th>
                            <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Expert</th>
                            <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Completed At</th>
                            <th class="border px-4 py-2 text-left text-sm font-semibold text-blue-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($works as $index => $work)
                            <tr class="transition-all duration-300 hover:bg-gray-100">
                                <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                <td class="border px-4 py-2">{{ $work->name }}</td>
                                <td class="border px-4 py-2 flex space-x-2">
                                    <img src="{{ asset('storage/' . $work->photo1) }}" class="w-16 h-16 object-cover rounded">
                                    @if ($work->photo2)
                                        <img src="{{ asset('storage/' . $work->photo2) }}" class="w-16 h-16 object-cover rounded">
                                    @endif
                                    @if ($work->photo3)
                                        <img src="{{ asset('storage/' . $work->photo3) }}" class="w-16 h-16 object-cover rounded">
                                    @endif
                                </td>
                                <td class="border px-4 py-2">{{ Str::limit($work->description, 50) }}</td>
                                <td class="border px-4 py-2">{{ $work->expert->name ?? 'N/A' }}</td>
                                <td class="border px-4 py-2">
                                    {{ $work->completed_at ? $work->completed_at->format('d M Y, h:i A') : 'Not Set' }}
                                </td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('works.edit', $work->id) }}" class="text-blue-500 hover:text-blue-700 transform hover:scale-105 transition-all duration-300"> Edit</a>
                                    |
                                    <form action="{{ route('works.destroy', $work->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 transform hover:scale-105 transition-all duration-300" onclick="return confirm('Are you sure?')"> Delete</button>
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
