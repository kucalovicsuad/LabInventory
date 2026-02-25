<div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-6">
    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <p class="text-xs font-semibold text-slate-500">Total items</p>
        <p class="mt-2 text-2xl font-semibold text-slate-900">
            {{ number_format($kpi['total_items'] ?? 0) }}
        </p>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <p class="text-xs font-semibold text-slate-500">Total quantity</p>
        <p class="mt-2 text-2xl font-semibold text-slate-900">
            {{ number_format($kpi['total_quantity'] ?? 0) }}
        </p>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <p class="text-xs font-semibold text-slate-500">Inventory records</p>
        <p class="mt-2 text-2xl font-semibold text-slate-900">
            {{ number_format($kpi['inventory_records'] ?? 0) }}
        </p>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <p class="text-xs font-semibold text-slate-500">Items with value</p>
        <p class="mt-2 text-2xl font-semibold text-slate-900">
            {{ number_format($kpi['items_with_value'] ?? 0) }}
        </p>
    </div>

    <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5 shadow-sm">
        <p class="text-xs font-semibold text-amber-800">Low stock</p>
        <p class="mt-2 text-2xl font-semibold text-amber-900">
            {{ number_format($kpi['low_stock'] ?? 0) }}
        </p>
    </div>

    <div class="rounded-2xl border border-rose-200 bg-rose-50 p-5 shadow-sm">
        <p class="text-xs font-semibold text-rose-800">Out of stock</p>
        <p class="mt-2 text-2xl font-semibold text-rose-900">
            {{ number_format($kpi['out_of_stock'] ?? 0) }}
        </p>
    </div>
</div>
