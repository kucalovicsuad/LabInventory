@extends('layouts.app')

@section('content')
    <div class="min-h-screen mt-8 flex items-start justify-center">
        <x-card class="w-full max-w-7xl mx-4 sm:mx-0" rounded="2xl" shadow="lg" padding="p-8">
            <div>
                <h1 class="text-3xl font-semibold text-center mx-auto">Dashboard</h1>
                <p class="text-sm text-center mt-2 max-w-lg mx-auto">
                    Effortlessly monitor your lab inventory at a glance, track stock levels, recent activity, and key
                    trends in one centralized dashboard.
                </p>
            </div>
            <div class="mt-12">
                <!-- Dashboard content (statistics only) -->
                <div class="mx-auto max-w-7xl px-4 pb-8 sm:px-6 lg:px-8">

                    @livewire('kpi-cards')

                    <!-- Main stats grid -->
                    <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">
                        <!-- Left (2 columns) -->
                        <div class="lg:col-span-2 space-y-6">

                            @livewire('acquisitions-by-month')

                            <!-- Two cards row -->
                            <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">

                                @livewire('top-categories')

                                @livewire('top-locations')
                            </div>

                            @livewire('recent-activity')
                        </div>

                        <!-- Right (1 column) -->
                        <div class="space-y-6">

                            @livewire('low-stock')

                            @livewire('warranty-expiring')

                            @livewire('top-values-and-units')

                            @livewire('data-quality')
                        </div>
                    </div>
                </div>
            </div>
        </x-card>
    </div>
@endsection
