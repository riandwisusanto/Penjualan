@extends('layouts.vendor.app')
@section('title','Data Pembeli')
@section('home-href')
  {{ url('dashboard') }}
@endsection
@section('home', 'Dashboard')
@section('breadcrumb','Pembeli')
@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                  <a href="{{ url('pembeli/create') }}" class="btn btn-sm btn-primary"><b>+</b> Tambah</a>
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
                      <th>Nama</th>
                      <th>Alamat</th>
                      <th>No. HP</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $item)
                        <tr class="text-center">
                          <td>{{ $item->id }}</td>
                          <td>{{ $item->nama }}</td>
                          <td>{{ $item->alamat }}</td>
                          <td>{{ $item->no_hp }}</td>
                          <td>
                            <div class="btn-group">
                              <a href="{{ url('/pembeli/'.$item->id) }}" class="btn btn-sm btn-success">Edit</a>
                              <form method="POST" action="{{ url('/pembeli/'.$item->id) }}">
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
          $('#pembeli').addClass('active');
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
                title: "Hapus Pembeli?",
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
                  swal("Batal", "Batal menghapus pembeli", "error");
                }
                swall.closeModal();
              });
        });
    </script>
@endsection