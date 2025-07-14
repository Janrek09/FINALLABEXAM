<x-guest-layout>
    <style>
        .cartoon-shadow {
            box-shadow: 4px 4px 0px #222;
        }
        .cartoon-button {
            background-color: #6366f1;
            color: white;
            border: 2px solid #222;
            box-shadow: 3px 3px 0px #222;
            transition: all 0.2s ease;
        }
        .cartoon-button:hover {
            transform: translateY(-2px);
            box-shadow: 6px 6px 0px #222;
            background-color: #4f46e5;
        }
        .cartoon-text {
            font-size: 0.95rem;
            color: #374151;
        }
    </style>

    <div class="min-h-screen flex items-center justify-center bg-yellow-50 p-6">
        <div class="w-full max-w-md bg-white rounded-3xl border-4 border-black p-8 cartoon-shadow text-center">
            
            <h2 class="text-2xl font-extrabold mb-6 text-indigo-600">📧 Verify Your Email</h2>

            <div class="mb-4 cartoon-text">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?') }}
                <br><br>
                {{ __("If you didn't receive the email, we will gladly send you another.") }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-green-600">
                    ✅ {{ __('A new verification link has been sent to your email address.') }}
                </div>
            @endif

            <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <!-- Resend Verification Form -->
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <x-primary-button class="cartoon-button px-5 py-2 rounded-full text-sm">
                        {{ __('Resend Verification Email') }}
                    </x-primary-button>
                </form>

                <!-- Log Out Form -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="text-sm underline text-indigo-600 hover:text-indigo-800 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
