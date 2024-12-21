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
                                <table>
                                    <thead class="bg-gray-700">
                                        <tr>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">ID</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">LinkedIn Link</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Company Name</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Contact Name</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Name Prefix</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Full Name</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">First Name</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Last Name</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Email</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Title Position</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Person Location</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Full Address</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Company Phone</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Company Head Count</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Country</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">City</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">State</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Tag</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Source Link</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Middle Name</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Sur Name</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Gender</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Personal Phone</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Employee Range</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Company Website</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Company LinkedIn Link</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Company HQ Address</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Industry</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Revenue</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Street</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Zip Code</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Rating</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Sheet ID</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Sheet Name</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Job Link</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Job Role</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Checked By</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Review</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Sheets ID</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Created At</th>
                                            <th class="border px-4 py-2 text-center text-sm font-medium text-gray-600 dark:text-white">Updated At</th>
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
                            <div class="mt-4">
                                {{ $leads->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @livewireScripts
</body>

</html>
