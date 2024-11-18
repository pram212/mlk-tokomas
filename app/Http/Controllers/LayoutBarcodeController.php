<?php

namespace App\Http\Controllers;

use App\Product;
use Dompdf\Dompdf;
use View;
use QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LayoutBarcodeController extends Controller
{
    // GIWANG
    function codeBarcodeSave($categoryId)
{
    $isValidatedCategory = DB::table('categories')->where('id', '=', $categoryId)->first();

    if ($isValidatedCategory) {
        $products = Product::where('category_id', $isValidatedCategory->id)->get();

        if ($products->isNotEmpty()) {
            // Load relationships for all products
            $products->load([
                'productProperty:id,code,description',
                'gramasi:id,code,gramasi',
                'tagType:id,code,color',
                'category'
            ]);

            $dompdf = new Dompdf();
            $options = $dompdf->getOptions();
            $options->setDefaultFont('Courier');
            $dompdf->setOptions($options);
            $dompdf->setPaper('A4', 'portrait'); // Set to A4 for multiple tags

            $datetime = date('YmdHis');
            $filename = "products_{$isValidatedCategory->id}_{$datetime}.pdf";

            $qrCodePaths = [];

            // Generate QR codes for all products
            foreach ($products as $product) {
                $path = public_path('temp_' . $product->code . '_' . $datetime . '.png');
                QrCode::size(150)->generate($product->code, $path);
                $qrCodePaths[$product->code] = $path; // Store paths for the view
            }

                // LANDSCAPE
                if($product->category->tipe === 'landscape') {
                    $view = 'product.layout_barcode.barcode_landscape';
                } else {
                    $view = 'product.layout_barcode.barcode_potrait';
                }

                if(str_contains($product->category->width, '.00')) {
                    $isWidth = str_replace('.00', '', $product->category->width);
                    $finalWidth = (int)$isWidth;
                } else {
                    $isWidth = str_replace('0', '', $product->category->width);
                    $finalWidth = (float)$isWidth;
                }
                if(str_contains($product->category->height, '.00')) {
                    $isHeight = str_replace( '.00', '', $product->category->width);
                    $finalHeight = (int)$isHeight;
                } else {
                    $isHeight = str_replace('0', '', $product->category->height);
                    $finalHeight = (float)$isHeight;
                }

                $html = View::make($view, [
                    'products' => $products,
                    'width' => $finalWidth ,
                    'height' => $finalHeight ,
                    'qrCodePaths' => $qrCodePaths
                ])->render();

            // Load HTML into Dompdf
            $dompdf->loadHtml($html);

            // Render the HTML as PDF
            $dompdf->render();

            // Clean up temporary QR code files
            foreach ($qrCodePaths as $path) {
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            // Stream the PDF
            $dompdf->stream($filename, array("Attachment" => false));
        } else {
            return response()->json(['message' => 'No products found for this category'], 404);
        }
    } else {
        return response()->json(['message' => 'Category not found'], 404);
    }
}
}
