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
            background-color: #fb923c;
            color: white;
            border: 2px solid #222;
            box-shadow: 3px 3px 0px #222;
            transition: all 0.2s ease;
        }
        .cartoon-button:hover {
            transform: translateY(-2px);
            box-shadow: 6px 6px 0px #222;
            background-color: #f97316;
        }
    </style>

    <div class="min-h-screen flex items-center justify-center bg-yellow-50 p-6">
        <div class="w-full max-w-md bg-white rounded-3xl border-4 border-black p-8 cartoon-shadow">
            
            <h2 class="text-2xl font-extrabold text-center mb-6 text-orange-600">🔒 Confirm Password</h2>

            <div class="mb-4 text-sm text-gray-700 text-center">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </div>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <div class="mb-6">
                    <x-input-label for="password" :value="__('Password')" class="cartoon-label" />
                    <x-text-input 
                        id="password" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="current-password" 
                        class="cartoon-input block mt-1 w-full rounded-lg py-2 px-3 focus:outline-none" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-500" />
                </div>

                <div class="flex justify-center">
                    <x-primary-button class="cartoon-button px-6 py-2 rounded-full text-sm">
                        {{ __('Confirm') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
