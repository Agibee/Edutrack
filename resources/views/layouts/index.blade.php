<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

   <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />


    <!-- VITE - Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- Wrapper -->
    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">

            {{-- Topbar --}}
            @include('layouts.header')

            <!-- Page Content -->
            <main class="p-6">
                @yield('content')
            </main>

        </div>
    </div>

</body>
</html>
