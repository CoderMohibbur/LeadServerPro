<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Sheet') }}
        </h2>



    </x-slot>
    <div class="p-4 sm:ml-64">
        
        <a href="{{ route('sheet-lists.create') }}">Create New Sheet</a>

        <form action="{{ route('sheet-lists.store') }}" method="POST">
            @csrf
            <div>
                <label for="file">File:</label>
                <input type="text" id="file" name="file" value="{{ old('file') }}" required>
                @error('file')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="sheet_working_date">Sheet Working Date:</label>
                <input type="date" id="sheet_working_date" name="sheet_working_date" value="{{ old('sheet_working_date') }}" required>
                @error('sheet_working_date')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="sheet_name">Sheet Name:</label>
                <input type="text" id="sheet_name" name="sheet_name" value="{{ old('sheet_name') }}" required>
                @error('sheet_name')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="user_id">User:</label>
                <select id="user_id" name="user_id" required>
                    <option value="">-- Select User --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <div>{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">Create</button>
        </form>
</div>

</x-app-layout>
