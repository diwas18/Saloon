@extends('layouts.app')

@section('content')
<h1 class="text-4xl font-extrabold text-blue-900">Saloon Users</h1>
<div class="overflow-x-auto mt-5">
    <table class="w-full border-collapse">
        <thead>
            <tr>
                <th class="border p-2 bg-gray-200">ID</th>
                <th class="border p-2 bg-gray-200">Name</th>
                <th class="border p-2 bg-gray-200">Email</th>
                <th class="border p-2 bg-gray-200">Registered On</th>
                <th class="border p-2 bg-gray-200">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
            <tr>
                <td class="border p-2">{{ $user->id }}</td>
                <td class="border p-2">{{ $user->name }}</td>
                <td class="border p-2">{{ $user->email }}</td>
                <td class="border p-2">{{ $user->created_at->format('Y-m-d H:i') }}</td>
                <td class="border p-2 flex space-x-2">
                    <!-- View Button -->
                    <a href="{{ route('user.show', $user->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded">
                        View
                    </a>

                    <!-- Delete Button -->
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
