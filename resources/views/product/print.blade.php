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
            width: 300px;
            height: 150px;
            margin: 0 auto;
            padding: 0;
            margin-top: 10px;
            padding: 10px;
            background-color: #ccc;
            min-height: 150px;
            min-width: 350px;
        }

        .gramasi {
            /* text center */
            text-align: center;
            /* middle */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;

        }

        .gramasi h3 {
            font-size: 30px;
            margin: 0;
            padding: 0;
        }

        .gramasi h3 sup {
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

        }

        .bottom_right {
            text-align: right;
            font-size: 20px;
        }
    </style>
</head>

<body>
    @php
    $productImage = asset($data->image);
    @endphp
    <div class="container">

        <table>
            <tr>
                <td>
                    <div class="product-tag">
                        <div class="container-box">
                            <div class="gold_content">
                                gold content
                            </div>
                            <div class="additional_cod">
                                additional_cod
                            </div>
                        </div>
                        <div class="gramasi">
                            <h3>1000
                                <sup>90</sup>
                            </h3>
                        </div>

                        <div class="bottom_right">
                            1000
                        </div>
                    </div>
                </td>
                <td>
                    <div class="product-tag" style="text-align: center;">
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents($productImage)) }}"
                            alt="Product Image" style="width: 100px; height: 100px;">
                    </div>
                </td>
            </tr>
        </table>

    </div>

    <script>
        // window.onload = function() {
        //     window.print();
        // }
    </script>
</body>

</html>