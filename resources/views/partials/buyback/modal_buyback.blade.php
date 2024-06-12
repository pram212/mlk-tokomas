<div class="modal fade" id="buybackModal" tabindex="-1" role="dialog" aria-labelledby="buybackModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row p-2">
          <span class="buybackModalLabel" id="buybackModalLabel">Perhitungan
            BuyBack
          </span>
          <img class="mr-2 " src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logo/bima_logo_1.png'))) }}" height="40px" alt="">
          <img class="" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('logo/bima_text_1.png'))) }}" height="40px" alt="">
        </div>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="row p-2 modal_desc">
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
              <div class="col-md-6"><input type="text" class="form-control" id="modal_discount" readonly>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-md-6">Biaya tambahan</div>
              <div class="col-md-6"><input type="text" class="form-control" onchange="hitungTotalPotongan()" id="modal_additional_cost">
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-md-6">Keterangan</div>
              <div class="col-md-6"><input type="text" class="form-control" id="modal_description">
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-md-6">Totalnya potongan</div>
              <div class="col-md-6"><input type="text" class="form-control" id="modal_total_discount" readonly>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <button type="button" class="btn btn-primary" id="btn_submit">Beli Kembali</button>
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