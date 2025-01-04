<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
        <section class="bg-gray-50 dark:bg-gray-900">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <x-validation-errors class="mb-4" />
                <a href="/" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                    <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
                    LeadServerPro    
                </a>
                <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-xl xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Create an account
                        </h1>
                        <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('register') }}">
                            @csrf 
                             
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Name</label>
                                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter Your Name" :value="old('name')" required autofocus autocomplete="name">
                                </div>
                                <div>
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@example.com" required >
                                </div>
                                <div>
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                    <input type="password"  id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                </div>
                                <div>
                                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                </div>
                                <div>
                                    <label for="country" value="{{ __('Country') }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
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
                                <div>
                                    <label for="company_name" value="{{ __('Company Name') }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                                    <input type="text" name="company_name" id="company_name" placeholder=" Company Name " value="92 Miles Drive, Newark, NJ 07103" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                </div>
                                <div>
                                    <label for="phone_number" value="{{ __('Phone Number') }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                                    <input type="number" name="phone_number" id="phone_number" placeholder="Add a phone number" value="3934567890" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                </div>
                                <div>
                                    <label for="linkedin_url" value="{{ __('LinkedIn URL') }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                                    <input type="url" name="linkedin_url" id="linkedin_url" placeholder="LinkedIn URL" value="https://www.linkedin.com/in/helene-example/" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                  <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
                                </div>
                                <div class="ml-3 text-sm">
                                  <label for="terms" class="font-light text-gray-500 dark:text-gray-300">I accept the <a class="font-medium text-primary-600 hover:underline dark:text-primary-500" href="#">Terms and Conditions</a></label>
                                </div>
                            </div>
                            <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create an account</button>
                            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                                Already have an account? <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login here</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
          </section>
    </x-authentication-card>
</x-guest-layout>
{{-- <form method="POST" action="{{ route('register') }}" class="p-4 bg-white rounded-lg max-w-md mx-auto">
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
</form> --}}
