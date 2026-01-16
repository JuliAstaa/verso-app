<div class="w-full bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
    
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-bold text-gray-800">Income Statistics</h3>
        <span class="text-xs text-gray-400 bg-gray-50 px-2 py-1 rounded">Last 7 Days</span>
    </div>

    {{-- Container Grafik --}}
    <div class="relative h-100 w-full" wire:ignore>
        <canvas id="revenueChart"></canvas>
    </div>

    {{-- 1. CDN CHART.JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- 2. SCRIPT INISIALISASI --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('revenueChart').getContext('2d');

            new Chart(ctx, {
                type: 'line', // Bisa ganti 'bar', 'pie', dll
                data: {
                    labels: @json($labels), // Ambil dari backend
                    datasets: [{
                        label: 'Total Revenue (Rp)',
                        data: @json($data),     // Ambil dari backend
                        borderColor: '#5B4636', // Warna Brand kamu
                        backgroundColor: 'rgba(91, 70, 54, 0.1)', // Warna arsir bawah
                        borderWidth: 2,
                        tension: 0.4, // Biar garisnya melengkung halus
                        fill: true,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#5B4636',
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false // Sembunyikan legend biar bersih
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    // Format Rupiah di Tooltip
                                    return ' Rp ' + context.raw.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                borderDash: [5, 5], // Garis putus-putus
                                color: '#f3f4f6'
                            },
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + (value / 1000) + 'k'; // Singkat angka
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false // Hilangkan grid vertikal
                            }
                        }
                    }
                }
            });
        });
    </script>
</div>