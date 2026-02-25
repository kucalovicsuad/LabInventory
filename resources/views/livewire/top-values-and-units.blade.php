<!-- Spec values widget -->
<div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="border-b border-slate-200 px-6 py-5">
        <h3 class="text-base font-semibold text-slate-900">Most common values (value + unit)</h3>
        <p class="mt-1 text-sm text-slate-600">Global overview across all items.</p>
    </div>

    <div class="p-6 space-y-4">
        @forelse ($top as $row)
            @php
                $value = $row->spec_value;
                $unit = trim((string) $row->spec_unit);

                $valueFormatted = is_numeric($value) ? number_format((float) $value, 0, '.', ',') : (string) $value;

                $label = $unit !== '' ? "{$valueFormatted} {$unit}" : $valueFormatted;
                $pcs = (int) $row->total_pcs;
            @endphp

            <div class="flex items-center justify-between">
                <p class="text-sm font-semibold text-slate-900">{{ $label }}</p>
                <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">
                    {{ number_format($pcs) }} pcs
                </span>
            </div>
        @empty
            <div class="rounded-xl bg-slate-50 p-4">
                <p class="text-sm font-semibold text-slate-900">No data available</p>
                <p class="mt-1 text-sm text-slate-600">Add items with a value to see statistics here.</p>
            </div>
        @endforelse

        <div class="border-t border-slate-200 pt-4 flex items-center justify-end">
            <a href="#" class="text-sm font-semibold text-slate-900 hover:underline">
                Open spec analytics
            </a>
        </div>
    </div>
</div>
