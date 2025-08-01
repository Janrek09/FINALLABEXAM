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
            background-color: #34d399;
            color: white;
            border: 2px solid #222;
            box-shadow: 3px 3px 0px #222;
            transition: all 0.2s ease;
        }
        .cartoon-button:hover {
            transform: translateY(-2px);
            box-shadow: 6px 6px 0px #222;
            background-color: #10b981;
        }
    </style>

    <div class="min-h-screen flex items-center justify-center bg-yellow-50 p-6">
        <div class="w-full max-w-md bg-white rounded-3xl border-4 border-black p-8 cartoon-shadow">

            <h2 class="text-2xl font-extrabold text-center mb-6 text-green-600">🔑 Forgot Password</h2>

            <div class="mb-4 text-sm text-gray-700 text-center">
                {{ __('Forgot your password? No problem! Enter your email and we’ll send you a reset link.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-green-600 text-sm text-center" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-6">
                    <x-input-label for="email" :value="__('Email')" class="cartoon-label" />
                    <x-text-input 
                        id="email" 
                        class="cartoon-input block mt-1 w-full rounded-lg py-2 px-3 focus:outline-none" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-500" />
                </div>

                <!-- Submit -->
                <div class="flex justify-center">
                    <x-primary-button class="cartoon-button px-6 py-2 rounded-full text-sm">
                        {{ __('Email Password Reset Link') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
