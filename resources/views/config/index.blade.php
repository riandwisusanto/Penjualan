@extends('layouts.vendor.app') @section('title','Pengaturan')
@section('home-href')
{{ url("dashboard") }}
@endsection @section('home', 'Dashboard') @section('breadcrumb','Pengaturan')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Pengaturan</h3>
                    </div>
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
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form
                        method="post"
                        action="{{ url('/pengaturan') }}"
                        enctype="multipart/form-data"
                    >
                    @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama Web <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    autocomplete="off"
                                    name="name"
                                    value="{{ $data->name }}"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <img src="{{ url('storage/logo/'.$data->logo) }}" class="img-fluid" width="100" height="100">
                            </div>
                            <div class="form-group">
                                <label for="gambar">Ubah Logo</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input
                                            type="file"
                                            class="form-control"
                                            id="gambar"
                                            accept="image/*"
                                            name="gambar"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
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
      $('#pengaturan').addClass('active');
  });
</script>
@endsection