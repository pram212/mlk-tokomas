<?php

namespace App\Http\Controllers\api;

use App\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class couponController extends Controller
{
    function getByCode(Request $request)
    {
        /* Validate request */
        $request->validate([
            'code' => 'required|string'
        ]);

        try {
            $coupon = Coupon::where([
                'code' => $request->code,
                'is_active' => 1
            ])->first();
            if ($coupon) {
                /* Check if coupon is expired */
                if ($coupon->expired_date < date('Y-m-d')) {
                    return response()->json(['status' => false, 'data' => null, 'message' => 'Coupon is expired']);
                }

                /* Check if coupon is used */
                if ($coupon->quantity <= $coupon->used) {
                    return response()->json(['status' => false, 'data' => null, 'message' => 'Coupon quantity runs out']);
                }

                $msg = "";

                switch ($coupon->type) {
                    case 'fixed':
                        $msg = 'Congratulation! Coupon is valid, you have got ' . $coupon->amount . ' discount';
                        break;
                    case 'percentage':
                        $msg = 'Congratulation! Coupon is valid, you have got ' . $coupon->amount . '% discount';
                        break;
                    default:
                        $msg = 'Congratulation! Coupon is valid, you have got ' . $coupon->amount . ' discount';
                        break;
                }

                return response()->json(['status' => true, 'data' => $coupon, 'message' =>  $msg]);
            } else {
                return response()->json(['status' => false, 'data' => null, 'message' => 'Coupon not found']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
