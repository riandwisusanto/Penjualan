@extends('layouts.vendor.app') @section('title','Tambah Transaksi')
@section('home-href')
{{ url("penjualan") }}
@endsection @section('home', 'Penjualan') @section('breadcrumb','Tambah Transaksi')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Transaksi</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form
                        method="post"
                        action="{{ url('/penjualan') }}"
                        enctype="multipart/form-data"
                    >
                    @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="id_barang">Pilih Barang <span class="text-danger">*</span></label>
                                <select name="id_barang" id="id_barang" class="form-control" required>
                                    @foreach ($barang as $item)
                                        <option value="{{ $item->id }}" data-value="{{ $item->harga_jual }}" data-max="{{ $item->qty_brg }}">{{ $item->nama_brg }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
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
                                    value="1"
                                    autocomplete="off"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <label for="total">Total</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="total"
                                    name="total"
                                    data-type="currency"
                                    value="0,00"
                                    autocomplete="off"
                                    readonly
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
                                ></textarea>
                            </div>
                            <div>
                                <label for="lunas">Lunas</label>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="lunas" name="lunas" value="1" checked>
                                    <label class="form-check-label" for="radio2">Lunas</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="lunas" name="lunas" value="0">
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

    let total = '' + ($("#id_barang option:selected").attr('data-value') * $("#qty").val())
    $('#total').val(formatNumber(total) + ',00')

    $("#id_barang").on({
        change: function () {
            $("#qty").val(1)

            let harga = $("#id_barang option:selected").attr('data-value')
            $('#harga').val(formatNumber(harga) + ',00')

            let total = '' + ($("#id_barang option:selected").attr('data-value') * $("#qty").val())
            $('#total').val(formatNumber(total) + ',00')
        },
    });

    $("#qty").on({
        keyup: function () {
            let max = parseInt($("#id_barang option:selected").attr('data-max'))
            if($(this).val() > max)
                $(this).val(max)
            let total = '' + ($("#id_barang option:selected").attr('data-value') * $("#qty").val())
            $('#total').val(formatNumber(total) + ',00')
        }
    })

    function formatNumber(n) {
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
</script>
@endsection
