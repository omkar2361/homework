<?php

namespace App\Http\Controllers;

use App\Amazon\AmazonOrder;

class AmazonOrderController extends Controller
{
    public function datatable(Request $request)
    {
        $records = AmazonOrder::query();

        if (isset($request->search)) {
            foreach ($request->search as $key => $value) {
                switch ($key) {
                    case "search":
                        $records->where(function ($query) use ($value) {
                            $query->orWhere('AmazonOrderId', 'ILiKE', "%$value%");
                            $query->orWhere('SellerOrderId', 'ILiKE', "%$value%");
                            $query->orWhere('PurchaseDate', 'ILiKE', "%$value%");
                            $query->orWhere('OrderStatus', 'ILiKE', "%$value%");
                            $query->orWhere('BuyerEmail', 'ILiKE', "%$value%");
                            $query->orWhere('PaymentMethod', 'ILiKE', "%$value%");
                            // more columns
                        });

                        break;

                    default:
                        break;
                }
            }
        }

        return $records->get();
    }
}
