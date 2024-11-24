<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-xl">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Create New User Button -->
                    <div class="text-right mb-6">
                        <x-primary-link href="{{ route('users.create') }}" classes="mt-4">
                            + Create New user
                        </x-primary-link>
                    </div>

                    <!-- Users Table -->
                    <div class="overflow-x-auto rounded-lg shadow-lg bg-gray-50 dark:bg-gray-700">
                        <table class="w-full table-auto text-sm text-left">
                            <thead class="bg-blue-600 text-white rounded-t-xl">
                            <tr>
                                <th class="py-3 px-4 text-center">Name</th>
                                <th class="py-3 px-4 text-center">Email</th>
                                <th class="py-3 px-4 text-center">Role</th>
                                <th class="py-3 px-4 text-center">Reserved Events</th>
                                <th class="py-3 px-4 text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr class="border-b hover:bg-gray-200 dark:hover:bg-gray-800">
                                    <td class="py-3 px-4">{{ $user->name }}</td>
                                    <td class="py-3 px-4 text-center">{{ $user->email }}</td>
                                    <td class="py-3 px-4 text-center capitalize">{{ $user->role ?? 'User' }}</td>
                                    <td class="py-3 px-4 text-center">
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
                                    <td class="py-3 px-4 text-center">
                                        <div class="flex justify-center space-x-3">
                                            <a href="{{ route('users.edit', $user->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-full hover:bg-yellow-600 transition transform hover:scale-105">
                                                ✏️
                                            </a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-600 transition transform hover:scale-105">
                                                    🗑️
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $users->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
