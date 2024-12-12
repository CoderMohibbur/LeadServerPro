<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" class="p-4 bg-white rounded-lg max-w-md mx-auto">
            @csrf
            <div class="grid grid-cols-2 gap-2">
                <!-- Name -->
                <div>
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name" class="block w-full text-sm p-2 border border-gray-300 rounded" type="text"
                        name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <!-- Email -->
                <div>
                    <x-label for="email" value="{{ __('Your email') }}" />
                    <x-input id="email" class="block w-full text-sm p-2 border border-gray-300 rounded"
                        type="email" name="email" placeholder="name@example.com" required />
                </div>

                <!-- Password -->
                <div>
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block w-full text-sm p-2 border border-gray-300 rounded"
                        type="password" name="password" required />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="block w-full text-sm p-2 border border-gray-300 rounded"
                        type="password" name="password_confirmation" required />
                </div>



            </div>

            <div>
                <!-- Country -->
                <div>
                    <x-label for="country" value="{{ __('Country') }}" />
                    <select id="country" name="country"
                        class="block w-full text-sm p-2 border border-gray-300 rounded" required>
                        <option selected>United States</option>
                        <option value="AU">Australia</option>
                        <option value="UK">United Kingdom</option>
                        <option value="IT">Italy</option>
                        <option value="DE">Germany</option>
                        <option value="ES">Spain</option>
                        <option value="FR">France</option>
                        <option value="CA">Canada</option>
                    </select>
                </div>

                <!-- Company Name -->
                <div>
                    <x-label for="company_name" value="{{ __('Company Name') }}" />
                    <x-input id="company_name" class="block w-full text-sm p-2 border border-gray-300 rounded"
                        type="text" name="company_name" placeholder=" Company Name "
                        value="92 Miles Drive, Newark, NJ 07103" required />
                    @error('company_name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div>
                    <x-label for="phone_number" value="{{ __('Phone Number') }}" />
                    <x-input id="phone_number" class="block w-full text-sm p-2 border border-gray-300 rounded"
                        type="number" name="phone_number" placeholder="Add a phone number" value="3934567890"
                        required />
                </div>


                <!-- LinkedIn URL -->
                <div>
                    <x-label for="linkedin_url" value="{{ __('LinkedIn URL') }}" />
                    <x-input id="linkedin_url" class="block w-full text-sm p-2 border border-gray-300 rounded"
                        type="url" name="linkedin_url" placeholder="LinkedIn URL"
                        value="https://www.linkedin.com/in/helene-example/" required />
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between mt-6">
                <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="text-sm">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
