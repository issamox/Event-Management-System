<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-blue-500 text-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold">Total Users</h3>
                    <p class="text-3xl font-bold">{{ $data['totalUsers'] }}</p>
                </div>
                <div class="bg-green-500 text-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold">Admins</h3>
                    <p class="text-3xl font-bold">{{ $data['totalAdmins'] }}</p>
                </div>
                <div class="bg-yellow-500 text-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold">Total Events</h3>
                    <p class="text-3xl font-bold">{{ $data['totalEvents'] }}</p>
                </div>
                <div class="bg-red-500 text-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold">Reservations</h3>
                    <p class="text-3xl font-bold">{{ $data['totalReservations'] }}</p>
                </div>
            </div>

            <!-- Latest Users Table -->
            <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Latest Users</h3>
                <table class="min-w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium">Name</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium">Email</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium">Role</th>
                        <th class="border border-gray-300 px-4 py-2 text-left text-sm font-medium">Created At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data['latestUsers'] as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                            <td class="border border-gray-300 px-4 py-2 capitalize">{{ $user->role }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Reservations by Event Chart -->
            <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Reservations by Event</h3>
                <canvas id="reservationsChart"></canvas>
            </div>
        </div>
    </div>

    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('reservationsChart').getContext('2d');
            const reservationsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($events->pluck('name')),
                    datasets: [{
                        label: 'Reservations',
                        data: @json($events->pluck('reservations_count')),
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endsection
</x-app-layout>
