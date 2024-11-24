<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Welcome Message -->
            <div class="bg-gradient-to-r from-blue-400 to-blue-600 text-white p-6 rounded-lg shadow-lg">
                <h3 class="text-2xl font-bold">Welcome, {{ Auth::user()->name }}!</h3>
                <p class="mt-2 text-lg">
                    We're glad to have you here. Below, you'll find your upcoming events and reservations.
                </p>
            </div>

            <!-- User Events Section -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h4 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-4">Your Upcoming Events</h4>
                @if (Auth::user()->reservations->isEmpty())
                    <p class="text-gray-600 dark:text-gray-400">You have no reservations at the moment.</p>
                @else
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach (Auth::user()->reservations as $reservation)
                            <li class="py-4 flex justify-between items-center">
                                <div>
                                    <h5 class="font-medium text-gray-800 dark:text-gray-300">{{ $reservation->name }}</h5>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ \Carbon\Carbon::parse($reservation->date)->format('F j, Y, g:i A') }}
                                    </p>
                                </div>
                                <span class="bg-green-500 text-white text-sm px-3 py-1 rounded-full">
                                    Reserved
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
