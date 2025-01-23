<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ticket Details') }}
        </h2>
    </x-slot>

    <div class="p-6 sm:ml-64">
        <div class="p-6 bg-white dark:bg-gray-800 border border-gray-300 rounded-lg shadow-lg">
            <!-- Ticket Description -->
            <h3 class="font-semibold text-2xl text-indigo-600 mb-4">Ticket: {{ $ticket->title }}</h3>
            <p class="text-gray-700 dark:text-gray-300 text-lg mb-6">{{ $ticket->description }}</p>
            <hr class="my-4 border-t-2 border-indigo-500">

            <!-- Chat Box for Ticket Messages -->
            <div class="space-y-4 mb-6 overflow-y-auto max-h-96">
                @foreach ($messages as $message)
                    <div class="flex {{ $message->user_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                        <div
                            class="max-w-xs p-4 rounded-lg shadow-md {{ $message->user_id == Auth::id() ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-800' }}">
                            <p class="text-sm">{{ $message->message }}</p>
                            <p class="text-xs text-gray-400 mt-1">{{ $message->created_at->format('d M Y, h:i A') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Reply Form -->



            @if (auth()->user()->hasRole('admin|manager'))
                <form action="{{ route('tickets.storeAnswer', $ticket->id) }}" method="POST">
            @else
                <form action="{{ route('client.tickets.storeAnswer', $ticket->id) }}" method="POST">
            @endif

            @csrf
            <div class="mb-4">
                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Your Reply</label>
                <textarea id="message" name="message" rows="4"
                    class="mt-1 block w-full p-3 border border-indigo-300 rounded-md focus:ring-2 focus:ring-indigo-500" required
                    placeholder="Type your message here..."></textarea>
            </div>
            <div class="text-right">

                @if (auth()->user()->hasRole('admin|manager'))
                    <button type="submit"
                        class="inline-block px-6 py-2 text-sm font-medium text-white bg-green-500 rounded-md hover:bg-green-600 focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 transition">
                        Submit Reply
                    </button>
                @else
                    <button type="submit"
                        class="inline-block px-6 py-2 text-sm font-medium text-white bg-green-500 rounded-md hover:bg-green-600 focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 transition">
                        Submit Reply
                    </button>
                @endif
            </div>
            </form>
        </div>
    </div>
</x-app-layout>
