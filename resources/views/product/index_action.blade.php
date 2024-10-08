@can('viewActionButton', App\Product::class)
<div class="dropdown">
    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        Action
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

        <a class="dropdown-item btn-view" href="#" data-id="{{ $product->id }}"><i class="fa fa-eye"></i> View</a>
        @can('viewActionButtonEdit', App\Product::class)
            @if($product->product_status == 1 && $user->can('update', $product))
            <a class="dropdown-item btn-edit" href="{{ ($product->split_set_code) ? url("products/$product->id/edit?split_set_id=$product->split_id"):url("products/$product->id/edit") }}"><i
                class="fa fa-edit"></i> Edit</a>
                @endif
        @endcan

        <a class="dropdown-item btn-print" target="_BLANK" data-id="{{ $product->id }}" href="{{ url("products/print/$product->id") }}"><i class="fa fa-print"></i> Print</a>

        @can('viewActionButtonDelete', App\Product::class)
            @if($product->product_status == 1 && $user->can('delete', $product))
                <a class="dropdown-item btn-delete" href="#" data-id="{{ $product->id }}"
                    data-splitid="{{ $product->split_id }}"><i class="fa fa-trash"></i> Delete</a>
            @endif
        @endcan
    </div>
</div>
@endcan
