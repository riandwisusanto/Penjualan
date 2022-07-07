@extends('layouts.vendor.app')
@section('title','Data Penjualan')
@section('breadcrumb','Data Penjualan')
@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                  <a href="" class="btn btn-primary"><b>+</b> Tambah</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>Tanggal</th>
                      <th>Nama Barang</th>
                      <th>Jumlah</th>
                      <th>Harga</th>
                      <th>Total</th>
                      <th>Status</th>
                      <th>Tanggal Lunas</th>
                      <th>Keterangan</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    </tfoot>
                  </table>
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
          $('#penjualan').addClass('active');
      });
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    </script>
@endsection