<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <style>
    table {
      width: 100%;
    }

    table,
    th,
    td {
      border: 1px solid black;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    .container-img {
      text-align: center;
    }

    .img_product {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 50%;
      border: 1px solid rgba(0, 0, 0, 0.2);
    }
  </style>
</head>

<body>

  <div class="container-img">
    @php
    $gambar_produk = $product->image ?? '';
    @endphp
    <img class="img_product" src="data:image/png;base64,{{ base64_encode(file_get_contents($gambar_produk)) }}" alt="">
  </div>

  <h2>
    <b>
      {{ $product->name . ' (' . ($productSplitSetDetail ? $productSplitSetDetail->split_set_code : $product->code) .
      ')' }}
    </b>
  </h2>



  {{-- table product information --}}
  <table>
    <tr>
      <td>Name</td>
      <td>:</td>
      <td>{{ $product->name }}</td>
    </tr>
    <tr>
      <td>Code</td>
      <td>:</td>
      <td>{{ $productSplitSetDetail ? $productSplitSetDetail->split_set_code:$product->code }}</td>
    </tr>
    <tr>
      <td>Split Set Type</td>
      <td>:</td>
      <td>{{ ($product->split_set_type === '1')?'Full Set':'Split Set' }}</td>
    </tr>
    <tr>
      <td>Price</td>
      <td>:</td>
      <td>{{ $productSplitSetDetail ? $productSplitSetDetail->price:$product->price }}</td>
    </tr>
    <tr>
      <td>Category</td>
      <td>:</td>
      <td>{{ $product->category->name }}</td>
    </tr>
    <tr>
      <td>Tag Type</td>
      <td>:</td>
      <td>{{ $product->tagType->description.' ('.$product->tagType->code.')' }}</td>
    </tr>
    <tr>
      <td>Product Property</td>
      <td>:</td>
      <td>{{ $product->productProperty->description.' ('.$product->productProperty->code.')' }}</td>
    </tr>
    <tr>
      <td>Invoice Number</td>
      <td>:</td>
      <td>{{ $productSplitSetDetail ? $productSplitSetDetail->invoice_number:$product->invoice_number }}</td>
    </tr>
    <tr>
      <td>Gramasi</td>
      <td>:</td>
      <td>{{ $productSplitSetDetail ? $productSplitSetDetail->gramasi:$product->gramasi->gramasi }}</td>

    </tr>
    <tr>
      <td>Miligram</td>
      <td>:</td>
      <td>{{ $productSplitSetDetail ? $productSplitSetDetail->mg:$product->mg }}</td>
    </tr>
    <tr>
      <td>Product Status</td>
      <td>:</td>
      <td>
        {{ ($productSplitSetDetail ? $productSplitSetDetail->product_status : $product->product_status) ? 'STORE' :
        'SOLD' }}
      </td>
    </tr>

</body>

</html>