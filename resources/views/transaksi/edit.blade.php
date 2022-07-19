@extends('layouts.vendor.app') @section('title','Edit Transaksi')
@section('home-href')
{{ url("transaksi") }}
@endsection @section('home', 'Transaksi') @section('breadcrumb','Edit Transaksi')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Transaksi #{{ $data->id }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form
                        method="post"
                        action="{{ url('/transaksi/'.$data->id) }}"
                        enctype="multipart/form-data"
                    >
                    @csrf
                    {{ method_field('PUT') }}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="id_pembeli">Pembeli</label>
                                        <select name="id_pembeli" id="id_pembeli" class="form-control">
                                            <option value="0" {{ $data->id_pembeli == 0 ? 'selected' : ''}}>Pilih Pembeli</option>
                                            @foreach ($pembeli as $item)
                                                <option value="{{ $item->id }}" {{ $data->id_pembeli == $item->id ? 'selected' : ''}}
                                                    >{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group text-right">
                                        <a href="{{ url('pembeli/create') }}" class="btn btn-warning mt-4">+ Tambah Pembeli</a>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group text-right">
                                        <button type="button" onclick="tambahBarang()" class="btn btn-success mt-4">+ Tambah Barang</button>
                                    </div>
                                </div>
                            </div>
                            <table id="form-table" class="table table-bordered table-striped">
                                @foreach ($data->detail as $key => $detail)
                                    <tr id="tr-{{ $key }}">
                                        <td>
                                            <div class="form-group">
                                                <label for="id_barang">Pilih Barang <span class="text-danger">*</span></label>
                                                <select name="id_barang[]" id="id_barang-{{ $key }}" class="form-control" required>
                                                    @foreach ($barang as $item)
                                                        <option value="{{ $item->id }}" 
                                                            data-value="{{ $item->harga_jual }}" 
                                                            data-max="{{ $item->qty_brg }}"
                                                            data-disc="{{ $item->diskon }}"
                                                            {{ $detail->id_barang == $item->id ? 'selected' : ''}}
                                                            >{{ $item->nama_brg }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <label for="harga">Harga</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="harga-{{ $key }}"
                                                    name="harga[]"
                                                    data-type="currency"
                                                    value="0,00"
                                                    autocomplete="off"
                                                    readonly
                                                />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <label for="qty">Jumlah <span class="text-danger">*</span></label>
                                                <input
                                                    type="number"
                                                    class="form-control"
                                                    id="qty-{{ $key }}"
                                                    name="qty[]"
                                                    placeholder="Jumlah Barang"
                                                    step="any"
                                                    value="1"
                                                    autocomplete="off"
                                                    required
                                                />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <label for="total">Total</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="total-{{ $key }}"
                                                    name="total[]"
                                                    data-type="currency"
                                                    value="0,00"
                                                    autocomplete="off"
                                                    readonly
                                                />
                                            </div>
                                        </td>
                                        @if($key > 0)
                                            <td>
                                                <div class="form-group">
                                                    <label for=""></label>
                                                    <button type="button" class="btn btn-danger" onclick="hapusTable('<?= $key ?>')">X</button>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </table>
                            <div class="form-group">
                                <label for="total_all">Total Keseluruhan</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="total_all"
                                    data-type="currency"
                                    value="0,00"
                                    autocomplete="off"
                                    readonly
                                />
                            </div>
                            <div>
                                <label for="lunas">Lunas</label>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="lunas" name="lunas" value="1" {{ $data->status == 1 ? 'checked' : ''}}>
                                    <label class="form-check-label" for="radio2">Lunas</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="lunas" name="lunas" value="0" {{ $data->status == 0 ? 'checked' : ''}}>
                                    <label class="form-check-label" for="radio2">Belum Lunas</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ket">Keterangan</label>
                                <textarea
                                    name="ket"
                                    id="ket"
                                    rows="3"
                                    class="form-control"
                                    autocomplete="off"
                                >{{ $data->keterangan }}</textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                                <a
                                    href="{{ url('transaksi') }}"
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
        $('#transaksi').addClass('active');
    });

    var detail = JSON.parse('<?= $data->detail ?>')
    var jumlahBarang = JSON.parse('<?= $barang ?>').length - detail.length
    for (let index = 0; index < detail.length; index++) {
        $("#qty-"+index+"").val(detail[index].qty)
        let qty_awal = parseInt($("#id_barang-"+index+" option:selected").attr('data-max')) + parseInt($("#qty-"+index).val())
        let id_awal  = $("#id_barang-"+index).val()

        let harga = $("#id_barang-"+index+" option:selected").attr('data-value') - ($("#id_barang-"+index+" option:selected").attr('data-value') * $("#id_barang-"+index+" option:selected").attr('data-disc') / 100)
        $('#harga-'+index).val(formatNumber(''+harga) + ',00')

        let total = '' + (harga * $("#qty-"+index+"").val())
        $('#total-'+index).val(formatNumber(total) + ',00')

        totalAll()

        $("#id_barang-"+index+"").on({
            change: function () {
                $("#qty-"+index+"").val(1)

                let harga = $("#id_barang-"+index+" option:selected").attr('data-value') - ($("#id_barang-"+index+" option:selected").attr('data-value') * $("#id_barang-"+index+" option:selected").attr('data-disc') / 100)
                $('#harga-'+index).val(formatNumber(''+harga) + ',00')

                let total = '' + (harga * $("#qty-"+index+"").val())
                $('#total-'+index).val(formatNumber(total) + ',00')

                totalAll()
            },
        });

        $("#qty-"+index+"").on({
            change: function () {
                let max = parseInt($("#id_barang-"+index+" option:selected").attr('data-max'))
                if($("#id_barang-"+index+"").val() == id_awal)
                    max = qty_awal
                if($(this).val() > max)
                    $(this).val(max)
                let total = '' + (($("#id_barang-"+index+" option:selected").attr('data-value') - ($("#id_barang-"+index+" option:selected").attr('data-value') * $("#id_barang-"+index+" option:selected").attr('data-disc') / 100)) * $("#qty-"+index+"").val())
                $('#total-'+index).val(formatNumber(total) + ',00')

                totalAll()
            }
        })
    }

    function formatNumber(n) {
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function totalAll(){
        let qty_all      = $("input[name='qty[]']").map(function(){return $(this).val();}).get();
        let harga_barang = $("select[name='id_barang[]'] option:selected").map(function(){return $(this).attr('data-value');}).get();
        let diskon_barang= $("select[name='id_barang[]'] option:selected").map(function(){return $(this).attr('data-disc');}).get();
        
        var total_all  = 0
        var is = 0
        qty_all.forEach(row => {
            total_all += row * (harga_barang[is] - (harga_barang[is] * diskon_barang[is] / 100))
            is++
        })
        $('#total_all').val(formatNumber(""+total_all) + ',00')
    }

    var i = $("input[name='qty[]']").length - 1
    function tambahBarang() {
        if(jumlahBarang < 1)
            swal('Data Barang Habis')
        else{
            i += 1
            $('#form-table').append(`
                <tr id="tr-${i}">
                    <td>
                        <div class="form-group">
                            <label for="id_barang">Pilih Barang <span class="text-danger">*</span></label>
                            <select name="id_barang[]" id="id_barang-${i}" class="form-control" required>
                                @foreach ($barang as $item)
                                    <option value="{{ $item->id }}" data-value="{{ $item->harga_jual }}" data-max="{{ $item->qty_brg }}" data-disc="{{ $item->diskon }}">{{ $item->nama_brg }}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input
                                type="text"
                                class="form-control"
                                id="harga-${i}"
                                name="harga[]"
                                data-type="currency"
                                value="0,00"
                                autocomplete="off"
                                readonly
                            />
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="qty">Jumlah <span class="text-danger">*</span></label>
                            <input
                                type="number"
                                class="form-control"
                                id="qty-${i}"
                                name="qty[]"
                                placeholder="Jumlah Barang"
                                step="any"
                                value="1"
                                autocomplete="off"
                                required
                            />
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="total">Total</label>
                            <input
                                type="text"
                                class="form-control"
                                id="total-${i}"
                                name="total[]"
                                data-type="currency"
                                value="0,00"
                                autocomplete="off"
                                readonly
                            />
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for=""></label>
                            <button type="button" class="btn btn-danger" onclick="hapusTable(${i})">X</button>
                        </div>
                    </td>
                </tr>
                `)
            let harga = $("#id_barang-"+i+" option:selected").attr('data-value')
            $('#harga-'+i).val(formatNumber(harga) + ',00')

            let total_i = '' + ($("#id_barang-"+i+" option:selected").attr('data-value') * $("#qty-"+i+"").val())
            $('#total-'+i).val(formatNumber(total_i) + ',00')

            totalAll()

            $("#id_barang-"+i+"").on({
                change: function () {
                    $("#qty"+i+"").val(1)

                    let harga = $("#id_barang-"+i+" option:selected").attr('data-value') - ($("#id_barang-"+i+" option:selected").attr('data-value') * $("#id_barang-"+i+" option:selected").attr('data-disc') / 100)
                    $("#harga-"+i+"").val(formatNumber(''+harga) + ',00')

                    let total = '' + (harga * $("#qty-"+i+"").val())
                    $('#total-'+i).val(formatNumber(total) + ',00')

                    totalAll()
                },
            });

            $("#qty-"+i+"").on({
                change: function () {
                    let max = parseInt($("#id_barang-"+i+" option:selected").attr('data-max'))
                    if($(this).val() > max)
                        $(this).val(max)
                    let total = '' + (($("#id_barang-"+i+" option:selected").attr('data-value') - ($("#id_barang-"+i+" option:selected").attr('data-value') * $("#id_barang-"+i+" option:selected").attr('data-disc') / 100)) * $("#qty-"+i+"").val())
                    $('#total-'+i).val(formatNumber(total) + ',00')

                    totalAll()
                }
            })
            jumlahBarang -= 1
        }
    }

    function hapusTable(row) {
        console.log(row)
        // $('#form-table tr:eq('+row+')').remove()
        $('#tr-'+row).remove()
        jumlahBarang += 1

        totalAll()
    }
</script>
@endsection
