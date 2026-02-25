<div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="border-b border-slate-200 px-6 py-5">
        <h3 class="text-base font-semibold text-slate-900">Data quality</h3>
        <p class="mt-1 text-sm text-slate-600">Missing fields that are worth completing.</p>
    </div>

    <div class="p-6 grid grid-cols-2 gap-4">
        <div class="rounded-xl bg-slate-50 p-4">
            <p class="text-xs font-semibold text-slate-600">Missing datasheet</p>
            <p class="mt-1 text-xl font-semibold text-slate-900">
                {{ number_format($stats['missing_datasheet'] ?? 0) }}
            </p>
        </div>

        <div class="rounded-xl bg-slate-50 p-4">
            <p class="text-xs font-semibold text-slate-600">Missing image</p>
            <p class="mt-1 text-xl font-semibold text-slate-900">
                {{ number_format($stats['missing_picture'] ?? 0) }}
            </p>
        </div>

        <div class="rounded-xl bg-slate-50 p-4">
            <p class="text-xs font-semibold text-slate-600">Missing serial number</p>
            <p class="mt-1 text-xl font-semibold text-slate-900">
                {{ number_format($stats['missing_serial'] ?? 0) }}
            </p>
        </div>

        <div class="rounded-xl bg-slate-50 p-4">
            <p class="text-xs font-semibold text-slate-600">Missing manufacturer</p>
            <p class="mt-1 text-xl font-semibold text-slate-900">
                {{ number_format($stats['missing_manufacturer'] ?? 0) }}
            </p>
        </div>
    </div>

    <div class="border-t border-slate-200 px-6 py-4 flex items-center justify-end">
        <a href="#" class="text-sm font-semibold text-slate-900 hover:underline">
            Fix data issues
        </a>
    </div>
</div>
