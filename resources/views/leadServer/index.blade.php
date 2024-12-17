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
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.header')
        @include('layouts.filter_sitebar')

        <!-- Theme Toggle Button -->
        <button id="theme-toggle" class="fixed top-4 right-4 bg-gray-800 text-white p-2 rounded-full">
            <span id="theme-toggle-light-icon" class="hidden">🌞</span>
            <span id="theme-toggle-dark-icon" class="hidden">🌙</span>
        </button>

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
            <div class="p-4 sm:ml-64">
                <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
                    <div class="container mx-auto py-8">
                        <!-- Header Section -->
                        <div class="flex justify-between items-center bg-white p-6 shadow-md rounded-lg mb-6 dark:bg-gray-700">
                            <h1 class="text-2xl font-bold text-gray-700 dark:text-white">Welcome to Lead Server</h1>
                            <div class="flex items-center space-x-4">
                                <!-- Logout Button (form for logout) -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">Logout</button>
                                </form>

                                <!-- Export Button (link) -->
                                <a href="{{ route('export') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow">
                                    Export
                                </a>

                                <!-- Import Button (link) -->
                                <a href="sheet-list/create" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded shadow">
                                    Import
                                </a>

                                <!-- All Sheets Button (link) -->
                                <a href="sheet-list" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow">
                                    All Sheets
                                </a>

                                <!-- Reset Button (link) -->
                                <a href="{{ route('reset') }}" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded shadow">
                                    Reset
                                </a>

                                <!-- Global Filter Button (link) -->
                                <a href="{{ route('global_filter') }}" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded shadow">
                                    Global Filter
                                </a>
                            </div>

                        </div>

                        <!-- Table Section -->
                        <div class="w-full bg-white p-5 shadow-md rounded-lg dark:bg-gray-700">
                            <div class="overflow-x-auto">
                                <table class="min-w-full table-auto border-collapse">
                                    <thead class="bg-gray-200 dark:bg-gray-700">
                                        <tr>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">LinkedIn</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Company Name</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Contact Name</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">First Name</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Last Name</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Email</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Title/Position</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Country</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Created Date</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">LinkedIn</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Company Name</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Contact Name</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">First Name</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Last Name</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Email</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Title/Position</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Country</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Created Date</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($leads as $lead)
                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                                <td class="border px-4 py-2"><a href="{{ $lead->linkedin_link }}" class="text-blue-500 underline" target="_blank">LinkedIn</a></td>
                                                <td class="border px-4 py-2">{{ $lead->company_name }}</td>
                                                <td class="border px-4 py-2">{{ $lead->contact_name }}</td>
                                                <td class="border px-4 py-2">{{ $lead->first_name }}</td>
                                                <td class="border px-4 py-2">{{ $lead->last_name }}</td>
                                                <td class="border px-4 py-2">{{ $lead->email }}</td>
                                                <td class="border px-4 py-2">{{ $lead->title_position }}</td>
                                                <td class="border px-4 py-2">{{ $lead->country }}</td>
                                                <td class="border px-4 py-2">{{ $lead->created_date }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="mt-6">
                                {{ $leads->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @stack('modals')

    @livewireScripts
    <script>
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
