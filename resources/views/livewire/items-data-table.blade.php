<div>
    <div class="w-full mb-4 flex flex-row justify-between items-center gap-4">
        <div class="w-full max-w-md">
            <x-input icon="magnifying-glass" placeholder="Search items..." wire:model.live.debounce.500ms="search" />
        </div>

        <x-button icon="plus" wire:click="$dispatch('openItemModal')" positive>
            Add new
        </x-button>
    </div>

    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-xl border border-default">
        <table class="w-full text-sm text-left rtl:text-right text-body">
            <thead class="text-sm text-body bg-neutral-secondary-medium border-b border-default-medium">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">Item</th>
                    <th scope="col" class="px-6 py-3 font-medium">Category</th>
                    <th scope="col" class="px-6 py-3 font-medium">Location</th>
                    <th scope="col" class="px-6 py-3 font-medium">Manufacturer</th>
                    <th scope="col" class="px-6 py-3 font-medium">Stock</th>
                    <th scope="col" class="px-6 py-3 font-medium">Value</th>
                    <th scope="col" class="px-6 py-3 font-medium"><span class="sr-only">Edit</span></th>
                </tr>
            </thead>

            <tbody>
                @forelse ($items as $item)
                    @php
                        $qty = (int) $item->quantity;
                        $min = (int) $item->minimal_quantity;

                        $isZero = $qty === 0;
                        $isLow = !$isZero && $qty <= $min;

                        $badge = $isZero
                            ? 'bg-red-100 text-red-700'
                            : ($isLow
                                ? 'bg-amber-100 text-amber-800'
                                : 'bg-emerald-100 text-emerald-700');

                        $badgeText = $isZero ? 'ZERO' : ($isLow ? 'LOW' : 'OK');

                        $unit = $item->unitRelation?->name ?? ($item->unit ?? '');
                        $valueLabel =
                            $item->value !== null
                                ? (is_numeric($item->value)
                                    ? number_format((float) $item->value, 0, '.', ',')
                                    : $item->value)
                                : null;
                        $valueDisplay = $valueLabel ? trim($valueLabel . ' ' . $unit) : '—';
                    @endphp

                    <tr class="bg-neutral-primary-soft border-b border-default">
                        <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                            <div class="flex flex-col">
                                <span class="font-semibold">{{ $item->name }}</span>
                                <span class="text-xs text-body/70">
                                    {{ $item->serial_number ? 'SN: ' . $item->serial_number : 'SN: —' }}
                                    {{ $item->model ? ' • Model: ' . $item->model : '' }}
                                </span>
                            </div>
                        </th>

                        <td class="px-6 py-4">
                            {{ $item->category?->name ?? '—' }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $item->location?->name ?? '—' }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $item->manufacturer?->name ?? '—' }}
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span
                                    class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $badge }}">
                                    {{ $badgeText }}
                                </span>
                                <span class="text-sm">
                                    {{ $qty }} / min {{ $min }}
                                </span>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            {{ $valueDisplay }}
                        </td>

                        <td class="px-6 text-right">
                            <x-button secondary xs icon="pencil"
                                wire:click="$dispatch('openItemModal', { item_id: {{ $item->id }} })"
                                label="Edit" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center">
                            <p class="text-sm font-semibold text-heading">No items found</p>
                            <p class="mt-1 text-sm text-body/70">Try adjusting your search or add a new item.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="my-4 px-4">
            {{ $items->links() }}
        </div>
    </div>
</div>
