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
            height: 650px;
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
        .top-buyback-modal {
            font-size: 13px;
            font-weight: bold;
            border-bottom: 1px solid rgba(99, 99, 99, 0.3);
            padding-bottom: 10px;
        }

        .top-buyback-modal td {
            padding-right: 10px;
        }
        .partlife {
            margin-left: 30px; border: 1px solid #ccc; padding: 10px; width: 340px; margin-top: 10px;
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
                <table style="width: 100%" id="table_head">
                    <tbody>
                        <tr>
                            <td style="width:300px;min-width: 300px;">
                                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(@$invoice_setting->invoice_logo)) }}"
                                width="200px" alt="">
                            </td>
                            <td style="vertical-align: top;">
                                <center style="font-size: 30px;font-weight:bold; padding-top: 35px;">
                                    Perhitungan BuyBack
                                </center>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table>
                    <tbody>
                        {{-- @php
                            dd($data);
                        @endphp --}}
                        <tr>
                            <td>Catatan Penjualan</td>
                            <td>:</td>
                            <td><span id="sale_note">{{ $data['sale']['sale_note']}}</span></td>
                        </tr>
                        <tr>
                            <td>Gramasi</td>
                            <td>:</td>
                            <td>
                                <span id="gramasi">{{ $data['product_split_set_detail']['gramasi'] ?? $data['product']['gramasi']['gramasi'] ?? 0 }}
                                    <sup>{{ $data['product_split_set_detail']['mg'] ??
                                        $data['product']['mg'] ??
                                        0 }} gram</sup>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Sifat Barang</td>
                            <td>:</td>
                            <td><span id="product_property">
                                @if ($data['product']['product_property']['code'] && $data['product']['product_property']['description'])
                                    {{ $data['product']['product_property']['code'] }} - {{ $data['product']['product_property']['description']}}
                                @else
                                    "-"
                                @endif
                            </span></td>
                        </tr>
                        <tr>
                            <td>Invoice</td>
                            <td>:</td>
                            <td><span id="invoice_number_sales">
                                {{$data['sale']['invoice_number'] }}</span></td>
                        </tr>
                        <tr>

                               <div class="row mt-3" >
                            <div class="col-md-6" style="position: absolute; left: 0px;">
                                <div class="row p-2 partlife">
                                    <span class="titleModal">Deskripsi</span>
                                    <p id="modal_desc_value">
                                        ( {{ $data['product']['code'] }} ) - {{ $data['product']['name']}}
                                    </p>
                                </div>
                                <div class="row p-2 partlife">
                                    <span class="titleModal">Harga</span>
                                    <p id="modal_price_value">Rp. {{ $harga }}</p>
                                </div>
                            </div>
                            <div style="margin: 230px 0xpx 0px 20px;width:50%; position: absolute;">
                                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(@$data['product']['image'])) }}"
                                width="380px" height="180px" alt="">
                            </div>

                            <div class="col-md-6 p-2" style="position: absolute; right: 0px;">
                                <div class="row mb-2">
                                    <div class="col-md-6">Harga Awal</div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="modal_price_default" readonly value="{{ $hargaAwal }}">
                                        <input type="hidden" class="form-control" id="product_id">
                                        <input type="hidden" class="form-control" id="product_code">
                                        <input type="hidden" class="form-control" id="final_price">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">Potongan</div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="modal_discount" readonly value="{{ $potongan }}">
                                        <div class="form-group form-check" title="Potongan akan dikalikan 2 jika ini diceklis!">
                                            <input type="checkbox" class="form-check-input" id="barang_meleot">
                                            <label class="form-check-label" for="barang_meleot">Barang meleot dekok</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">Biaya tambahan</div>
                                    <div class="col-md-6">
                                        <input type="int" class="form-control" id="modal_additional_cost" value="0" readonly>
                                    </div>

                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">Keterangan</div>
                                    <div class="col-md-6"><input type="text" class="form-control" id="modal_description" >
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">Totalnya potongan</div>
                                    <div class="col-md-6"><input type="text" class="form-control" id="modal_total_discount" value="{{ $totalPotongan }}"
                                             readonly>
                                    </div>
                                </div>
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
