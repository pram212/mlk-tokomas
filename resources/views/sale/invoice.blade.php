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

        tr {
            border-bottom: 1px dotted #ddd;
        }

        td,
        th {
            padding: 7px 0;
            width: 50%;
        }

        table {
            width: 100%;
        }

        tfoot tr th:first-child {
            text-align: left;
        }

        .centered {
            text-align: center;
            align-content: center;
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
                    {{-- <td><a href="{{$url}}" class="btn btn-info"><i class="fa fa-arrow-left"></i>
                            {{trans('file.Back')}}</a> </td> --}}
                    <td><a href="{{ url()->previous() }}" class="btn btn-info"><i class="fa fa-arrow-left"></i>
                            Kembali</a> </td>
                    {{-- <td><button onclick="window.print();" class="btn btn-primary"><i class="dripicons-print"></i>
                            {{trans('file.Print')}}</button></td> --}}
                    <td><button onclick="window.print();" class="btn btn-primary"><i class="dripicons-print"></i>
                            Cetak</button></td>
                </tr>
            </table>
            <br>
        </div>

        <div id="receipt-data">
            <div class="centered">
                @if($general_setting->site_logo)
                <img src="{{ url($general_setting->site_logo) }}" height="42" style="margin:10px 0;">
                {{-- <img src="{{url('public/logo', $general_setting->site_logo)}}" height="42" width="42"
                    style="margin:10px 0;filter: brightness(0);"> --}}
                @endif

                {{-- <h2>{{@$lims_cashier_data->company_name ?? @$lims_biller_data->company_name}}</h2> --}}

                {{-- <p>{{trans('file.Address')}}: {{$lims_warehouse_data->address}}
                    <br>{{trans('file.Phone Number')}}: {{$lims_warehouse_data->phone}}
                    <br>{{trans('file.Cashier')}}: {{@@$lims_cashier_data->name}} --}}
                <p>Alamat: {{$lims_warehouse_data->address}}
                    <br>Nomor Telepon: {{$lims_warehouse_data->phone}}
                    <br>Kasir: {{@@$lims_cashier_data->name}}
                </p>
            </div>
            {{-- <p>{{trans('file.Date')}}: {{$lims_sale_data->created_at}}<br>
                {{trans('file.reference')}}: {{$lims_sale_data->reference_no}}<br>
                {{trans('file.customer')}}: {{$lims_customer_data->name}} --}}
            <p>Tanggal: {{$lims_sale_data->created_at}}<br>
                Refrensi: {{$lims_sale_data->reference_no}}<br>
                Pelanggan: {{$lims_customer_data->name}}
            </p>
            <table class="table-data">
                <tbody>
                    <?php $total_product_tax = 0;?>
                    @foreach($lims_product_sale_data as $key => $product_sale_data)
                    <?php
                    $lims_product_data = \App\Product::find($product_sale_data->product_id);
                    if($product_sale_data->variant_id) {
                        $variant_data = \App\Variant::find($product_sale_data->variant_id);
                        $product_name = $lims_product_data->name.' ['.$variant_data->name.']';
                    }
                    else
                        $product_name = $lims_product_data->name;
                ?>
                    <tr>
                        <td colspan="2">
                            {{$product_name}}
                            <br>{{$product_sale_data->qty}} x {{number_format($product_sale_data->total /
                            $product_sale_data->qty,0, ',' , '.')}}

                            @if($product_sale_data->tax_rate)
                            <?php $total_product_tax += $product_sale_data->tax ?>
                            {{-- [{{trans('file.Tax')}} ({{$product_sale_data->tax_rate}}%):
                            Rp{{number_format($product_sale_data->tax,0, ',' , '.') }}] --}}
                            [Pajak ({{$product_sale_data->tax_rate}}%): Rp{{number_format($product_sale_data->tax,0, ','
                            , '.') }}]
                            @endif
                        </td>
                        <td style="text-align:right;vertical-align:bottom">
                            Rp{{number_format($product_sale_data->total,0, ',' , '.')}}</td>
                    </tr>
                    @endforeach

                    <!-- <tfoot> -->
                    <tr>
                        {{-- <th colspan="2" style="text-align:left">{{trans('file.Total')}}</th> --}}
                        <th colspan="2" style="text-align:left">Jumlah</th>
                        <th style="text-align:right">Rp{{number_format($lims_sale_data->total_price,0, ',' , '.')}}</th>
                    </tr>
                    @if($general_setting->invoice_format == 'gst' && $general_setting->state == 1)
                    <tr>
                        <td colspan="2">IGST</td>
                        <td style="text-align:right">Rp{{number_format($total_product_tax,0, ',' , '.')}}</td>
                    </tr>
                    @elseif($general_setting->invoice_format == 'gst' && $general_setting->state == 2)
                    <tr>
                        <td colspan="2">SGST</td>
                        <td style="text-align:right">Rp{{number_format(($total_product_tax / 2),0, ',' , '.')}}</td>
                    </tr>
                    <tr>
                        <td colspan="2">CGST</td>
                        <td style="text-align:right">Rp{{number_format(($total_product_tax / 2),0, ',' , '.')}}</td>
                    </tr>
                    @endif
                    @if($lims_sale_data->order_discount)
                    <tr>
                        {{-- <th colspan="2" style="text-align:left">{{trans('file.Order Discount') . " (" .
                            number_format($lims_sale_data->order_discount,0, ',' , '.') . "%" . ")"}}</th> --}}
                        <th colspan="2" style="text-align:left">{{"Diskon Pesanan (" .
                            number_format($lims_sale_data->order_discount,0, ',' , '.') . "%" . ")"}}</th>
                        <th style="text-align:right">{{(int)@$lims_sale_data->order_discount == 0 ? "0%" :
                            number_format($lims_sale_data->total_price * ($lims_sale_data->order_discount / 100), 0,
                            ",", ".") }}</th>
                    </tr>
                    @endif
                    @if($lims_sale_data->order_tax)
                    <tr>
                        {{-- <th colspan="2" style="text-align:left">{{trans('file.Order Tax')}}</th> --}}
                        <th colspan="2" style="text-align:left">Pajak Pesanan</th>
                        <th style="text-align:right">Rp{{number_format($lims_sale_data->order_tax,0, ',' , '.')}}</th>
                    </tr>
                    @endif
                    @if($lims_sale_data->coupon_discount)
                    <tr>
                        {{-- <th colspan="2" style="text-align:left">{{trans('file.Coupon Discount')}}</th> --}}
                        <th colspan="2" style="text-align:left">Diskon Kupon</th>
                        <th style="text-align:right">{{number_format($lims_sale_data->coupon_discount,0, ',' , '.') }}
                        </th>
                    </tr>
                    @endif
                    @if($lims_sale_data->shipping_cost)
                    <tr>
                        {{-- <th colspan="2" style="text-align:left">{{trans('file.Shipping Cost')}}</th> --}}
                        <th colspan="2" style="text-align:left">Biaya Pengiriman</th>
                        <th style="text-align:right">Rp{{number_format($lims_sale_data->shipping_cost,0, ',' , '.') }}
                        </th>
                    </tr>
                    @endif
                    <tr>
                        {{-- <th colspan="2" style="text-align:left">{{trans('file.grand total')}}</th> --}}
                        <th colspan="2" style="text-align:left">Grand Total</th>
                        <th style="text-align:right">Rp{{number_format($lims_sale_data->grand_total,0, ',' , '.')}}</th>
                    </tr>
                    <tr>
                        @if($general_setting->currency_position == 'prefix')
                        {{-- <th class="centered" colspan="3">{{trans('file.In Words')}}:
                            <span>{{$currency->code}}</span> <span>{{str_replace("-"," ",$numberInWords)}}</span>
                        </th>
                        --}}
                        <th class="centered" colspan="3">Terbilang: {{-- <span>{{$currency->code}}</span>
                            --}}<span>{{str_replace("-"," ",$numberInWords)}} Rupiah</span></th>
                        @else
                        {{-- <th class="centered" colspan="3">{{trans('file.In Words')}}: <span>{{str_replace("-","
                                ",$numberInWords)}}</span> <span>{{$currency->code}}</span></th> --}}
                        <th class="centered" colspan="3">Terbilang: <span>{{str_replace("-"," ",$numberInWords)}}</span>
                            Rupiah{{-- <span>{{$currency->code}}</span> --}}</th>
                        @endif
                    </tr>
                </tbody>
                <!-- </tfoot> -->
            </table>
            <table>
                <tbody>
                    @foreach($lims_payment_data as $payment_data)
                    <tr style="background-color:#ddd;">
                        {{-- <td style="padding: 5px;width:30%">{{trans('file.Paid By')}}:
                            {{$payment_data->paying_method}}</td> --}}
                        <td style="padding: 5px;width:50%">Jumlah: Rp{{number_format($payment_data->amount,0, ',' , '.')
                            }}</td>
                        <td style="padding: 5px;width:50%">Sisa Pembayaran: Rp{{number_format($payment_data->change,0,
                            ',' , '.') }}</td>
                    </tr>
                    @endforeach

                    {{-- payment Details --}}
                    <tr>
                        <td colspan="3"></td>
                    </tr>
                    <tr style="background-color:#bebebe;">
                        <td class="centered" colspan="3"><b>Payment Method Detail</b></td>
                    </tr>
                    @php $no = 1; @endphp
                    <tr>
                        <td colspan="3">
                            <table border="1" style="border-collapse: collapse; width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="border: 1px solid black; padding: 8px; text-align: center;">
                                            No</th>
                                        <th style="border: 1px solid black; padding: 8px;">Payment Method</th>
                                        <th style="border: 1px solid black; padding: 8px;">Bank Name</th>
                                        <th style="border: 1px solid black; padding: 8px;">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($payments['paymentDetails'] as $key => $paymentDetails)
                                    <tr style="background-color:#ddd;">
                                        <td style="border: 1px solid black; padding: 8px; text-align: center;">
                                            {{$no++ }}
                                        </td>
                                        <td style="border: 1px solid black; padding: 5px;">
                                            {{$paymentDetails['paymentMethod']['name'] }}</td>
                                        <td style="border: 1px solid black; padding: 5px;">
                                            {{@$paymentDetails['bank']['name'] }} -
                                            {{@$paymentDetails['card_number'] }}</td>
                                        <td style="border: 1px solid black; padding: 5px;">
                                            Rp.{{ number_format($paymentDetails['amount'], 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>




                    <tr>
                        <td class="centered" colspan="3">Terima kasih. Silahkan datang lagi</td>
                    </tr>
                    {{-- <tr>
                        <td class="centered" colspan="3">
                            <img style="margin-top:10px;"
                                src="data:image/png;base64,{{ DNS1D::getBarcodePNG($lims_sale_data->reference_no, 'C128') }}"
                                width="300" alt="barcode" />
                            <br>
                            <img style="margin-top:10px;"
                                src="data:image/png;base64,{{ DNS2D::getBarcodePNG($lims_sale_data->reference_no, 'QRCODE') }}"
                                alt="barcode" />
                        </td>
                    </tr> --}}
                </tbody>
            </table>
            <!-- <div class="centered" style="margin:30px 0 50px">
            <small>{{trans('file.Invoice Generated By')}} {{$general_setting->site_title}}.
            {{trans('file.Developed By')}} LionCoders</strong></small>
        </div> -->
        </div>
    </div>

    <script type="text/javascript">
        localStorage.clear();
    function auto_print() {
        window.print()
    }
    setTimeout(auto_print, 1000);
    </script>

</body>

</html>
