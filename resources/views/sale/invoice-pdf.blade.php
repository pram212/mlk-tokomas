<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="{{url('public/logo', $general_setting->site_logo)}}" />
    <title>{{$general_setting->site_title}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <style type="text/css">
        * {
            font-size: 14px;
            line-height: 24px;
            font-family: 'Ubuntu', sans-serif;
            text-transform: capitalize;
        }

        .btn {
            padding: 7px 10px;
            text-decoration: none;
            border: none;
            display: block;
            text-align: center;
            margin: 7px;
            cursor: pointer;
        }

        .btn-info {
            background-color: #999;
            color: #FFF;
        }

        .btn-primary {
            background-color: #6449e7;
            color: #FFF;
            width: 100%;
        }

        td,
        th,
        tr,
        table {
            border-collapse: collapse;
        }

        table {
            width: 100%;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .center {
            text-align: center;
        }

        small {
            font-size: 11px;
        }

        .kadar {
            display: flex;
            justify-content: center;
            font-size: 12px;
            text-align: center;
            font-weight: bold;
        }

        .kadar h1 {
            font-size: 40px;
            margin: 0;

        }

        .kadar sup {
            font-size: 15px;
            vertical-align: top;
            margin-left: 3px;
            display: inline-block;
            position: relative;
            top: -10px;
        }

        .kadar span {
            font-size: 20px;
            vertical-align: bottom;
            margin-left: 3px;
            text-transform: lowercase;
        }

        .sifat-barang {
            font-size: 12px;
            text-align: right;
            font-weight: bold;
            margin-top: 10px;
            margin-right: 10px;
        }


        @media print {
            * {
                font-size: 12px;
                line-height: 20px;
            }

            td,
            th {
                padding: 5px 0;
            }

            .hidden-print {
                display: none !important;
            }

            @page {
                margin: 0;
            }

            body {
                margin: 0.5cm;
                margin-bottom: 1.6cm;
            }

            tbody::after {
                content: '';
                display: block;
                page-break-after: always;
                page-break-inside: always;
                page-break-before: avoid;
            }
        }

        #table_body td,
        #table_body th {
            border: 1px solid #ccc;
        }

        #table_body td {
            /* Atur lebar maksimum untuk sel item */
            max-width: 300px;
            /* Sembunyikan teks yang melebihi lebar maksimum */
            overflow: hidden;
            /* Tambahkan elipsis untuk menandakan bahwa teks dipotong */
            text-overflow: ellipsis;
            /* Hindari pemisahan kata yang terlalu panjang */
            /* white-space: nowrap; */
        }

        .npwp {
            font-size: 12px;
            text-align: right;
            /* margin-top: 10px; */
            font-weight: bold;
        }

        #receipt-data {
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .total_harga {
            font-weight: bold;
            font-style: italic;
            text-align: center;
            padding: 10px;

            /* color: #1858D4; */
        }

        .note {
            color: red;
            font-size: 12px;
            font-weight: bold;
            font-style: italic;
            vertical-align: top;
        }

        .note_thanks {
            font-size: 12px;
            font-weight: bold;
            font-style: italic;
            text-align: right;
            vertical-align: top;
        }

        .title {
            font-style: italic;
        }

        .total_price {
            font-weight: bold;
            color: #1858D4;
            font-size: 25px;
            margin-top: 10px;
        }

        .in_words {
            font-weight: bold;
            font-style: italic;
            font-size: 17px;
        }

        #watermark {
            background-image: url("data:image/png;base64,{{ base64_encode(file_get_contents(@$invoice_setting->invoice_logo_watermark)) }}");
            background-repeat: no-repeat;
            background-position: center;
            background-size: 25%;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.5;
            z-index: -1;
            pointer-events: none;
            /* Ensure the watermark does not interfere with other elements */
        }

        #nota-penjualan {
            font-size: 12px;
            text-align: left;
            display: block;
            margin-top: 10px;
            margin-left: 10px;
        }

        #catatan {
            font-size: 12px;
            text-align: left;
            display: block;
            margin-top: 10px;
            margin-left: 10px;
        }

        .promo-thr {
            font-size: 12px;
            text-align: left;
            display: block;
            margin-top: -20px;
            margin-left: -15px;
        }

        .promo-thr span {
            font-size: 14px;
            color: red;
            text-align: left;
            display: block;
            margin-top: 10px;
            margin-left: -20px;
        }

        .promo-thr li {
            font-size: 12px;
            text-align: left;
        }
    </style>
</head>

<body>
    @if($mode != 'print')<div id="watermark" class="hidden-print"></div>@endif
    <div style="max-width:400px;margin:0 auto">

        @if($mode != 'print')
        <div class="hidden-print">
            <table>
                <tr>
                    <td><a href="{{ url()->previous() }}" class="btn btn-info"><i class="fa fa-arrow-left"></i>
                            {{trans('file.Back')}}</a> </td>
                    <td><a target="_BLANK" href="{{ url('sales-print/'.$data->id) }}" class="btn btn-primary"><i
                                class="dripicons-print"></i>{{trans('file.Print')}}</a></td>
                </tr>
            </table>
            <br>
        </div>
        @endif
    </div>
    <div style="max-width:150vh;margin:0 auto">
        <div id="receipt-data">
            <div class="head">
                <table style="width: 100%" id="table_head">
                    <tbody>
                        <tr>
                            <td style="width:300px;min-width: 300px;">
                                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(@$invoice_setting->invoice_logo)) }}"
                                    width="200px" alt="">
                            </td>
                            <td style="vertical-align: top;">
                                <center>
                                    <div>
                                        Nomor Invoice : {{$data->reference_no}}
                                    </div>
                                    <div style="margin-top: 1.5rem">Jl. Diponegoro No. 105 (Jurusan Pasar) <br>
                                        Ketanggungan Timur - Brebes</div>
                                </center>
                            </td>
                            <td style="text-align: right; vertical-align: top;">
                                Ketanggungan, {{$data->created_at}}
                                <br>
                                Kepada : {{$data->customer->name}}
                                <br>
                                {{ $data->customer->address }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="npwp">
                    NPWP : 04.011.521.4.501.00
                </div>
                <table style="width: 100%;" id="table_body">
                    <thead>
                        <tr>
                            <th class="title">Gambar</th>
                            <th class="title">Catatan</th>
                            <th class="title" colspan="2">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="center" style="height:200px;">
                                @php
                                $gambar_produk = $data->productSales[0]->product->image ?? '';
                                @endphp
                                @if($gambar_produk != '')
                                <img src="data:image/png;base64,{{ base64_encode(file_get_contents($gambar_produk)) }}"
                                    width="200px" alt="">
                                @endif

                                <span id="nota-penjualan">{{ $data->sale_note }}</span>
                            </td>
                            <td class=" title" style="vertical-align: top;font-weight:bold">
                                <div id="catatan">
                                    -Sudah Diperiksa Sendiri <br>
                                    -Timbang Ulang <br>
                                    {{ $goldContentConversion }}
                                    <br>
                                    <br>
                                    <ul class="promo-thr">
                                        <li>H : {{ number_format($pricePerGram,2) }}/Gram</li>
                                    </ul>
                                    <ul class="promo-thr">
                                        <span>{{ $data->productSales[0]->promo_name }}</span>
                                        <li>R : {{ number_format($potongan,2) }}/Gram</li>
                                    </ul>
                                    <span>Kalau rusak dekok, pesok, mleot Potongan
                                        {{number_format($potongan*2,2)}}/gram</span>
                                </div>
                            </td>
                            <td class="title" style="vertical-align: top;font-weight:bold;" colspan="2">
                                <ul>
                                    <li> Kadar : {{ $data->productSales[0]->product->gold_content }}</li>

                                    <li>Deskripsi Barang : {{$data->productSales[0]->product->name.'
                                        ('.($data->productSales[0]->productSplitSetDetail ?
                                        $data->productSales[0]->productSplitSetDetail->split_set_code :
                                        $data->productSales[0]->product->code).')'
                                        }}</li>
                                </ul><br>


                                <div class="kadar">
                                    <h1>
                                        {{$gramasi}}
                                        <sup>
                                            {{$miligram}}
                                        </sup><span>gram</span>
                                    </h1>
                                </div>
                                <div class="sifat-barang" style="margin-right: 100px; font-size: 40px;">
                                    {{ $sifatBarang }}
                                </div>


                            </td>

                        </tr>
                        <tr>
                            <td style="border:0" colspan="2">
                                <div class="total_price">
                                    {{trans('file.Paid Amount')}} : Rp. {{$totalPrice}}
                                </div>
                                <br>
                                <div class="in_words">
                                    {{trans('file.In Words')}} :
                                    {{str_replace("-"," ",$numberInWords)}}
                                </div>
                            </td>
                            <td class="total_harga">
                                Barcode product <br>
                                @php
                                $urlProduct = url('view-product/' . @$data->productSales[0]->product->id);
                                @endphp
                                @if($mode != 'print')
                                <div class="hidden-print">
                                    {!! QrCode::size(70)->generate($urlProduct) !!}
                                </div>
                                @else
                                <img
                                    src="data:image/png;base64, {!! base64_encode(QrCode::size(70)->generate($urlProduct)) !!} ">
                                @endif
                            </td>
                            <td class="total_harga">
                                Barcode Invoice <br>
                                @php
                                $urlInvoice = url('view-invoice/' . $data->reference_no);
                                @endphp
                                @if($mode != 'print')
                                <div class="hidden-print">
                                    {!! QrCode::size(70)->generate($urlInvoice) !!}
                                </div>
                                @else
                                <img
                                    src="data:image/png;base64, {!! base64_encode(QrCode::size(70)->generate($urlInvoice)) !!} ">
                                @endif
                            </td>

                        </tr>
                        <tr style="height: 50px;">
                            <td colspan="5" style="border:0px">

                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" style="border:0px">
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border: 0; padding: 5px;">
                                <p class="note">Perhatian : </p>
                                <p class="note">
                                    - Jika barang dijual ongkos bikin hilang. <br>
                                    - Harga jual dan beli berbeda <br>
                                    - Permata yang pecah, rusak tidak diterima<br>
                                </p>
                            </td>
                            <td class="note_thanks" colspan="2" style="border: 0px">
                                Terimakasih</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        localStorage.clear();
    </script>

</body>

</html>
