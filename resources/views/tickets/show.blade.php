<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ticket Details') }}
        </h2>
    </x-slot>

    <div class="p-6 sm:ml-64">
        <div class="p-4 border border-gray-300 rounded-lg bg-white dark:bg-gray-800">
            <!-- Ticket Description -->
            <h3 class="font-semibold text-lg mb-4">Ticket: {{ $ticket->title }}</h3>
            <p class="mb-6 text-gray-600">{{ $ticket->description }}</p>
            <hr class="my-4">

            <!-- Chat Box for Ticket Messages -->
            <div class="space-y-4 mb-6" style="max-height: 400px; overflow-y: scroll;">
                @foreach ($messages as $message)
                    <div class="flex {{ $message->user_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-xs p-4 rounded-lg shadow-md {{ $message->user_id == Auth::id() ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-800' }}">
                            <p class="text-sm">{{ $message->message }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $message->created_at->format('d M Y, h:i A') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Reply Form -->
            <form action="{{ route('tickets.storeAnswer', $ticket->id) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Your Reply</label>
                    <textarea id="message" name="message" rows="4" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" placeholder="Type your message here..." required></textarea>
                </div>
                <div class="text-right">
                    <button type="submit" class="inline-block px-6 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 transition">
                        Submit Reply
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
