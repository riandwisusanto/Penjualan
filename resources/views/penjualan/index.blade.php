@extends('layouts.vendor.app')
@section('title','Data Penjualan')
@section('home-href')
  {{ url('dashboard') }}
@endsection
@section('home', 'Dashboard')
@section('breadcrumb','Penjualan')
@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                  <a href="{{ url('penjualan/create') }}" class="btn btn-sm btn-primary"><b>+</b> Tambah Transaksi</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div>
                    @if (session()->has('warning'))
                        <div class="alert alert-danger">
                            {{ session('warning') }}
                        </div>
                    @elseif (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                  </div>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>ID.</th>
                      <th>Tanggal</th>
                      <th>Nama Barang</th>
                      <th>Jumlah</th>
                      <th>Harga</th>
                      <th>Total</th>
                      <th>Status</th>
                      <th>Tanggal Lunas</th>
                      <th>Keterangan</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $item)
                      <tr class="text-center">
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->tgl_jual }}</td>
                        <td>{{ $item->barang->nama_brg }}</td>
                        <td>{{ $item->qty }}</td>
                        <td class="text-right">Rp. {{ str_replace(',', '.', number_format($item->barang->harga_jual)) }},00</td>
                        <td class="text-right">Rp. {{ str_replace(',', '.', number_format($item->barang->harga_jual * $item->qty)) }},00</td>
                        <td>
                          @if ($item->status == 0)
                            <span class="text-danger">Belum Lunas</span>
                          @else
                            <span class="text-success">Lunas</span>
                          @endif
                        </td>
                        <td>{{ $item->tgl_lunas }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>
                          <div class="btn-group">
                            <a href="{{ url('/penjualan/'.$item->id) }}" class="btn btn-sm btn-success">Edit</a>
                            <form method="POST" action="{{ url('/penjualan/'.$item->id) }}">
                              {{ csrf_field() }}
                              {{ method_field('DELETE') }}
                              <input type="submit" class="btn btn-sm btn-danger delete" value="Hapus">
                            </form>
                          </div>
                          
                        </td>
                      </tr>
                      @endforeach
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
      
        function formatNumber(n) {
          return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        $('.delete').click(function(e){
          e.preventDefault()
          let vm = $(e.target).closest('form')
          swal({
                title: "Hapus Penjualan?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya",
                cancelButtonText: "Batal",
              }).then(result => {
                if (result.value) {
                  vm.submit();
                } else if (
                  result.dismiss === swal.DismissReason.cancel
                ) {
                  swal("Batal", "Batal menghapus penjualan", "error");
                }
                swall.closeModal();
              });
        });
    </script>
@endsection