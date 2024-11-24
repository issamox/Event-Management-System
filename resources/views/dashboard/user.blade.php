<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- User-specific content -->
            <h3 class="text-xl font-semibold">Welcome, {{ Auth::user()->name }}!</h3>
            <p>Here are your upcoming events and reservations:</p>

            <!-- Example User Dashboard Content -->
            <div class="bg-white dark:bg-gray-800 shadow p-6">
                <h4 class="font-semibold">Your Events</h4>
                <ul>
                    @foreach(Auth::user()->reservations as $reservation)
                        <li>{{ $reservation->name }} - {{ $reservation->date }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
