<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Livewire Todo' }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
    class="bg-gray-100 font-sans leading-normal tracking-normal min-h-screen flex items-center justify-center text-gray-800">
    <div class="w-full">
        {{ $slot }}
    </div>
</body>

</html>