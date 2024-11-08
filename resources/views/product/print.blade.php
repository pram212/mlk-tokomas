<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Product Tag</title>
    <style>
        /* Jika Anda ingin mencetak dengan latar belakang berwarna, Anda perlu mengatur opsi pencetakan di browser Anda. Berikut adalah langkah-langkah umum untuk mencetak latar belakang di beberapa browser:

        Google Chrome: Buka menu Print (ctrl + p), klik 'More settings', dan pastikan opsi 'Background graphics' dicentang.
        Mozilla Firefox: Buka menu Print (ctrl + p), pilih 'Page Setup', dan centang 'Print Background (colors & images)'.
        Microsoft Edge: Buka menu Print (ctrl + p), pilih 'More settings', dan pastikan 'Background graphics' telah dipilih. */

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            padding: 0;
        }

        .product-tag {
            width: 250px;
            height: 150px;
            margin: 0 auto;
            padding: 10px;
            /* Pindahkan padding ke baris ini */
            margin-top: 10px;
            background-color: <?php echo $data->tagType->color;
            ?>;
            /* Pastikan $data->color berisi nilai warna yang valid */
            min-height: 150px;
            min-width: 300px;
            /* Perbarui nilai min-width sesuai kebutuhan */
        }


        .gramasi {
            /* text center */
            text-align: center;
            /* middle */
            display: flex;
            align-items: center;
            justify-content: center;
            /* height: 100%; */
            position: relative;
            top: -25px;
        }

        .gramasi h1 {
            font-size: 40px;
            /* margin: 0; */
            /* padding: 0; */
        }

        .gramasi h1 sup {
            font-size: 15px;
            /* posisikan agak keatas */
            position: relative;
            top: -10px;
            left: -5px;

        }

        .container-box {
            display: flex;
            justify-content: space-between;
        }

        .gold_content {
            text-align: left;
            font-size: 20px;
        }

        .additional_cod {
            text-align: right;
            font-size: 20px;
            position: relative;
            top: -25px;
            /* right: -250px; */

        }

        .bottom_right {
            text-align: right;
            position: relative;
            font-size: 20px;
            bottom: 20px;
        }

        /* td dengan jarak */
        td {
            padding: 10px;
        }
    </style>
</head>

<body>
    @php
        // $productImage = asset($data->image);
        // $productImage = asset($path);
    @endphp
    <div class="container">

        <table>
            <tr>
                <td>
                    <div class="product-tag">
                        <div class="container-box">
                            <div class="gold_content">
                                {{ $data->gold_content }}
                            </div>
                            <div class="additional_cod">
                                {{ $data->additional_code }}/{{ $data->discount }}
                            </div>
                        </div>
                        <div class="gramasi">
                            @if (isset($data->gramasi) && is_object($data->gramasi) && isset($data->gramasi->gramasi))
                                <h1>{{ $data->gramasi->gramasi }}
                                    <sup>{{ $data->mg }}</sup>
                                </h1>
                            @else
                                <h1>{{ $data->gramasi_id }}
                                    <sup>{{ $data->mg }}</sup>
                                </h1>
                            @endif
                        </div>

                        <div class="bottom_right">
                            {{ $data->productProperty->code }}
                        </div>
                    </div>
                </td>
                <td>
                    <div class="product-tag" style="text-align: center;">
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents($path)) }}"
                            alt="{{ $data->code }}">
                    </div>
                </td>
            </tr>
        </table>

    </div>
</body>

</html>
