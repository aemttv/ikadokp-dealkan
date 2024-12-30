<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dealkan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- change world icon --}}
    <link rel="icon" href="{{ asset('assets/images/logo/monogram_logo.png') }}" type="image/png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body class="flex flex-col min-h-screen bg-[#fff9f2] font-poppins overflow-x-hidden">

    {{-- Navbar --}}
    <x-admin-navbar name="joko" email="joko@gmail.com" image="https://cdn-icons-png.flaticon.com/512/149/149071.png" />
    {{-- Aside --}}
    <x-admin-aside-bar />

    <!-- Main Content -->
    <main class="p-4
        sm:ml-64">
        {{-- Content --}}
        <div class="p-4 border-2 border-gray-200 rounded-lg mt-14">
            {{ $slot }}
        </div>
    </main>


</body>

</html>
