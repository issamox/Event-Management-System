<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight bg-gradient-to-r from-blue-500 to-indigo-600 py-4 px-6 rounded-lg shadow-md">
            {{ __('Users Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Create New User Button -->
                    <div class="mb-4 flex justify-between items-center">
                        <h3 class="text-lg font-semibold">Manage Users</h3>
                        <a href="{{ route('users.create') }}" class="bg-blue-500 text-white px-5 py-2 rounded-lg hover:bg-blue-600 shadow-md transition">
                            + Create New User
                        </a>
                    </div>

                    <!-- Users Table -->
                    <table class="w-full border-collapse border border-gray-300 mt-4 text-left">
                        <thead>
                        <tr class="bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 text-gray-900 dark:text-gray-100">
                            <th class="border border-gray-300 px-4 py-2">Name</th>
                            <th class="border border-gray-300 px-4 py-2">Email</th>
                            <th class="border border-gray-300 px-4 py-2">Role</th>
                            <th class="border border-gray-300 px-4 py-2">Reserved Events</th>
                            <th class="border border-gray-300 px-4 py-2">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                                <td class="border border-gray-300 px-4 py-2 capitalize">{{ $user->role ?? 'User' }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    @if ($user->reservations->count() > 0)
                                        <ul class="list-none">
                                            @foreach ($user->reservations as $reservation)
                                                <li class="bg-blue-100 dark:bg-indigo-700 text-blue-800 dark:text-white px-3 py-1 rounded-full inline-block mb-1">
                                                    {{ $reservation->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-gray-500">No Reservations</span>
                                    @endif
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('users.edit', $user->id) }}" class="bg-yellow-500 text-white px-3 py-2 rounded-full hover:bg-yellow-600 transition shadow-md">
                                            ✏️
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-3 py-2 rounded-full hover:bg-red-600 transition shadow-md">
                                                🗑️
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $users->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
