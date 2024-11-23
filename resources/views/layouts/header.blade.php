<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Event Management System </title>

    <!-- Select 2 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>
<body class="bg-gray-100">

<!-- Header -->
<header class="bg-blue-600 text-white py-4">
    <div class="container mx-auto flex justify-between items-center">
        <a class="text-2xl font-bold" href="{{ route('events.index') }}">Event management</a>
        <nav>
            <ul class="flex space-x-6">
                <li><a href="{{ route('events.index') }}" class="{{ request()->routeIs('products.*') ? 'text-black underline' : 'hover:text-gray-300' }}">Events</a></li>
            </ul>
        </nav>
    </div>
</header>
