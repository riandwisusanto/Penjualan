@extends('layouts.vendor.app')
@section('title','Laba Rugi')
@section('home-href')
  {{ url('dashboard') }}
@endsection
@section('home', 'Dashboard')
@section('breadcrumb','Laba Rugi')
@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>Tanggal</th>
                      <th>Nama Barang</th>
                      <th>Jumlah</th>
                      <th>Harga Beli</th>
                      <th>Harga Jual</th>
                      <th>Selisih</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $key => $item)
                      <tr class="text-center">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->tgl_jual }}</td>
                        <td>{{ $item->barang->nama_brg }}</td>
                        <td>{{ $item->qty }}</td>
                        <td class="text-right">Rp. {{ str_replace(',', '.', number_format($item->barang->harga_beli)) }},00</td>
                        <td class="text-right">Rp. {{ str_replace(',', '.', number_format($item->barang->harga_jual)) }},00</td>
                        <td class="text-right">Rp. {{ str_replace(',', '.', number_format($item->barang->harga_jual - $item->barang->harga_beli)) }},00</td>
                      </tr>
                      @endforeach
                    </tfoot>
                  </table>
                  <hr>
                  <div class="row mt-2">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-6">Laba Kotor</div>
                        <div class="col-md-6">: <b>Rp. {{ str_replace(',', '.', number_format($laba_kotor)) }},00</b></div>
                        <div class="col-md-6">Min 10%</div>
                        <div class="col-md-6">: <b>Rp. {{ str_replace(',', '.', number_format($min)) }},00</b></div>
                        <hr>
                        <div class="col-md-6">Laba Bersih</div>
                        <div class="col-md-6">: <b>Rp. {{ str_replace(',', '.', number_format($laba_bersih)) }},00</b></div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
            </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    <!-- /.container-fluid -->
    </div>
</section>
@endsection
@section('extra_javascript')
    <script>
      $(document).ready(function (){
          $('#labarugi').addClass('active');
      });
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false, "searching": false, "paging": false, "ordering": false, "info": false,
            // "buttons": ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    </script>
@endsection