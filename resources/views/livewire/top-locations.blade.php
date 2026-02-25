<!-- Top locations -->
<div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="border-b border-slate-200 px-6 py-5">
        <h3 class="text-base font-semibold text-slate-900">Top Locations</h3>
        <p class="mt-1 text-sm text-slate-600">Where the most items are stored.</p>
    </div>

    <div class="p-6 space-y-4">
        @forelse ($locations as $index => $loc)
            <div class="flex items-start justify-between gap-4">
                <div class="min-w-0">
                    <p class="truncate text-sm font-semibold text-slate-900">
                        {{ $loc->name }}
                    </p>
                    <p class="mt-1 text-xs text-slate-600">
                        {{ number_format($loc->items_count) }} items • {{ number_format($loc->total_qty) }} qty
                    </p>
                </div>

                <span class="shrink-0 rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                    #{{ $index + 1 }}
                </span>
            </div>
        @empty
            <div class="rounded-xl bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-900">No data yet</p>
                <p class="mt-1 text-sm text-slate-600">Create locations and add items to see statistics here.</p>
            </div>
        @endforelse

        <div class="pt-2">
            <a href="#" class="text-sm font-semibold text-slate-900 hover:underline">
                View all locations
            </a>
        </div>
    </div>
</div>
