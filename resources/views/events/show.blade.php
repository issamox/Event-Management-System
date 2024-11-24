<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Event Reservation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Event Details Section -->
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-lg shadow-lg mb-6">
                        <h2 class="text-4xl font-extrabold mb-2 text-center">{{ $event->name }}</h2>
                        <p class="text-md text-center">
                            <strong>Date:</strong> {{ \Carbon\Carbon::parse($event->date)->format('F j, Y, g:i A') }} |
                            <strong>Location:</strong> {{ $event->location }}
                        </p>
                        <p class="mt-4 text-lg text-center">
                            {{ $event->description }}
                        </p>
                    </div>

                    <!-- RSVP Status Section -->
                    <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-lg mb-6">
                        <h3 class="text-2xl font-bold mb-4 text-center">RSVP Status</h3>
                        <p class="text-center text-lg">
                            Reservations: <strong>{{ $event->reservations()->count() }}</strong> / {{ $event->rsvp_limit }}
                        </p>
                        <div class="mt-6 text-center">
                            @if (Auth::check())
                                <form action="{{ route('events.rsvp', $event->id) }}" method="POST">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded shadow-md {{ $event->reservations()->count() >= $event->rsvp_limit ? 'opacity-50 cursor-not-allowed' : '' }}"
                                        {{ $event->reservations()->count() >= $event->rsvp_limit ? 'disabled' : '' }}>
                                        {{ $event->reservations()->count() >= $event->rsvp_limit ? 'Fully Reserved' : 'Make a Reservation' }}
                                    </button>
                                </form>
                            @else
                                <p class="mt-4">
                                    Please <a href="{{ route('login') }}" class="text-blue-500 underline">login</a> to RSVP.
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- RSVP List Section -->
                    <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow-lg">
                        <h3 class="text-2xl font-bold mb-4 text-center">List of RSVP Users</h3>
                        @if ($event->reservations->isNotEmpty())
                            <table class="w-full table-auto border-collapse border border-gray-300 dark:border-gray-600">
                                <thead>
                                <tr class="bg-gray-200 dark:bg-gray-800">
                                    <th class="p-3 text-left border-b border-gray-300 dark:border-gray-600">#</th>
                                    <th class="p-3 text-left border-b border-gray-300 dark:border-gray-600">Name</th>
                                    <th class="p-3 text-left border-b border-gray-300 dark:border-gray-600">Email</th>
                                    <th class="p-3 text-left border-b border-gray-300 dark:border-gray-600">RSVP Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($event->reservations as $index => $user)
                                    <tr class="{{ $index % 2 === 0 ? 'bg-white dark:bg-gray-800' : 'bg-gray-100 dark:bg-gray-700' }}">
                                        <td class="p-3 border-b border-gray-300 dark:border-gray-600">{{ $index + 1 }}</td>
                                        <td class="p-3 border-b border-gray-300 dark:border-gray-600">{{ $user->name }}</td>
                                        <td class="p-3 border-b border-gray-300 dark:border-gray-600">{{ $user->email }}</td>
                                        <td class="p-3 border-b border-gray-300 dark:border-gray-600">
                                            {{ $user->pivot->created_at->format('F j, Y, g:i A') }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-center text-gray-500 dark:text-gray-400">No users have RSVP’d for this event yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
