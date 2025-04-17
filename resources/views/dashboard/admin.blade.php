@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container mx-auto px-4 py-8 space-y-8">
        <nav class="text-sm text-gray-500 mb-2">
            <a href="#" class="hover:underline text-blue-600 font-medium">Home</a>
            <span class="mx-1">/</span>
            <span class="text-gray-600">Penjualan</span>
        </nav>

        <div class="text-left">
            <h2 class="text-4xl font-extrabold text-blue-700 mb-1">Dashboard</h2>
            <p class="text-lg text-gray-600">Selamat Datang, <span class="font-medium text-blue-600">Administrator</span>!</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-xl border border-blue-100">
            <h3 class="text-xl font-semibold text-yellow-600 mb-4">Jumlah Member</h3>
            <p class="text-lg text-gray-600 font-bold">Member: {{ $memberCount }}</p>
            <p class="text-lg text-gray-600 font-bold">Non-Member: {{ $nonMemberCount }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-xl border border-blue-100">
                <h3 class="text-xl font-semibold text-blue-700 mb-4">Jumlah Penjualan per Hari</h3>
                <div id="container" class="w-full h-80"></div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-xl border border-blue-100">
                <h3 class="text-xl font-semibold text-pink-600 mb-4">Persentase Penjualan Produk</h3>
                <div id="con" class="w-full h-80"></div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-xl border border-blue-100">
                <h3 class="text-xl font-semibold text-green-600 mb-4">Stok Tersisa Produk</h3>
                <div id="productChart" class="w-full h-80"></div>
            </div>
        </div>
    </div>

    <script>
        console.log("TANGGAL:", {!! json_encode($dates) !!});
        console.log("TOTAL:", {!! json_encode($totals) !!});
        console.log("PRODUK:", {!! json_encode($productSales) !!});
    </script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        Highcharts.chart('container', {
            chart: {
                type: 'column',
                backgroundColor: 'transparent'
            },
            title: {
                text: null
            },
            exporting: {
                enabled: false
            },
            xAxis: {
                categories: {!! json_encode($dates) !!},
                crosshair: true,
                labels: {
                    style: {
                        color: '#4B5563'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Penjualan',
                    style: { color: '#4B5563' }
                }
            },
            tooltip: {
                valueSuffix: ' transaksi'
            },
            series: [{
                name: 'Jumlah Penjualan',
                color: '#3B82F6',
                data: {!! json_encode($totals) !!}
            }]
        });
    </script>

    <script>
        Highcharts.chart('con', {
            chart: {
                type: 'pie',
                backgroundColor: 'transparent'
            },
            title: {
                text: null
            },
            exporting: {
                enabled: false
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    showInLegend: true,
                    dataLabels: {
                        enabled: false
                    }
                }
            },
            series: [{
                name: 'Produk',
                colorByPoint: true,
                data: {!! json_encode($productSales) !!}
            }]
        });
    </script>

    <script>
        Highcharts.chart('productChart', {
            chart: {
                type: 'bar',
                backgroundColor: 'transparent'
            },
            title: {
                text: 'Stok Tersisa Semua Produk'
            },
            xAxis: {
                categories: {!! json_encode($remainingStock->pluck('name')) !!},
                labels: {
                    style: {
                        color: '#4B5563'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Stok Tersisa',
                    style: { color: '#4B5563' }
                }
            },
            series: [{
                name: 'Stok',
                color: '#10B981',
                data: {!! json_encode($remainingStock->pluck('total_stock')) !!}
            }]
        });
    </script>
@endsection

