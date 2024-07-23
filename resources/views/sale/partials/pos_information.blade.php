<div class="row">
    @include('sale.partials.pos_header')
</div>
<div class="row">
    {{-- filter product --}}
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <select class="form-control" multiple id="filter_category" name="filter_category">
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table" id="table_product_info" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Code</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>