@extends('layouts.vendor.app')
@section('title','Data Transaksi')
@section('home-href')
  {{ url('dashboard') }}
@endsection
@section('home', 'Dashboard')
@section('breadcrumb','Transaksi')
@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                  <a href="{{ url('transaksi/create') }}" class="btn btn-sm btn-primary"><b>+</b> Tambah Transaksi</a>
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
                      <th>Nama Pembeli</th>
                      <th>Total Harga</th>
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
                        <td>{{ $item->tgl_transaksi }}</td>
                        <td>{{ $item->pembeli->nama }}</td>
                        <td class="text-right">Rp. {{ str_replace(',', '.', number_format($item->total)) }},00</td>
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
                            <a href="{{ url('/transaksi/'.$item->id) }}" class="btn btn-sm btn-success">Edit</a>
                            <form method="POST" action="{{ url('/transaksi/'.$item->id) }}">
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
          $('#transaksi').addClass('active');
      });
        $("#example1").DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      
        function formatNumber(n) {
          return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        $('.delete').click(function(e){
          e.preventDefault()
          let vm = $(e.target).closest('form')
          swal({
                title: "Hapus transaksi?",
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
                  swal("Batal", "Batal menghapus transaksi", "error");
                }
                swall.closeModal();
              });
        });
    </script>
@endsection