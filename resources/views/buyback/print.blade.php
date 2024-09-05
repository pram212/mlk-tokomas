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
            font-weight: bold;
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

        /* td,
        th,
        tr,
        table {
            border-collapse: collapse;
        } */

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
        .titleModal {
            background-color: black;
            padding: 5px;
            color: white;
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
            height: 650px;
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
        .top-buyback-modal {
            font-size: 13px;
            font-weight: bold;
            /* border-bottom: 1px solid rgba(99, 99, 99, 0.3); */
            padding-bottom: 10px;
        }

        .top-buyback-modal td {
            padding-right: 10px;
        }
        .partlife {
            margin-left: 30px;
            padding: 10px; width: 340px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div id="watermark" class="hidden-print"></div>
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
    <div style="max-width:150vh;margin:0 auto" style="position: relative">
        <div id="receipt-data">
            <div class="head">
                <div style="border-top: 1px solid black; border-bottom: 1px solid black; padding: 10px; width: 100%;">
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
                                            {{-- Nomor Invoice : {{$data->reference_no}} --}}
                                            Nomor Buyback : B00 - {{$data['code']}}
                                        </div>
                                        <div style="margin-top: 1.5rem">Jl. Diponegoro No. 105 (Jurusan Pasar) <br>
                                            Ketanggungan Timur - Brebes</div>
                                    </center>
                                </td>
                                <td style="text-align: right; vertical-align: top;">
                                    {{-- Ketanggungan, {{$data['created_at']}} --}}
                                    Ketanggungan, {{ $data['created_at_buyback']}}
                                    <br>
                                    {{-- Kepada : {{$data->customer->name}} --}}
                                    Kepada : Customer 1
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="npwp">
                        NPWP : 04.011.521.4.501.00
                    </div>
                </div>
                <table>
                    <tbody>
                    <div class="row mt-3" >
                            <div class="col-md-6" style="position: absolute; left: 0px;">
                                <table>
                                    <tr>
                                        <td>Deskripsi</td>
                                        <td>:</td>
                                        <td> ( {{ $data['product']['code'] }} ) - {{ $data['product']['name']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Harga Awal</td>
                                        <td>:</td>
                                        <td>Rp. {{ $hargaAwal }}</td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td>:</td>
                                        <td> {{ $data['buyback_desc']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Totalnya potongan</td>
                                        <td>:</td>
                                        <td>Rp. {{ $totalPotongan  }}</td>
                                    </tr>
                                    <tr>
                                        <td>Totalnya Buyback</td>
                                        <td>:</td>
                                        <td>Rp. {{ $harga }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div style="position:absolute; margin-left: 500px; margin-top:70px;">
                                <span   style="font-size: 100px;" id="gramasi">{{ $data['product_split_set_detail']['gramasi'] ?? $data['product']['gramasi']['gramasi'] ?? 0 }}
                                    <sup style="font-size: 20px;">{{ $data['product_split_set_detail']['mg'] ??
                                        $data['product']['mg'] ??
                                        0 }} gram</sup>
                                        <span style="font-size: 20px;"> {{ $data['product']['product_property']['code'] }}</span>
                                </span>
                            </div>
                            <div style="right:0px; position:absolute; margin-top: 70px;">
                                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(@$data['product']['image'])) }}"
                                width="280px" height="200px" alt="">
                            </div>
                        </tr>
                        </table>
                    </div>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>

    <script type="text/javascript">
       console.log('tes')
    </script>

</body>

</html>
