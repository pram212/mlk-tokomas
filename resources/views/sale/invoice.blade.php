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
            max-width: 200px;
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

            color: #1858D4;
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
    </style>
</head>

<body>

    <div style="max-width:400px;margin:0 auto">
        @if(preg_match('~[0-9]~', url()->previous()))
        @php $url = '../../pos'; @endphp
        @else
        @php $url = url()->previous(); @endphp
        @endif
        <div class="hidden-print">
            <table>
                <tr>
                    <td><a href="{{$url}}" class="btn btn-info"><i class="fa fa-arrow-left"></i>
                            {{trans('file.Back')}}</a> </td>
                    <td><button onclick="window.print();" class="btn btn-primary"><i class="dripicons-print"></i>
                            {{trans('file.Print')}}</button></td>
                </tr>
            </table>
            <br>
        </div>
    </div>
    <div style="max-width:150vh;margin:0 auto">


        <div id="receipt-data">
            <div class="head">
                <table style="width: 100%" id="table_head">
                    <tbody>
                        <tr>
                            <td style="width:300px;min-width: 300px"><img
                                    src="{{ asset('public/logo/bima_text_1.png') }}" width="250px"></td>
                            <td>
                                <center>
                                    <div>Jl. Diponegoro No. 105 (Jurusan Pasar) <br>
                                        Ketanggungan Timur - Brebes</div>
                                </center>
                            </td>
                            <td style="text-align: right; vertical-align: top;">
                                Ketanggungan, {{$lims_sale_data->created_at}}
                                <br>
                                Kepada : {{$lims_customer_data->name}}
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
                            <th class="title">Item</th>
                            <th class="title">Gambar</th>
                            <th class="title">Keterangan</th>
                            <th class="title">Berat (Gram)</th>
                            <th class="title">Harga (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="center title" style="vertical-align: top;font-weight:bold">{{
                                $lims_sale_data['total_qty'] }} pcs</td>
                            <td class="center"><img src="{{ asset($lims_product_sale_data[0]['product']['image']) }}"
                                    alt="" width="200px"></td>
                            <td class="title" style="vertical-align: top;font-weight:bold">{{
                                $lims_product_sale_data[0]['product']['name'] }}</td>
                            <td class="center title" style="vertical-align: top;font-weight:bold">{{
                                $lims_product_sale_data[0]['product']->gramasi['gramasi'] }} gram</td>
                            @php
                            $totalPrice = number_format(
                            floatval(str_replace(',', '.', $lims_product_sale_data[0]['product']['price'])),
                            2,
                            ',',
                            '.'
                            );
                            @endphp
                            <td class="center title" style="vertical-align: top; font-weight: bold;">
                                {{$totalPrice }}
                            </td>

                        </tr>
                        <tr>
                            <td style="font-weight: bold; font-style: italic;border:0" colspan="3">
                                {{trans('file.In Words')}}:
                                <span>{{str_replace("-"," ",$numberInWords)}}</span>
                            </td>
                            <td class="total_harga">Total Harga</td>
                            <td class="total_harga">{{$totalPrice }}</td>
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
                            <td colspan="3" style="border: 0; padding: 5px;">
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
    // function auto_print() {     
    //     window.print()
    // }
    // setTimeout(auto_print, 1000);
    </script>

</body>

</html>