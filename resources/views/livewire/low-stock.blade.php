<!-- Low stock list -->
<div class="rounded-2xl border border-amber-200 bg-amber-50 shadow-sm">
    <div class="border-b border-amber-200 px-6 py-5">
        <h3 class="text-base font-semibold text-amber-900">Low Stock Items</h3>
        <p class="mt-1 text-sm text-amber-800">Items at or below their minimum quantity.</p>
    </div>

    <div class="divide-y divide-amber-200">
        @forelse ($items as $item)
            @php
                $isZero = (int) $item->quantity === 0;
                $badgeText = $isZero ? 'ZERO' : 'LOW';
                $badgeClass = $isZero ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-900';
            @endphp

            <div class="px-6 py-4">
                <div class="flex items-start justify-between gap-4">
                    <div class="min-w-0">
                        <p class="truncate text-sm font-semibold text-amber-900">
                            {{ $item->name }}
                        </p>

                        <p class="mt-1 text-xs text-amber-800">
                            Qty: <span class="font-semibold">{{ $item->quantity }}</span>
                            <span class="mx-1">•</span>
                            Min: <span class="font-semibold">{{ $item->minimal_quantity }}</span>
                            <span class="mx-1">•</span>
                            {{ $item->location?->name ?? 'Unknown location' }}
                        </p>
                    </div>

                    <span class="shrink-0 rounded-full px-2.5 py-1 text-xs font-semibold {{ $badgeClass }}">
                        {{ $badgeText }}
                    </span>
                </div>
            </div>
        @empty
            <div class="px-6 py-6">
                <p class="text-sm font-semibold text-amber-900">All good 🎉</p>
                <p class="mt-1 text-sm text-amber-800">No items are currently below the minimum stock level.</p>
            </div>
        @endforelse
    </div>

    <div class="border-t border-amber-200 px-6 py-4 flex items-center justify-end">
        <a href="#" class="text-sm font-semibold text-amber-900 hover:underline">
            Open low stock
        </a>
    </div>
</div>
