@extends('layouts.vendor.app') @section('title','Tambah Barang')
@section('home-href')
{{ url("barang") }}
@endsection @section('home', 'Barang') @section('breadcrumb','Tambah Barang')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Barang</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form
                        method="post"
                        action="{{ url('/barang') }}"
                        enctype="multipart/form-data"
                    >
                    @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="no_sku">Nomor SKU <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="no_sku"
                                    placeholder="Nomor SKU"
                                    autocomplete="off"
                                    name="no_sku"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <label for="nama_brg">Nama Barang <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="nama_brg"
                                    placeholder="Nama Barang"
                                    autocomplete="off"
                                    name="nama_brg"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <label for="merk">Merk</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="merk"
                                    placeholder="Merk"
                                    autocomplete="off"
                                    name="merk"
                                />
                            </div>
                            <div class="form-group">
                                <label for="kode_brg">Kode Barang <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="kode_brg"
                                    placeholder="Kode Barang"
                                    autocomplete="off"
                                    name="kode_brg"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <label for="warna">Warna</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="warna"
                                    placeholder="Warna"
                                    autocomplete="off"
                                    name="warna"
                                />
                            </div>
                            <div class="form-group">
                                <label for="qty">Jumlah Barang <span class="text-danger">*</span></label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="qty"
                                    name="qty"
                                    placeholder="Jumlah Barang"
                                    step="any"
                                    autocomplete="off"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <label for="harga_beli">Harga Beli <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="harga_beli"
                                    name="harga_beli"
                                    data-type="currency"
                                    placeholder="Harga Beli"
                                    autocomplete="off"
                                />
                            </div>
                            <div class="form-group">
                                <label for="harga_jual">Harga Jual <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="harga_jual"
                                    name="harga_jual"
                                    data-type="currency"
                                    placeholder="Harga Jual"
                                    autocomplete="off"
                                />
                            </div>
                            <div class="form-group">
                                <label for="diskon">Diskon Barang (%)</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="diskon"
                                    name="diskon"
                                    placeholder="Diskon Barang"
                                    step="any"
                                    autocomplete="off"
                                    value="0"
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
                            <div class="form-group">
                                <label for="gambar">Gambar</label>
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
                                <a
                                    href="{{ url('barang') }}"
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
        $('#barang').addClass('active');
    });
    // Jquery Dependency

    $("input[data-type='currency']").on({
        keyup: function () {
            formatCurrency($(this));
        },
        blur: function () {
            formatCurrency($(this), "blur");
        },
    });

    function formatNumber(n) {
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function formatCurrency(input, blur) {
        var input_val = input.val();

        if (input_val === "") {
            return;
        }

        var original_len = input_val.length;

        var caret_pos = input.prop("selectionStart");

        if (input_val.indexOf(",") >= 0) {
            var decimal_pos = input_val.indexOf(",");

            var left_side = input_val.substring(0, decimal_pos);
            var right_side = input_val.substring(decimal_pos);

            left_side = formatNumber(left_side);

            right_side = formatNumber(right_side);

            if (blur === "blur") {
                right_side += "00";
            }

            // Limit decimal to only 2 digits
            right_side = right_side.substring(0, 2);

            // join number by .
            input_val = left_side + "," + right_side;
        } else {
            // no decimal entered
            // add commas to number
            // remove all non-digits
            input_val = formatNumber(input_val);
            input_val = input_val;

            // final formatting
            if (blur === "blur") {
                input_val += ",00";
            }
        }

        // send updated string to input
        input.val(input_val);

        // put caret back in the right position
        var updated_len = input_val.length;
        caret_pos = updated_len - original_len + caret_pos;
        input[0].setSelectionRange(caret_pos, caret_pos);
    }
</script>
@endsection
