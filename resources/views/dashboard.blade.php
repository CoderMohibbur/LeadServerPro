<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="p-6 sm:ml-64">
        <div class="p-6 ">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Total Lead Card -->
                <a href="/lead-server" class="block transition-transform transform hover:-translate-y-2 bg-blue-500 shadow-lg rounded-lg p-6 hover:bg-blue-600">
                    <div class="flex items-center gap-4">
                        <div class="bg-white p-2 rounded-full shadow">
                            <svg class="w-8 h-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H4Zm10 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-8-5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm1.942 4a3 3 0 0 0-2.847 2.051l-.044.133-.004.012c-.042.126-.055.167-.042.195.006.013.02.023.038.039.032.025.08.064.146.155A1 1 0 0 0 6 17h6a1 1 0 0 0 .811-.415.713.713 0 0 1 .146-.155c.019-.016.031-.026.038-.04.014-.027 0-.068-.042-.194l-.004-.012-.044-.133A3 3 0 0 0 10.059 14H7.942Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-xl font-semibold text-white">Total Lead</h1>
                            <p class="text-2xl font-bold text-white">{{ $leads }}</p>
                        </div>
                    </div>
                </a>

                <!-- Total Client Card -->
                <a href="/User" class="block transition-transform transform hover:-translate-y-2 bg-purple-500 shadow-lg rounded-lg p-6 hover:bg-purple-600">
                    <div class="flex items-center gap-4">
                        <div class="bg-white p-2 rounded-full shadow">
                            <svg class="w-8 h-8 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-xl font-semibold text-white">Total Client</h1>
                            <p class="text-2xl font-bold text-white">{{ $users }}</p>
                        </div>
                    </div>
                </a>

                <!-- Total Sheet Card -->
                <a href="/sheets" class="block transition-transform transform hover:-translate-y-2 bg-green-500 shadow-lg rounded-lg p-6 hover:bg-green-600">
                    <div class="flex items-center gap-4">
                        <div class="bg-white p-2 rounded-full shadow">
                            <svg class="w-8 h-8 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H4Zm10 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-8-5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm1.942 4a3 3 0 0 0-2.847 2.051l-.044.133-.004.012c-.042.126-.055.167-.042.195.006.013.02.023.038.039.032.025.08.064.146.155A1 1 0 0 0 6 17h6a1 1 0 0 0 .811-.415.713.713 0 0 1 .146-.155c.019-.016.031-.026.038-.04.014-.027 0-.068-.042-.194l-.004-.012-.044-.133A3 3 0 0 0 10.059 14H7.942Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-xl font-semibold text-white">Total Sheet</h1>
                            <p class="text-2xl font-bold text-white">{{ $sheets }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        {{-- @if (auth()->user()->hasRole('Admin'))
            <p>You have the "Admin" role.</p>
        @else
            <p>You do not have the "Admin" role.</p>
        @endif
        @if (auth()->user()->hasRole('Customer'))
            <p>You have the "Customer" role.</p>
        @else
            <p>You do not have the "Customer" role.</p>
        @endif --}}
    </div>







</x-app-layout>
