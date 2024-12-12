<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sheet Lists') }}
        </h2>
    </x-slot>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">


        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Sheet Lists</h1>
            <a href="http://127.0.0.1:8000/User/create" class="inline-block px-5 py-2 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-500 transition duration-200">
                Create
            </a>
        </div>
        </div>
    </div>
</x-app-layout>
