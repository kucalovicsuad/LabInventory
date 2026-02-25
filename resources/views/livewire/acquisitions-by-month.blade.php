<div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
    <div class="flex items-start justify-between gap-6 border-b border-slate-200 px-6 py-5">
        <div>
            <h3 class="text-base font-semibold text-slate-900">Monthly Acquisitions</h3>
            <p class="mt-1 text-sm text-slate-600">
                Inventory records grouped by purchase date (bought).
            </p>
        </div>

        <div class="flex items-center gap-2">
            <button wire:click="setRange(30)"
                class="rounded-lg border px-3 py-2 text-sm font-semibold hover:bg-slate-50
                       {{ $rangeDays === 30 ? 'border-slate-900 bg-slate-900 text-white hover:bg-slate-800' : 'border-slate-200 bg-white text-slate-700' }}">
                30d
            </button>

            <button wire:click="setRange(90)"
                class="rounded-lg border px-3 py-2 text-sm font-semibold hover:bg-slate-50
                       {{ $rangeDays === 90 ? 'border-slate-900 bg-slate-900 text-white hover:bg-slate-800' : 'border-slate-200 bg-white text-slate-700' }}">
                90d
            </button>

            <button wire:click="setRange(365)"
                class="rounded-lg border px-3 py-2 text-sm font-semibold hover:bg-slate-50
                       {{ $rangeDays === 365 ? 'border-slate-900 bg-slate-900 text-white hover:bg-slate-800' : 'border-slate-200 bg-white text-slate-700' }}">
                1y
            </button>
        </div>
    </div>

    <div class="p-6">
        <div class="h-64 rounded-xl bg-slate-50 p-4">
            <canvas id="acquisitionsChart" class="h-full w-full"></canvas>
        </div>

        <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-3">
            <div class="rounded-xl bg-slate-50 p-4">
                <p class="text-xs font-semibold text-slate-600">This month</p>
                <p class="mt-1 text-xl font-semibold text-slate-900">
                    {{ number_format($stats['this_month'] ?? 0) }}
                </p>
            </div>

            <div class="rounded-xl bg-slate-50 p-4">
                <p class="text-xs font-semibold text-slate-600">Last month</p>
                <p class="mt-1 text-xl font-semibold text-slate-900">
                    {{ number_format($stats['last_month'] ?? 0) }}
                </p>
            </div>

            <div class="rounded-xl bg-slate-50 p-4">
                <p class="text-xs font-semibold text-slate-600">Avg / month</p>
                <p class="mt-1 text-xl font-semibold text-slate-900">
                    {{ number_format($stats['avg_per_month'] ?? 0) }}
                </p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        let acquisitionsChart;

        function renderAcquisitionsChart(payload) {
            const ctx = document.getElementById('acquisitionsChart');
            if (!ctx) return;

            const labels = payload?.labels ?? [];
            const data = payload?.data ?? [];

            if (acquisitionsChart) {
                acquisitionsChart.data.labels = labels;
                acquisitionsChart.data.datasets[0].data = data;
                acquisitionsChart.update();
                return;
            }

            acquisitionsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels,
                    datasets: [{
                        label: 'Acquisitions',
                        data,
                        borderWidth: 1,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            renderAcquisitionsChart(@json($chart));
        });

        document.addEventListener('acquisitions-chart:update', (e) => {
            renderAcquisitionsChart(e.detail.payload);
        });
    </script>
@endpush
