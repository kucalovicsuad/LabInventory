<div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="border-b border-slate-200 px-6 py-5">
        <h3 class="text-base font-semibold text-slate-900">Top Categories</h3>
        <p class="mt-1 text-sm text-slate-600">Based on item count and total quantity.</p>
    </div>

    <div class="p-6 space-y-4">
        @forelse ($categories as $cat)
            <div>
                <div class="flex items-center justify-between text-sm">
                    <p class="font-semibold text-slate-900 truncate">
                        {{ $cat->name }}
                    </p>

                    <p class="text-slate-600 whitespace-nowrap">
                        {{ number_format($cat->items_count) }} items • {{ number_format($cat->total_qty) }} qty
                    </p>
                </div>

                <div class="mt-2 h-2 rounded-full bg-slate-100">
                    <div class="h-2 rounded-full bg-slate-900" style="width: {{ $cat->percent }}%"></div>
                </div>
            </div>
        @empty
            <div class="rounded-xl bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-900">No data yet</p>
                <p class="mt-1 text-sm text-slate-600">Create categories and add items to see statistics here.</p>
            </div>
        @endforelse

        <div class="pt-2">
            <a href="#" class="text-sm font-semibold text-slate-900 hover:underline">
                View all categories
            </a>
        </div>
    </div>
</div>
