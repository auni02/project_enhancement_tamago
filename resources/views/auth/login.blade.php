<x-guest-layout>
    <div class="flex min-h-screen items-center justify-center bg-gray-100 px-4 py-12">
        <div class="flex w-full max-w-4xl overflow-hidden rounded-2xl bg-white shadow-lg">

            <!-- Right Side: Form -->
            <div class="w-full lg:w-2/2 p-8">
                @if (session('status'))
                    <div class="mb-4 p-3 bg-blue-100 text-blue-700 rounded">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" required autofocus :value="old('email')" class="mt-1 w-full" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" name="password" type="password" required autocomplete="current-password" class="mt-1 w-full" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me + Forgot -->
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <span class="ml-2 text-gray-700">Remember me</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-indigo-600 hover:underline">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <!-- Submit -->
                    <x-primary-button class="w-full">
                        {{ __('Log in') }}
                    </x-primary-button>

                    <!-- Register -->
                    <p class="text-center text-sm text-gray-600 mt-4">
                        Don’t have an account?
                        <a href="{{ route('register') }}" class="text-indigo-600 hover:underline font-medium">Sign up</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
