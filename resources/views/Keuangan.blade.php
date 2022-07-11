@extends('Index2')

@section('Title')
Keuangan
@endsection

@section('Main')
<a href="{{ route('TambahPengeluaran') }}" class="float-right font-normal text-sm px-3 py-2 rounded-full bg-[#519259] text-white">Tambah Pengeluaran</a><br><br>
<h1>Periksa Data</h1>
<a href="{{ route('Pendapatan') }}" class="float-left font-normal text-sm px-3 py-2 rounded-full bg-[#3277E3] text-white">Pendapatan</a>
<a href="{{ route('Pengeluaran') }}" class="float-left font-normal text-sm px-3 py-2 rounded-full bg-[#DC8C26] text-white">Pengeluaran</a>

<div class="px-3 py-2 rounded-xl mt-3 mb-7 w-[50%]">
</div>
<div class="grid grid-cols-4 gap-5 mt-10 bg-[#FFFFFF] rounded-3xl">
    <div class="w-full col-span-4">
        <link rel="stylesheet" href="css/grafik.css">
        <div class="row-form">
            <div class="col-lg-12">
                <div class="card-body">
                    <div id="grafik"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full col-span-4">
        <div id="piechart" style="width: 900px; height: 500px;"></div>
    </div>
</div>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    var pendapatan = <?php echo json_encode($total_pendapatan) ?>;
    var pengeluaran = <?php echo json_encode($total_pengeluaran) ?>;
    var bulan = <?php echo json_encode($bulan) ?>;
    Highcharts.chart('grafik', {
        chart: {
            type: 'areaspline'
        },
        title: {
            text: 'Grafik Keuangan'
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'top',
            x: 150,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF'
        },
        xAxis: {
            categories: bulan
        },
        yAxis: {
            title: {
                text: 'Pendapatan Keuangan perBulan'
            }
        },
        tooltip: {
            shared: true,
            valueSuffix: ' units'
        },
        credits: {
            enabled: false
        },
        plotOptions: {
            areaspline: {
                fillOpacity: 0.5
            }
        },
        series: [{
            name: 'Pendapatan',
            data: pendapatan
        }, {
            name: 'Pengeluaran',
            data: pengeluaran
        }]
    });
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            <?php echo $chartData ?>
        ]);

        var options = {
            title: 'Pie Chart Pendapatan/Pengeluaran'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>
@endsection