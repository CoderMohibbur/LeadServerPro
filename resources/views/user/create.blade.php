{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Register') }}
        </h2>
    </x-slot>






    <div class="p-6 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
            <!-- Form Title -->
            {{-- <h1 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 mb-8">Register</h1> --}}

{{-- @if ($errors->has('error'))
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                    {{ $errors->first('error') }}
                </div>
            @endif




            <form class="max-w-sm mx-auto">
                <div class="mb-5">
                  <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                  <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="name@flowbite.com" required />
                </div>
                <div class="mb-5">
                  <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                  <input type="password" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                </div>
                <div class="mb-5">
                  <label for="repeat-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Repeat password</label>
                  <input type="password" id="repeat-password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                </div>
                <div class="flex items-start mb-5">
                  <div class="flex items-center h-5">
                    <input id="terms" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required />
                  </div>
                  <label for="terms" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">I agree with the <a href="#" class="text-blue-600 hover:underline dark:text-blue-500">terms and conditions</a></label>
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register new account</button>
              </form>



        </div>
    </div> --}}

































{{-- <div class="p-6 sm:ml-64 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="p-8 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
            <!-- Form Title -->
            {{-- <h1 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 mb-8">Register</h1> --}}

{{-- @if ($errors->has('error'))
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                    {{ $errors->first('error') }}
                </div>
            @endif

            <!-- Registration Form -->
            <form method="POST" action="{{ route('User.store') }}" class="space-y-8">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                    <input id="name" name="name" type="text" placeholder="Full Name"
                        class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500" required>
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input id="email" name="email" type="email" placeholder="example@mail.com"
                        class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500" required>
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                    <input id="password" name="password" type="password" placeholder="******"
                        class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500" required>
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" placeholder="******"
                        class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500" required>
                    @error('password_confirmation')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Country -->
                <div>
                    <label for="country" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Country</label>
                    <select id="country" name="country"
                        class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500">
                        <option selected>United States</option>
                        <option value="AU">Australia</option>
                        <option value="UK">United Kingdom</option>
                        <option value="IT">Italy</option>
                        <option value="DE">Germany</option>
                        <option value="ES">Spain</option>
                        <option value="FR">France</option>
                        <option value="CA">Canada</option>
                    </select>
                    @error('country')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Company Name -->
                <div>
                    <label for="company_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Company Name</label>
                    <input id="company_name" name="company_name" type="text" placeholder="Company Name"
                        class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500" required>
                    @error('company_name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- LinkedIn URL -->
                <div>
                    <label for="linkedin_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">LinkedIn URL</label>
                    <input id="linkedin_url" name="linkedin_url" type="url" placeholder="https://www.linkedin.com/in/example"
                        class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500" required>
                    @error('linkedin_url')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
                    <input id="phone_number" name="phone_number" type="tel" placeholder="+1234567890"
                        class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500" required>
                    @error('phone_number')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex justify-between items-center mt-8">
                    <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:underline dark:text-blue-400">
                        {{ __('Already registered?') }}
                    </a>
                    <button type="submit"
                        class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-500 focus:outline-none dark:bg-blue-700 dark:hover:bg-blue-800">
                        {{ __('Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>  --}}
















<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users List') }}
        </h2>
    </x-slot>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">


            {{-- <div class="mb-6 flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200"></h1>
                <a href="/User/create"
                    class="inline-block px-5 py-2 bg-blue-500 text-white font-medium rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-500 transition duration-200">
                    Create
                </a>
            </div> --}}
            <div id="custom-buttons" class="custom-buttons mb-4"></div> <!-- Custom Buttons Container -->




            {{-- <form class="w-full">
                <!-- Section 1 -->
                <div class="mb-5">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                    <input type="text" id="name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Full Name" required />
                </div>

                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                    <input type="email" id="email"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="name@domain.com" required />
                </div>

                <div class="mb-5">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                    <input type="password" id="password"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        required />
                </div>

                <div class="mb-5">
                    <label for="password_confirmation"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                    <input type="password" id="password_confirmation"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Confirm Password" required />
                </div>

                <div class="mb-5">
                    <label for="country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                    <select id="country" name="country"
                        class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500">
                        <option selected>United States</option>
                        <option value="AU">Australia</option>
                        <option value="UK">United Kingdom</option>
                        <option value="IT">Italy</option>
                        <option value="DE">Germany</option>
                        <option value="ES">Spain</option>
                        <option value="FR">France</option>
                        <option value="CA">Canada</option>
                    </select>
                    @error('country')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="company_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company
                        Name</label>
                    <input type="text" id="company_name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Company Name" required />
                </div>

                <div class="mb-5">
                    <label for="linkedin_url" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">LinkedIn
                        URL</label>
                    <input type="url" id="linkedin_url"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="LinkedIn URL" required />
                </div>

                <div class="mb-5">
                    <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone
                        Number</label>
                    <input type="text" id="phone_number"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Phone Number" required />
                </div>

                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-500 focus:outline-none dark:bg-blue-700 dark:hover:bg-blue-800">
                    Save
                </button>
            </form>

 --}}



 <form method="POST" action="{{ route('User.store') }}" class="space-y-8">
    @csrf

    <!-- Name -->
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
        <input id="name" name="name" type="text" placeholder="Full Name"
            class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500" required>
        @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Email -->
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
        <input id="email" name="email" type="email" placeholder="example@mail.com"
            class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500" required>
        @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Password -->
    <div>
        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
        <input id="password" name="password" type="password" placeholder="******"
            class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500" required>
        @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div>
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm Password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" placeholder="******"
            class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500" required>
        @error('password_confirmation')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Country -->
    <div>
        <label for="country" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Country</label>
        <select id="country" name="country"
            class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500">
            <option selected>United States</option>
            <option value="AU">Australia</option>
            <option value="UK">United Kingdom</option>
            <option value="IT">Italy</option>
            <option value="DE">Germany</option>
            <option value="ES">Spain</option>
            <option value="FR">France</option>
            <option value="CA">Canada</option>
        </select>
        @error('country')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Company Name -->
    <div>
        <label for="company_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Company Name</label>
        <input id="company_name" name="company_name" type="text" placeholder="Company Name"
            class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500" required>
        @error('company_name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- LinkedIn URL -->
    <div>
        <label for="linkedin_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">LinkedIn URL</label>
        <input id="linkedin_url" name="linkedin_url" type="url" placeholder="https://www.linkedin.com/in/example"
            class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500" required>
        @error('linkedin_url')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Phone -->
    <div>
        <label for="phone_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
        <input id="phone_number" name="phone_number" type="tel" placeholder="+1234567890"
            class="mt-2 block w-full p-3 border border-gray-300 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 focus:ring-blue-500 focus:border-blue-500" required>
        @error('phone_number')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <!-- Actions -->
    <div class="flex justify-between items-center mt-8">
        <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:underline dark:text-blue-400">
            {{ __('Already registered?') }}
        </a>
        <button type="submit"
            class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-500 focus:outline-none dark:bg-blue-700 dark:hover:bg-blue-800">
            {{ __('Save') }}
        </button>
    </div>
</form>





        </div>
    </div>

</x-app-layout>
