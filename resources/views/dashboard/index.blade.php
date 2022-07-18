@extends('layouts.vendor.app')
@section('title','Dashboard')
@section('home-href')
{{ url("dashboard") }}
@endsection 
@section('home', 'Dashboard')
@section('breadcrumb','Dashboard')
@section('content')
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ $barang }}</h3>
            <p>Data Barang</p>
          </div>
          <div class="icon">
            <i class="fas fa-fw fa-folder"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $sum_barang }}</h3>
            <p>Stok Barang</p>
          </div>
          <div class="icon">
            <i class="fas fa-fw fa-folder-open"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $transaksi }}</h3>

            <p>Data Penjualan</p>
          </div>
          <div class="icon">
            <i class="fas fa-fw fa-poll-h"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>Rp. {{str_replace(',', '.', number_format($laba))}},00</h3>

            <p>Laba Bersih</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <div class="col-md-12">
        <!-- AREA CHART -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Grafik Penjualan</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <form action="{{ url('dashboard') }}" class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <select name="year" class="form-control">
                    @foreach ($year as $item)
                        <option value="{{ $item }}" {{ ($item == $year_now) ? 'selected' : '' }}>{{ $item }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filter</button>
              </div>
            </form>
            <div class="chart">
              <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
      <!-- right col -->
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
@endsection
@section('extra_javascript')
<script>
  $(document).ready(function (){
      $('#dashboard').addClass('active');
  });

  var areaChartData = {
    labels  : ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
    datasets: []
  }

  let data = JSON.parse('<?= $data ?>')

  data.forEach(row => {
    let color = random_rgba()
    var perbulan = [0,0,0,0,0,0,0,0,0,0,0,0]
    row.detailtransaksi.forEach(acc => {
      let bulan = parseInt(acc.transaksi.tgl_transaksi.split('-')[1])
      perbulan[bulan - 1] = parseInt(acc.qty);
    })
    let new_data = {
                      label               : row.nama_brg,
                      backgroundColor     : color,
                      pointRadius          : false,
                      pointColor          : '#3b8bba',
                      pointStrokeColor    : color,
                      pointHighlightFill  : '#fff',
                      pointHighlightStroke: color,
                      data                : perbulan
                    }
    
    areaChartData.datasets.push(new_data)
  });

  function random_rgba() {
    var o = Math.round, r = Math.random, s = 255;
    return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',' + r().toFixed(1) + ')';
  }

  var areaChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines : {
          display : false,
        }
      }],
      yAxes: [{
        gridLines : {
          display : false,
        }
      }]
    }
  }

  var barChartCanvas = $('#barChart').get(0).getContext('2d')
  var barChartData = $.extend(true, {}, areaChartData)

  var i = 0
  areaChartData.datasets.forEach(element => {
    barChartData.datasets[i] = element

    i++
  });

  var barChartOptions = {
    responsive              : true,
    maintainAspectRatio     : false,
    datasetFill             : false
  }

  new Chart(barChartCanvas, {
    type: 'bar',
    data: barChartData,
    options: barChartOptions
  })
  
</script>
@endsection