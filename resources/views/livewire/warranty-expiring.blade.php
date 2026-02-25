<!-- Warranty expiring -->
<div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="border-b border-slate-200 px-6 py-5">
        <h3 class="text-base font-semibold text-slate-900">Warranty Expiring Soon</h3>
        <p class="mt-1 text-sm text-slate-600">
            Inventory items with warranty nearing expiration.
        </p>
    </div>

    <div class="divide-y divide-slate-200">
        @forelse ($inventories as $inv)
            @php
                $expiresAt = \Carbon\Carbon::parse($inv->expires_at);
                $boughtAt = \Carbon\Carbon::parse($inv->bought);

                // Cijeli broj dana (bez decimala)
                $daysLeft = (int) now()->diffInDays($expiresAt, false);

                $isCritical = $daysLeft <= 30;
            @endphp

            <div class="px-6 py-4">
                <div class="flex items-start justify-between gap-4">
                    <div class="min-w-0">
                        <p class="truncate text-sm font-semibold text-slate-900">
                            {{ $inv->item?->name ?? 'Unknown item' }}
                        </p>

                        <p class="mt-1 text-xs text-slate-600">
                            {{ $inv->inventory_number }}
                            • Bought: {{ $boughtAt->format('d.m.Y') }}
                            • Warranty: {{ $inv->warranty }}m
                        </p>

                        <p class="mt-1 text-xs {{ $isCritical ? 'text-rose-600' : 'text-slate-500' }}">
                            Expires: {{ $expiresAt->format('d.m.Y') }}
                            ({{ $daysLeft }} days left)
                        </p>
                    </div>

                    @if ($isCritical)
                        <span class="shrink-0 rounded-full bg-rose-100 px-2.5 py-1 text-xs font-semibold text-rose-700">
                            CRITICAL
                        </span>
                    @else
                        <span
                            class="shrink-0 rounded-full bg-amber-100 px-2.5 py-1 text-xs font-semibold text-amber-900">
                            SOON
                        </span>
                    @endif
                </div>
            </div>
        @empty
            <div class="px-6 py-6">
                <p class="text-sm font-semibold text-slate-900">No upcoming expirations</p>
                <p class="mt-1 text-sm text-slate-600">
                    No warranties are expiring within the next {{ $daysAhead }} days.
                </p>
            </div>
        @endforelse
    </div>

    <div class="border-t border-slate-200 px-6 py-4 flex items-center justify-end">
        <a href="#" class="text-sm font-semibold text-slate-900 hover:underline">
            View all expiring
        </a>
    </div>
</div>
