@extends('layouts.vendor.app') @section('title','Edit Pembeli')
@section('home-href')
{{ url("pembeli") }}
@endsection @section('home', 'Pembeli') @section('breadcrumb','Edit Pembeli')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Pembeli # {{ $data->id }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form
                        method="post"
                        action="{{ url('/pembeli/'.$data->id) }}"
                    >
                    @csrf
                    {{ method_field('PUT') }}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama">Nama <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="nama"
                                    placeholder="Nama"
                                    autocomplete="off"
                                    name="nama"
                                    value="{{ $data->nama }}"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No HP <span class="text-danger">*</span></label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="no_hp"
                                    name="no_hp"
                                    placeholder="No HP"
                                    step="any"
                                    autocomplete="off"
                                    value="{{ $data->no_hp }}"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <label for="no_hp">Alamat</label>
                                <textarea name="alamat" id="alamat" cols="3" class="form-control">{{ $data->alamat }}</textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                                <a
                                    href="{{ url('pembeli') }}"
                                    class="btn btn-danger"
                                    >Batal</a
                                >
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
@endsection @section('extra_javascript')
<script>
    $(document).ready(function (){
        $('#pembeli').addClass('active');
    });
</script>
@endsection
