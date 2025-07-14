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
            background-color: #ff4f4f;
            color: white;
            border: 2px solid #222;
            box-shadow: 3px 3px 0px #222;
            transition: all 0.2s ease;
        }
        .cartoon-button:hover {
            transform: translateY(-2px);
            box-shadow: 6px 6px 0px #222;
            background-color: #ff3434;
        }
    </style>

    <div class="min-h-screen flex items-center justify-center bg-yellow-50 p-6">
        <div class="w-full max-w-md bg-white rounded-3xl border-4 border-black p-8 cartoon-shadow">
            
            <h2 class="text-3xl font-extrabold text-center mb-6 text-pink-600">🔐 Toon Login</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-sm text-green-600" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="cartoon-label" />
                    <x-text-input 
                        id="email" 
                        class="cartoon-input block mt-1 w-full rounded-lg py-2 px-3 focus:outline-none" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required autofocus autocomplete="username" />
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
                        required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-500" />
                </div>

                <!-- Remember Me -->
                <div class="mb-6">
                    <label for="remember_me" class="inline-flex items-center cartoon-label">
                        <input 
                            id="remember_me" 
                            type="checkbox" 
                            class="mr-2 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" 
                            name="remember">
                        <span class="text-sm text-gray-800">Remember me</span>
                    </label>
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-between">
                    @if (Route::has('password.request'))
                        <a class="text-sm underline text-pink-600 hover:text-pink-800" href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    @endif

                    <x-primary-button class="cartoon-button px-6 py-2 rounded-full text-sm">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
