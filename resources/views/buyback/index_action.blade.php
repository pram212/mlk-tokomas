@if($show_buyback_button)
<div class="dropdown">
    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        Action
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item btn-buyback" href="#" data-productId="{{ $product->id }}"
            data-productCode="{{ $product->code }}"><i class="fa fa-arrow-left"></i> Buyback</a>
        <a class="dropdown-item btn-detail" href="#" data-productId="{{ $product->id }}"
            data-productCode="{{ $product->code }}"><i class="fa fa-print"></i> Print To Customer</a>
    </div>
</div>
@else
<button class="btn btn-default dropdown-toggle" type="button" disabled>
    Action
</button>
@endif
