@extends('layouts.vendor.app') @section('title','Tambah Barang')
@section('home-href')
{{ url("penjualan") }}
@endsection @section('home', 'Penjualan') @section('breadcrumb','Edit Transaksi')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Transaksi # {{ $data->id }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form
                        method="post"
                        action="{{ url('/penjualan/'.$data->id) }}"
                        enctype="multipart/form-data"
                    >
                    @csrf
                    {{ method_field('PUT') }}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="id_barang">Pilih Barang <span class="text-danger">*</span></label>
                                <select name="id_barang" id="id_barang" class="form-control" required>
                                    @foreach ($barang as $item)
                                        <option 
                                            value="{{ $item->id }}" 
                                            data-value="{{ $item->harga_jual }}"
                                            {{ ($data->id_barang == $item->id) ? 'selected' : '' }}
                                        >
                                            {{ $item->nama_brg }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="harga"
                                    name="harga"
                                    data-type="currency"
                                    value="0,00"
                                    autocomplete="off"
                                    readonly
                                />
                            </div>
                            <div class="form-group">
                                <label for="qty">Jumlah <span class="text-danger">*</span></label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="qty"
                                    name="qty"
                                    placeholder="Jumlah Barang"
                                    step="any"
                                    value="{{ $data->qty }}"
                                    autocomplete="off"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <label for="ket">Keterangan</label>
                                <textarea
                                    name="ket"
                                    id="ket"
                                    rows="3"
                                    class="form-control"
                                    autocomplete="off"
                                >{{ $data->ket }}</textarea>
                            </div>
                            <div>
                                <label for="lunas">Lunas</label>
                                <div class="form-check">
                                    <input 
                                        type="radio" 
                                        class="form-check-input" 
                                        id="lunas" name="lunas" 
                                        value="1"
                                        {{ ($data->status == 1) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="radio2">Lunas</label>
                                </div>
                                <div class="form-check">
                                    <input 
                                        type="radio" 
                                        class="form-check-input" 
                                        id="lunas" 
                                        name="lunas" 
                                        value="0"
                                        {{ ($data->status == 0) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="radio2">Belum Lunas</label>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                                <a
                                    href="{{ url('penjualan') }}"
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
        $('#penjualan').addClass('active');
    });
    // Jquery Dependency
    let harga = $("#id_barang option:selected").attr('data-value')
    $('#harga').val(formatNumber(harga) + ',00')

    $("#id_barang").on({
        change: function () {
            let harga = $("#id_barang option:selected").attr('data-value')
            $('#harga').val(formatNumber(harga) + ',00')
        },
    });

    function formatNumber(n) {
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
</script>
@endsection
