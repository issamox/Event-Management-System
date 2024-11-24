<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-xl">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Filters and Create New User -->
                    <div class="flex flex-col md:flex-row justify-between items-center mb-6 space-y-4 md:space-y-0">
                        <!-- Filters -->
                        <form method="GET" action="{{ route('users.index') }}" class="w-full md:w-auto">
                            <div class="flex flex-wrap items-center space-x-4">
                                <!-- Role Filter -->
                                <div>
                                    <label for="role-filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Filter by Role</label>
                                    <select id="role-filter" name="role" onchange="this.form.submit()" class="mt-1 w-full md:w-40 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-md">
                                        <option value="all" {{ $filters['role'] === 'all' ? 'selected' : '' }}>All Roles</option>
                                        <option value="admin" {{ $filters['role'] === 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="user" {{ $filters['role'] === 'user' ? 'selected' : '' }}>User</option>
                                    </select>
                                </div>

                                <!-- Reservation Filter -->
                                <div>
                                    <label for="reservation-filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Filter by Reservations</label>
                                    <select id="reservation-filter" name="reservations" onchange="this.form.submit()" class="mt-1 w-full md:w-48 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-md">
                                        <option value="all" {{ $filters['reservations'] === 'all' ? 'selected' : '' }}>All</option>
                                        <option value="with-reservations" {{ $filters['reservations'] === 'with-reservations' ? 'selected' : '' }}>With Reservations</option>
                                        <option value="no-reservations" {{ $filters['reservations'] === 'no-reservations' ? 'selected' : '' }}>No Reservations</option>
                                    </select>
                                </div>
                            </div>
                        </form>

                        <!-- Create New User Button -->
                        <x-primary-link href="{{ route('users.create') }}" classes="mt-4">
                            + Create New User
                        </x-primary-link>
                    </div>

                    <!-- Users Table -->
                    <div class="overflow-x-auto rounded-lg shadow-lg bg-gray-50 dark:bg-gray-700">
                        <table class="w-full table-auto text-sm text-left">
                            <thead class="bg-blue-600 text-white">
                            <tr>
                                <th class="py-4 px-6 text-left">Name</th>
                                <th class="py-4 px-6 text-center">Email</th>
                                <th class="py-4 px-6 text-center">Role</th>
                                <th class="py-4 px-6 text-center">Reserved Events</th>
                                <th class="py-4 px-6 text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody id="users-table-body">
                            @foreach($users as $user)
                                <tr class="border-b hover:bg-gray-200 dark:hover:bg-gray-800">
                                    <td class="py-4 px-6">{{ $user->name }}</td>
                                    <td class="py-4 px-6 text-center">{{ $user->email }}</td>
                                    <td class="py-4 px-6 text-center capitalize">{{ $user->role ?? 'User' }}</td>
                                    <td class="py-4 px-6 text-center">
                                        @if ($user->reservations->count() > 0)
                                            <ul class="list-none space-y-1">
                                                @foreach ($user->reservations as $reservation)
                                                    <li class="bg-blue-100 dark:bg-indigo-700 text-blue-800 dark:text-white px-3 py-1 rounded-full inline-block">
                                                        {{ $reservation->name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span class="text-gray-500">No Reservations</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="flex justify-center space-x-2">
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
                    <div class="mt-6 flex justify-center">
                        {{ $users->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
