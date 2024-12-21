@section('css')
<style>
    .top-buyback-modal {
        font-size: 13px;
        font-weight: bold;
        border-bottom: 1px solid rgba(99, 99, 99, 0.3);
        padding-bottom: 10px;
    }

    .top-buyback-modal td {
        padding-right: 10px;
    }
</style>
@endsection

<script>
  function printButton() {
    var idProduct = document.getElementById('product_id').value;
    var splitCode = document.getElementById('product_code').value;
    var harga = document.getElementById('modal_price_value').innerHTML;
    var hargaAwal = document.getElementById('modal_price_default').value;
    var potongan = document.getElementById('modal_discount').value;
    var totalPotongan = document.getElementById('modal_total_discount').value;


    const baseUrl = "{{ url('buyback/print/') }}"; // Server-side base URL

    // Create a form element
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = baseUrl; // Set the form action to the base URL

    // Add CSRF token input
    var csrfToken = "{{ csrf_token() }}"; // This should be the server-side generated CSRF token
    var inputCsrf = document.createElement('input');
    inputCsrf.type = 'hidden';
    inputCsrf.name = '_token';
    inputCsrf.value = csrfToken;
    form.appendChild(inputCsrf);

    // Create input elements for each piece of data
    var inputIdProduct = document.createElement('input');
    inputIdProduct.type = 'hidden';
    inputIdProduct.name = 'idProduct';
    inputIdProduct.value = idProduct;
    form.appendChild(inputIdProduct);


    // Check if splitCode includes a hyphen and add it to the form if it does
    if (splitCode.includes("-")) {
        var inputSplitCode = document.createElement('input');
        inputSplitCode.type = 'hidden';
        inputSplitCode.name = 'splitCode';
        inputSplitCode.value = splitCode;
        form.appendChild(inputSplitCode);
    }


    var inputHarga = document.createElement('input');
    inputHarga.type = 'hidden';
    inputHarga.name = 'harga';
    inputHarga.value = harga;
    form.appendChild(inputHarga);

    var inputHargaAwal = document.createElement('input');
    inputHargaAwal.type = 'hidden';
    inputHargaAwal.name = 'hargaAwal';
    inputHargaAwal.value = hargaAwal;
    form.appendChild(inputHargaAwal);

    var inputPotongan = document.createElement('input');
    inputPotongan.type = 'hidden';
    inputPotongan.name = 'potongan';
    inputPotongan.value = potongan;
    form.appendChild(inputPotongan);

    var inputTotalPotongan = document.createElement('input');
    inputTotalPotongan.type = 'hidden';
    inputTotalPotongan.name = 'totalPotongan';
    inputTotalPotongan.value = totalPotongan;
    form.appendChild(inputTotalPotongan);

    // Append the form to the body and submit it
    document.body.appendChild(form);
    form.submit();
}


</script>

<div class="modal fade" id="buybackModal" tabindex="-1" role="dialog" aria-labelledby="buybackModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row p-2">
                    <span class="buybackModalLabel" id="buybackModalLabel">Perhitungan
                        BuyBack
                    </span>
                    <img class="mr-2 "
                        src="data:image/png;base64,{{ asset('logo/bima_logo_1.png') }}"
                        height="40px" alt="">
                    <img class=""
                        src="data:image/png;base64,{{ asset('logo/bima_text_1.png') }}"
                        height="40px" alt="">
                </div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row top-buyback-modal">
                    <div class="col">
                        <table>
                            <tbody>
                                <tr>
                                    <td>Catatan Penjualan</td>
                                    <td>:</td>
                                    <td><span id="sale_note"></span></td>
                                </tr>
                                <tr>
                                    <td>Gramasi</td>
                                    <td>:</td>
                                    <td><span id="gramasi"></span></td>
                                </tr>
                                <tr>
                                    <td>Sifat Barang</td>
                                    <td>:</td>
                                    <td><span id="product_property"></span></td>
                                </tr>
                                <tr>
                                    <td>Invoice</td>
                                    <td>:</td>
                                    <td><span id="invoice_number_sales"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col px-5">
                        <img id="imagePreview" width="350" height="200"/>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="row p-2 modal_desc" style="margin-left: 30px;">
                            <p id="modal_desc_value"></p>
                            <span>Deskripsi</span>
                        </div>
                        <div class="row p-2 modal_price">
                            <p id="modal_price_value"></p>
                            <span>Harga</span>
                        </div>
                    </div>
                    <div class="col-md-6 p-2 modal_right">
                        <div class="row mb-2">
                            <div class="col-md-6">Harga Awal</div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="modal_price_default" readonly>
                                <input type="hidden" class="form-control" id="product_id">
                                <input type="hidden" class="form-control" id="product_code">
                                <input type="hidden" class="form-control" id="final_price">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">Potongan</div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="modal_discount" readonly>
                                <div class="form-group form-check" title="Potongan akan dikalikan 2 jika ini diceklis!">
                                    <input type="checkbox" class="form-check-input" id="barang_meleot">
                                    <label class="form-check-label" for="barang_meleot">Barang meleot dekok</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">Biaya tambahan</div>
                            <div class="col-md-6">
                                @can('buybackEdit', App\Product::class)
                                <div class="input-group mb-3">
                                    <input type="int" class="form-control" onchange="hitungTotalPotongan()"
                                        id="modal_additional_cost">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-success" type="button"
                                            id="btn_save_additional_cost"><i class="fa fa-save"></i></button>
                                    </div>
                                </div>
                                @else
                                <input type="int" class="form-control" id="modal_additional_cost"  readonly>
                                @endcan
                            </div>

                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">Keterangan</div>
                            <div class="col-md-6"><input type="text" class="form-control" id="modal_description">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">Totalnya potongan</div>
                            <div class="col-md-6"><input type="text" class="form-control" id="modal_total_discount"
                                    value="0" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary" id="btn_submit">Submit</button>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                        {{-- Harga Awal : otomatis tampil sesuai produknya
                        Potongan : Otomatis tampil perhitungannya
                        Biaya tambahan : diinput lg
                        Keterangan : diinput lg
                        Sifat Barang : Dipilih kembali
                        Totalnya potongan : perhitungan potongan + biaya tambahan --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="buybackModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row p-2">
                    <span class="buybackModalLabel" id="buybackModalLabel">
                        Detail Buyback
                    </span>
                    <img class="mr-2 "
                        src="data:image/png;base64,{{ asset('logo/bima_logo_1.png') }}"
                        height="40px" alt="">
                    <img class=""
                        src="data:image/png;base64,{{ asset('logo/bima_text_1.png') }}"
                        height="40px" alt="">
                </div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row top-buyback-modal">
                    <div class="col">
                        <div class="hidden-print">
                        </div>
                        <table>
                            <tbody>
                                <tr>
                                    <td>Catatan Penjualan</td>
                                    <td>:</td>
                                    <td><span id="sale_note_2"></span></td>
                                </tr>
                                <tr>
                                    <td>Gramasi</td>
                                    <td>:</td>
                                    <td><span id="gramasi_2"></span></td>
                                </tr>
                                <tr>
                                    <td>Sifat Barang</td>
                                    <td>:</td>
                                    <td><span id="product_property_2"></span></td>
                                </tr>
                                <tr>
                                    <td>Invoice</td>
                                    <td>:</td>
                                    <td><span id="invoice_number_sales_2"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col px-5">
                        <img id="imagePreview_detail" width="350" height="200"/>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6" style="font-weight: bold">
                        <div class="row p-2 modal_desc" style="margin-left: 30px;">
                            <p id="modal_desc_value_2" style="padding: 70px;"></p>
                            <span>Deskripsi</span>
                        </div>
                        <div class="row p-2 modal_price">
                            <p id="modal_price_value_2"></p>
                            <span>Harga</span>
                        </div>
                    </div>
                    <div class="col-md-6 p-2 modal_right">
                        <div class="row mb-2">
                            <div class="col-md-6">Harga Awal</div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="modal_price_default_2" readonly>
                                <input type="hidden" class="form-control" id="product_id">
                                <input type="hidden" class="form-control" id="product_code">
                                <input type="hidden" class="form-control" id="final_price">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">Potongan</div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="modal_discount_2" readonly>
                                <div class="form-group form-check" title="Potongan akan dikalikan 2 jika ini diceklis!">
                                    <input type="checkbox" class="form-check-input" id="barang_meleot_detail">
                                    <label class="form-check-label" for="barang_meleot_detail">Barang meleot dekok</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">Biaya tambahan</div>
                            <div class="col-md-6">
                                @can('buybackEdit', App\Product::class)
                                <div class="input-group mb-3">
                                    <input type="int" class="form-control" onchange="hitungTotalPotongan()"
                                        id="modal_additional_cost_2" readonly>
                                        {{-- Comment karena fungsi input sudah dipindah ke submit --}}

                                    {{-- <div class="input-group-append">
                                        <button class="btn btn-outline-success" type="button"
                                            id="btn_save_additional_cost_detail"><i class="fa fa-save"></i></button>
                                    </div> --}}
                                </div>
                                @else
                                <input type="int" class="form-control" id="modal_additional_cost" value="0" readonly>
                                @endcan
                            </div>

                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">Keterangan</div>
                            <div class="col-md-6"><input type="text" class="form-control" id="modal_description_2" disabled>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">Totalnya potongan</div>
                            <div class="col-md-6"><input type="text" class="form-control" id="modal_total_discount_2"
                                    value="0" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary" onclick="printButton()" id="btn_submit">{{trans('file.Print')}}</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                        {{-- Harga Awal : otomatis tampil sesuai produknya
                        Potongan : Otomatis tampil perhitungannya
                        Biaya tambahan : diinput lg
                        Keterangan : diinput lg
                        Sifat Barang : Dipilih kembali
                        Totalnya potongan : perhitungan potongan + biaya tambahan --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
