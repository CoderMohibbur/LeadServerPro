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

                        <!-- Table Section -->
                        <div class="w-full bg-white p-5 shadow-md rounded-lg dark:bg-gray-700">
                            <div class="overflow-x-auto">
                                <table id="dataTable" class="table-auto w-full border-collapse dark:border-gray-700">
                                    <thead class="bg-gray-200">
                                        <tr>
                                            <th
                                                >
                                                ID</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                LinkedIn Link</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Company Name</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Contact Name</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Name Prefix</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Full Name</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                First Name</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Last Name</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Email</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Title Position</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Person Location</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Full Address</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Company Phone</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Company Head Count</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Country</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                City</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                State</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Tag</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Source Link</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Middle Name</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Sur Name</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Gender</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Personal Phone</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Employee Range</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Company Website</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Company LinkedIn Link</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Company HQ Address</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Industry</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Revenue</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Street</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Zip Code</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Rating</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Sheet ID</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Sheet Name</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Job Link</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Job Role</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Checked By</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Review</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Sheets ID</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Created At</th>
                                            <th
                                                class="px-4 py-2 border dark:border-gray-600 text-blue-800 dark:text-blue-400 font-bold text-center">
                                                Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($leads as $lead)
                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                                <td class="border px-4 py-2">{{ $lead->id }}</td>
                                                <td class="border px-4 py-2">{{ $lead->linkedin_link }}</td>
                                                <td class="border px-4 py-2">{{ $lead->company_name }}</td>
                                                <td class="border px-4 py-2">{{ $lead->contact_name }}</td>
                                                <td class="border px-4 py-2">{{ $lead->name_prefix }}</td>
                                                <td class="border px-4 py-2">{{ $lead->full_name }}</td>
                                                <td class="border px-4 py-2">{{ $lead->first_name }}</td>
                                                <td class="border px-4 py-2">{{ $lead->last_name }}</td>
                                                <td class="border px-4 py-2">{{ $lead->email }}</td>
                                                <td class="border px-4 py-2">{{ $lead->title_position }}</td>
                                                <td class="border px-4 py-2">{{ $lead->person_location }}</td>
                                                <td class="border px-4 py-2">{{ $lead->full_address }}</td>
                                                <td class="border px-4 py-2">{{ $lead->company_phone }}</td>
                                                <td class="border px-4 py-2">{{ $lead->company_head_count }}</td>
                                                <td class="border px-4 py-2">{{ $lead->country }}</td>
                                                <td class="border px-4 py-2">{{ $lead->city }}</td>
                                                <td class="border px-4 py-2">{{ $lead->state }}</td>
                                                <td class="border px-4 py-2">{{ $lead->tag }}</td>
                                                <td class="border px-4 py-2">{{ $lead->source_link }}</td>
                                                <td class="border px-4 py-2">{{ $lead->middle_name }}</td>
                                                <td class="border px-4 py-2">{{ $lead->sur_name }}</td>
                                                <td class="border px-4 py-2">{{ $lead->gender }}</td>
                                                <td class="border px-4 py-2">{{ $lead->personal_phone }}</td>
                                                <td class="border px-4 py-2">{{ $lead->employee_range }}</td>
                                                <td class="border px-4 py-2">{{ $lead->company_website }}</td>
                                                <td class="border px-4 py-2">{{ $lead->company_linkedin_link }}</td>
                                                <td class="border px-4 py-2">{{ $lead->company_hq_address }}</td>
                                                <td class="border px-4 py-2">{{ $lead->industry }}</td>
                                                <td class="border px-4 py-2">{{ $lead->revenue }}</td>
                                                <td class="border px-4 py-2">{{ $lead->street }}</td>
                                                <td class="border px-4 py-2">{{ $lead->zip_code }}</td>
                                                <td class="border px-4 py-2">{{ $lead->rating }}</td>
                                                <td class="border px-4 py-2">{{ $lead->sheet_id }}</td>
                                                <td class="border px-4 py-2">{{ $lead->sheet_name }}</td>
                                                <td class="border px-4 py-2">{{ $lead->job_link }}</td>
                                                <td class="border px-4 py-2">{{ $lead->job_role }}</td>
                                                <td class="border px-4 py-2">{{ $lead->checked_by }}</td>
                                                <td class="border px-4 py-2">{{ $lead->review }}</td>
                                                <td class="border px-4 py-2">{{ $lead->sheets_id }}</td>
                                                <td class="border px-4 py-2">{{ $lead->created_at }}</td>
                                                <td class="border px-4 py-2">{{ $lead->updated_at }}</td>
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
</body>

</html>



<!-- Initialize DataTable -->

  
