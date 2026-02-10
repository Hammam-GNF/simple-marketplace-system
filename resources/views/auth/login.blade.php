<x-guest-layout>
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <div x-data="{ loadingGoogle: false, loadingEmail: false }">

        <!-- Google Login -->
        <a
            href="{{ route('auth.google') }}"
            @click="loadingGoogle = true"
            class="flex items-center justify-center w-full gap-3 px-4 py-3 border border-gray-300 rounded-lg text-sm font-medium transition
                   hover:bg-gray-50
                   disabled:opacity-60"
            :class="{ 'pointer-events-none opacity-60': loadingGoogle }"
        >
            <!-- Spinner -->
            <svg
                x-show="loadingGoogle"
                class="w-5 h-5 animate-spin text-gray-500"
                fill="none"
                viewBox="0 0 24 24"
            >
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>

            <!-- Google Icon -->
            <svg x-show="!loadingGoogle" class="w-5 h-5" viewBox="0 0 48 48">
                <path fill="#EA4335" d="M24 9.5c3.54 0 6.7 1.22 9.18 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.46 13.09 17.77 9.5 24 9.5z"/>
                <path fill="#4285F4" d="M46.5 24c0-1.64-.15-3.22-.43-4.74H24v9.02h12.7c-.55 2.96-2.21 5.47-4.7 7.17l7.2 5.59C43.9 36.64 46.5 30.86 46.5 24z"/>
                <path fill="#FBBC05" d="M10.54 28.59c-.48-1.44-.76-2.98-.76-4.59s.27-3.15.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24s.92 7.54 2.56 10.78l7.98-6.19z"/>
                <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.9-5.81l-7.2-5.59c-2 1.34-4.56 2.13-8.7 2.13-6.23 0-11.54-3.59-13.46-8.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
            </svg>

            <span x-text="loadingGoogle ? 'Redirecting to Google…' : 'Continue with Google'"></span>
        </a>

        <!-- Divider -->
        <div class="flex items-center my-6">
            <div class="flex-grow border-t border-gray-200"></div>
            <span class="mx-3 text-xs text-gray-400 uppercase tracking-wide">
                or continue with email
            </span>
            <div class="flex-grow border-t border-gray-200"></div>
        </div>

        <!-- Email Login -->
        <form
            method="POST"
            action="{{ route('login') }}"
            class="space-y-4"
            @submit="loadingEmail = true"
        >
            @csrf

            <div>
                <x-input-label for="email" value="Email" />
                <x-text-input
                    id="email"
                    class="block mt-1 w-full"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" value="Password" />
                <x-text-input
                    id="password"
                    class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600">
                    <span class="ml-2 text-gray-600">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="underline text-gray-500">
                        Forgot password?
                    </a>
                @endif
            </div>

            <button
                type="submit"
                class="w-full flex justify-center items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg
                       hover:bg-indigo-700 transition
                       disabled:opacity-60"
                :disabled="loadingEmail"
            >
                <svg
                    x-show="loadingEmail"
                    class="w-4 h-4 animate-spin"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>

                <span x-text="loadingEmail ? 'Signing in…' : 'Log in'"></span>
            </button>
        </form>
    </div>
</x-guest-layout>
