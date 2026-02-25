@extends('layouts.guest')

@section('content')
    <div class="min-h-screen flex items-center justify-center">
        <x-card class="w-full max-w-md mx-4 sm:mx-0" rounded="2xl" shadow="lg" padding="p-8">
            @if (!empty($quote['text']))
                <div class="my-6 rounded-xl border border-slate-200 bg-slate-50 p-4">
                    <p class="text-sm text-slate-700 italic">
                        “{{ $quote['text'] }}”
                    </p>

                    @if (!empty($quote['author']))
                        <p class="mt-2 text-xs font-semibold text-slate-600">
                            — {{ $quote['author'] }}
                        </p>
                    @endif
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <x-input icon="user" label="Email" placeholder="your email address" id="email" type="email"
                        name="email" :value="old('email')" required autofocus />
                </div>

                <div class="mt-4">
                    <x-password icon="lock-closed" label="Password" placeholder="password" id="password" name="password"
                        required />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-8">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-button type="submit" class="ms-4">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>
        </x-card>
    </div>
@endsection
