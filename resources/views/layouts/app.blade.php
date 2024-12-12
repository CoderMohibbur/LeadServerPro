<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    {{-- <x-banner /> --}}

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        {{-- @livewire('navigation-menu') --}}
        @include('layouts.header')
        @include('layouts.sidebar')

        <!-- Page Heading -->
        <div class="p-4 sm:ml-64">
            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
                @if (isset($header))
                    {{ $header }}
                @endif
            </div>
        </div>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
    <script>
        // JavaScript code for theme toggling here
        const themeToggleBtn = document.getElementById('theme-toggle');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');

        function applyTheme() {
          const systemDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
          const savedTheme = localStorage.getItem('theme');

          if (savedTheme) {
            document.documentElement.classList.toggle('dark', savedTheme === 'dark');
          } else if (systemDarkMode) {
            document.documentElement.classList.add('dark');
          } else {
            document.documentElement.classList.remove('dark');
          }

          if (document.documentElement.classList.contains('dark')) {
            darkIcon.classList.remove('hidden');
            lightIcon.classList.add('hidden');
          } else {
            darkIcon.classList.add('hidden');
            lightIcon.classList.remove('hidden');
          }
        }

        themeToggleBtn.addEventListener('click', () => {
          const currentTheme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
          if (currentTheme === 'dark') {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
          } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
          }
          applyTheme();
        });

        // Initialize theme on page load
        applyTheme();
      </script>
</body>

</html>
