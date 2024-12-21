<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Create Lead</title>

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

        <!-- Page Heading -->
        <div class="p-4 sm:ml-64">
            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Create New Lead</h2>
            </div>
        </div>

        <!-- Page Content -->
        <main>
            <div class="p-4 sm:ml-64">
                <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
                    <div class="container mx-auto py-8">
                        <form action="{{ route('leads.store') }}" method="POST">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="linkedin_link" class="block text-sm font-medium text-gray-700">LinkedIn Link</label>
                                    <input type="url" id="linkedin_link" name="linkedin_link" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white" required>
                                </div>
                                <div>
                                    <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name</label>
                                    <input type="text" id="company_name" name="company_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white" required>
                                </div>
                                <div>
                                    <label for="contact_name" class="block text-sm font-medium text-gray-700">Contact Name</label>
                                    <input type="text" id="contact_name" name="contact_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white">
                                </div>
                                <div>
                                    <label for="name_prefix" class="block text-sm font-medium text-gray-700">Name Prefix</label>
                                    <input type="text" id="name_prefix" name="name_prefix" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white">
                                </div>
                                <div>
                                    <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                    <input type="text" id="full_name" name="full_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white" required>
                                </div>
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                                    <input type="text" id="first_name" name="first_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white">
                                </div>
                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" id="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white" required>
                                </div>
                                <div>
                                    <label for="title_position" class="block text-sm font-medium text-gray-700">Title Position</label>
                                    <input type="text" id="title_position" name="title_position" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white">
                                </div>
                                <div>
                                    <label for="person_location" class="block text-sm font-medium text-gray-700">Person Location</label>
                                    <input type="text" id="person_location" name="person_location" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white">
                                </div>
                                <div>
                                    <label for="full_address" class="block text-sm font-medium text-gray-700">Full Address</label>
                                    <input type="text" id="full_address" name="full_address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white">
                                </div>
                                <div>
                                    <label for="company_phone" class="block text-sm font-medium text-gray-700">Company Phone</label>
                                    <input type="text" id="company_phone" name="company_phone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white">
                                </div>
                                <div>
                                    <label for="company_head_count" class="block text-sm font-medium text-gray-700">Company Head Count</label>
                                    <input type="number" id="company_head_count" name="company_head_count" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white">
                                </div>
                                <div>
                                    <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                                    <input type="text" id="country" name="country" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white">
                                </div>
                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                    <input type="text" id="city" name="city" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white">
                                </div>
                                <div>
                                    <label for="state" class="block text-sm font-medium text-gray-700">State</label>
                                    <input type="text" id="state" name="state" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white">
                                </div>
                                <div>
                                    <label for="tag" class="block text-sm font-medium text-gray-700">Tag</label>
                                    <input type="text" id="tag" name="tag" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white">
                                </div>
                                <div>
                                    <label for="source_link" class="block text-sm font-medium text-gray-700">Source Link</label>
                                    <input type="url" id="source_link" name="source_link" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white">
                                </div>
                                <div>
                                    <label for="middle_name" class="block text-sm font-medium text-gray-700">Middle Name</label>
                                    <input type="text" id="middle_name" name="middle_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white">
                                </div>
                                <div>
                                    <label for="sur_name" class="block text-sm font-medium text-gray-700">Sur Name</label>
                                    <input type="text" id="sur_name" name="sur_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white">
                                </div>
                                <div>
                                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                                    <input type="text" id="gender" name="gender" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white">
                                </div>
                                <div>
                                    <label for="personal_phone" class="block text-sm font-medium text-gray-700">Personal Phone</label>
                                    <input type="text" id="personal_phone" name="personal_phone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white">
                                </div>
                                <div>
                                    <label for="employee_range" class="block text-sm font-medium text-gray-700">Employee Range</label>
                                    <input type="text" id="employee_range" name="employee_range" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white">
                                </div>
                                <div>
                                    <label for="company_website" class="block text-sm font-medium text-gray-700">Company Website</label>
                                    <input type="url" id="company_website" name="company_website" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white">
                                </div>

                                <div>
                                    <label for="company_linkedin_link" class="block text-sm font-medium text-gray-700">Company LinkedIn Link</label>
                                    <input type="url" id="company_linkedin_link" name="company_linkedin_link" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white" required>
                                    @error('company_linkedin_link')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                </div>

                                <div>
                                    <label for="company_hq_address" class="block text-sm font-medium text-gray-700">Company HQ Address</label>
                                    <input type="text" id="company_hq_address" name="company_hq_address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white" required>
                                    @error('company_hq_address')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                </div>

                                <div>
                                    <label for="industry" class="block text-sm font-medium text-gray-700">Industry</label>
                                    <input type="text" id="industry" name="industry" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white" required>
                                    @error('industry')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                </div>

                                <div>
                                    <label for="revenue" class="block text-sm font-medium text-gray-700">Revenue</label>
                                    <input type="text" id="revenue" name="revenue" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white" required>
                                    @error('revenue')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                </div>

                                <div>
                                    <label for="street" class="block text-sm font-medium text-gray-700">Street</label>
                                    <input type="text" id="street" name="street" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white" required>
                                    @error('street')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                </div>

                                <div>
                                    <label for="zip_code" class="block text-sm font-medium text-gray-700">Zip Code</label>
                                    <input type="text" id="zip_code" name="zip_code" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white" required>
                                    @error('zip_code')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                </div>

                                <div>
                                    <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                                    <input type="number" id="rating" name="rating" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white" required>
                                    @error('rating')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                </div>

                                <div>
                                    <label for="sheet_id" class="block text-sm font-medium text-gray-700">Sheet ID</label>
                                    <input type="text" id="sheet_id" name="sheet_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white" required>
                                    @error('sheet_id')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                </div>

                                <div>
                                    <label for="sheet_name" class="block text-sm font-medium text-gray-700">Sheet Name</label>
                                    <input type="text" id="sheet_name" name="sheet_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white" required>
                                    @error('sheet_name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                </div>

                                <div>
                                    <label for="job_link" class="block text-sm font-medium text-gray-700">Job Link</label>
                                    <input type="url" id="job_link" name="job_link" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white" required>
                                    @error('job_link')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                </div>

                                <div>
                                    <label for="job_role" class="block text-sm font-medium text-gray-700">Job Role</label>
                                    <input type="text" id="job_role" name="job_role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white" required>
                                    @error('job_role')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                </div>

                                <div>
                                    <label for="checked_by" class="block text-sm font-medium text-gray-700">Checked By</label>
                                    <input type="text" id="checked_by" name="checked_by" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white" required>
                                    @error('checked_by')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                </div>

                                <div>
                                    <label for="review" class="block text-sm font-medium text-gray-700">Review</label>
                                    <textarea id="review" name="review" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white" required></textarea>
                                    @error('review')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                </div>

                                <div>
                                    <label for="sheets_id" class="block text-sm font-medium text-gray-700">Sheets ID</label>
                                    <select id="sheets_id" name="sheets_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white" required>
                                        <option value="" disabled selected>Select a Sheets ID</option>
                                        @foreach($sheets as $sheet)
                                            <option value="{{ $sheet->id }}">{{ $sheet->id }} - {{ $sheet->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('sheets_id')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>




                                <div>
                                    <label for="company_description" class="block text-sm font-medium text-gray-700">Company Description</label>
                                    <textarea id="company_description" name="company_description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-white" rows="4"></textarea>
                                </div>
                            </div>

                            <div class="mt-6">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Create Lead</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
    @livewireScripts
</body>

</html>
