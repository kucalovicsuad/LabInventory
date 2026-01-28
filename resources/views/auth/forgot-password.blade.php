@extends('layouts.guest')

@section('content')
    <div class="min-h-screen flex items-center justify-center">
        <x-card class="w-full max-w-md mx-4 sm:mx-0" rounded="2xl" shadow="lg" padding="p-8">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <x-input icon="user" label="Email" placeholder="your email address" id="email" type="email"
                        name="email" :value="old('email')" required autofocus />
                </div>

                <div class="flex items-center justify-end mt-8">
                    <x-button secondary class="ms-4" onclick="window.location='{{ route('login') }}'">
                        {{ __('Cancel') }}
                    </x-button>

                    <x-button type="submit" class="ms-4">
                        {{ __('Reset password') }}
                    </x-button>
                </div>
            </form>
        </x-card>
    </div>
@endsection
