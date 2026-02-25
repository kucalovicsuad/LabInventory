@extends('layouts.app')

@section('content')
    <div class="min-h-screen mt-8 flex items-start justify-center">
        <x-card class="w-full max-w-7xl mx-4 sm:mx-0" rounded="2xl" shadow="lg" padding="p-8">
            <div>
                <h1 class="text-3xl font-semibold text-center mx-auto">Items Management</h1>
                <p class="text-sm text-center mt-2 max-w-lg mx-auto">
                    Seamlessly manage your inventory items, keeping every component organized, tracked, and fully
                    documented, from stock levels and specifications to location and lifecycle history.
                </p>
            </div>
            <div class="mt-12">
                @livewire('items-data-table')
            </div>
        </x-card>
    </div>
@endsection
