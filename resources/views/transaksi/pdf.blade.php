<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>Struk Transaksi #{{$data->id}}</title>

    <style>
        @media print {
            .page-break {
                display: block;
                page-break-before: always;
            }
        }

        #invoice-POS {
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
            padding: 2mm;
            margin: 0 auto;
            width: 100mm;
            background: #FFF;
        }

        #invoice-POS ::selection {
            background: #f31544;
            color: #FFF;
        }

        #invoice-POS ::moz-selection {
            background: #f31544;
            color: #FFF;
        }

        #invoice-POS h1 {
            font-size: 4em;
            color: #222;
        }

        #invoice-POS h2 {
            font-size: 1.5em;
        }

        #invoice-POS h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }

        #invoice-POS p {
            font-size: .9em;
            color: #666;
            line-height: 1.2em;
        }

        #invoice-POS #top,
        #invoice-POS #mid,
        #invoice-POS #bot {
            /* Targets all id with 'col-' */
            border-bottom: 1px solid #EEE;
        }

        #invoice-POS #top {
            min-height: 100px;
        }

        #invoice-POS #mid {
            min-height: 80px;
        }

        #invoice-POS #bot {
            min-height: 50px;
        }

        #invoice-POS #top .logo {
            height: 40px;
            width: 150px;
            background: url(https://www.sistemit.com/wp-content/uploads/2020/02/SISTEMITCOM-smlest.png) no-repeat;
            background-size: 150px 40px;
        }

        #invoice-POS .clientlogo {
            float: left;
            height: 60px;
            width: 60px;
            background: url(https://www.sistemit.com/wp-content/uploads/2020/02/SISTEMITCOM-smlest.png) no-repeat;
            background-size: 60px 60px;
            border-radius: 50px;
        }

        #invoice-POS .info {
            display: block;
            margin-left: 0;
        }

        #invoice-POS .title {
            float: right;
        }

        #invoice-POS .title p {
            text-align: right;
        }

        #invoice-POS table {
            width: 100%;
            border-collapse: collapse;
        }

        #invoice-POS .tabletitle {
            font-size: .7em;
            background: #EEE;
        }

        #invoice-POS .service {
            border-bottom: 1px solid #EEE;
        }

        #invoice-POS .item {
            width: 24mm;
        }

        #invoice-POS .itemtext {
            font-size: .9em;
        }

        #invoice-POS #legalcopy {
            margin-top: 5mm;
        }
    </style>

    <script>
        window.console = window.console || function (t) { };
    </script>



    <script>
        if (document.location.search.match(/type=embed/gi)) {
            window.parent.postMessage("resize", "*");
        }
    </script>


</head>

<body translate="no">


    <div id="invoice-POS">

        <div id="mid">
            <div class="info">
                <h2>Struk Transaksi #{{$data->id}}</h2>
                <p>
                    Toko {{ App\Models\Config::where('id', 1)->first()->name }} <br>
                    {{ $data->tgl_transaksi }}
                    @if($data->pembeli != null)
                    <br> Member : {{$data->pembeli->nama}}
                    @endif
                </p>
            </div>
        </div>
        <!--End Invoice Mid-->

        <div id="bot">

            <div id="table">
                <table>
                    <tr class="tabletitle">
                        <td class="item">
                            <h2>Item</h2>
                        </td>
                        <td class="Hours">
                            <h2>Qty</h2>
                        </td>
                        <td class="Hours">
                            <h2>Diskon</h2>
                        </td>
                        <td class="Rate" style="text-align: right; padding-right: 15px;">
                            <h2>Sub Total</h2>
                        </td>
                    </tr>

                    @foreach($data->detail as $detail)
                        <tr class="service">
                            <td class="tableitem">
                                <p class="itemtext">{{ $detail->barang->nama_brg }}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">{{ $detail->qty }}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">{{ $detail->diskon }}%</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext" style="text-align: right; padding-right: 15px;">Rp. {{ str_replace(',', '.', number_format($detail->qty * ($detail->barang->harga_jual - ($detail->barang->harga_jual * $detail->diskon / 100)))) }},00</p>
                            </td>
                        </tr>
                    @endforeach

                    <tr class="tabletitle">
                        <td></td>
                        <td></td>
                        <td class="Rate">
                            <h2>Total</h2>
                        </td>
                        <td class="payment">
                            <h2 style="text-align: right; padding-right: 15px;">Rp. {{ str_replace(',', '.', number_format($data->total)) }},00</h2>
                        </td>
                    </tr>

                </table>
            </div>
            <!--End Table-->

            <div id="legalcopy">
                <p class="legal"><strong>Terimakasih Telah Berbelanja!</strong><br> Barang yang sudah dibeli tidak dapat
                    dikembalikan. <br> Jangan lupa berkunjung kembali
                </p>
            </div>

        </div>
        <!--End InvoiceBot-->
    </div>
    <!--End Invoice-->

</body>

</html>