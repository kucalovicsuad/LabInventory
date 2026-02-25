<div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="flex items-start justify-between gap-6 border-b border-slate-200 px-6 py-5">
        <div>
            <h3 class="text-base font-semibold text-slate-900">Recent activity</h3>
            <p class="mt-1 text-sm text-slate-600">
                Logs: who made changes and on which item.
            </p>
        </div>

        <a href="#"
            class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">
            View logs
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600">User</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600">Action</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600">Item</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600">Time</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-200 bg-white">
                @forelse ($logs as $log)
                    @php
                        $action = strtoupper((string) $log->action_type);

                        $badge = match ($action) {
                            'CREATE' => 'bg-emerald-100 text-emerald-700',
                            'DELETE' => 'bg-rose-100 text-rose-700',
                            'UPDATE' => 'bg-slate-100 text-slate-700',
                            default => 'bg-slate-100 text-slate-700',
                        };

                        $userName = trim(($log->user?->first_name ?? '') . ' ' . ($log->user?->last_name ?? ''));
                        $userName = $userName !== '' ? $userName : 'Unknown';

                        $itemName = $log->item?->name ?? 'Unknown item';

                        $timeAgo = optional($log->created_at)->diffForHumans() ?? '-';
                    @endphp

                    <tr>
                        <td class="px-6 py-4 text-sm font-semibold text-slate-900">
                            {{ $userName }}
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold {{ $badge }}">
                                {{ $action }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-sm text-slate-900">
                            {{ $itemName }}
                        </td>

                        <td class="px-6 py-4 text-sm text-slate-600">
                            {{ $log->description }}
                        </td>

                        <td class="px-6 py-4 text-sm text-slate-500 whitespace-nowrap">
                            {{ $timeAgo }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center">
                            <p class="text-sm font-semibold text-slate-900">No activity yet</p>
                            <p class="mt-1 text-sm text-slate-600">Once users perform actions, they will appear here.
                            </p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="border-t border-slate-200 px-6 py-4 flex items-center justify-end">
        <a href="#" class="text-sm font-semibold text-slate-900 hover:underline">
            Open full activity
        </a>
    </div>
</div>
