<x-guest-layout>
    <style>
        .cartoon-shadow {
            box-shadow: 4px 4px 0px #222;
        }
        .cartoon-input {
            background-color: #fffbe7;
            border: 2px solid #222;
            box-shadow: 2px 2px 0px #222;
        }
        .cartoon-label {
            color: #2e2e2e;
            font-weight: bold;
        }
        .cartoon-button {
            background-color: #4f9dff;
            color: white;
            border: 2px solid #222;
            box-shadow: 3px 3px 0px #222;
            transition: all 0.2s ease;
        }
        .cartoon-button:hover {
            transform: translateY(-2px);
            box-shadow: 6px 6px 0px #222;
            background-color: #368efb;
        }
    </style>

    <div class="min-h-screen flex items-center justify-center bg-yellow-50 p-6">
        <div class="w-full max-w-md bg-white rounded-3xl border-4 border-black p-8 cartoon-shadow">

            <h2 class="text-3xl font-extrabold text-center mb-6 text-blue-600">WELKAM</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Name')" class="cartoon-label" />
                    <x-text-input 
                        id="name" 
                        class="cartoon-input block mt-1 w-full rounded-lg py-2 px-3 focus:outline-none" 
                        type="text" 
                        name="name" 
                        :value="old('name')" 
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-red-500" />
                </div>

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="cartoon-label" />
                    <x-text-input 
                        id="email" 
                        class="cartoon-input block mt-1 w-full rounded-lg py-2 px-3 focus:outline-none" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-500" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" class="cartoon-label" />
                    <x-text-input 
                        id="password" 
                        class="cartoon-input block mt-1 w-full rounded-lg py-2 px-3 focus:outline-none" 
                        type="password" 
                        name="password" 
                        required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-500" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="cartoon-label" />
                    <x-text-input 
                        id="password_confirmation" 
                        class="cartoon-input block mt-1 w-full rounded-lg py-2 px-3 focus:outline-none" 
                        type="password" 
                        name="password_confirmation" 
                        required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-red-500" />
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-between">
                    <a class="text-sm underline text-blue-500 hover:text-blue-700" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="cartoon-button px-6 py-2 rounded-full text-sm">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
