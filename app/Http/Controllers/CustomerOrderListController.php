<?php

namespace App\Http\Controllers;

use App\Models\CustomerOrder;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class CustomerOrderListController extends Controller
{
    public function allCustomerOrder()
    {
        try {
            $customer_orders = CustomerOrder::orderBy('order_id', 'DESC')->get();
            $responseBody = $this->responseBody(true, "CustomerOrderListController", "allCustomerOrder", $customer_orders);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "CustomerOrderListController", "allCustomerOrder", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }



    /**
     * responseBody
     * This is used to create response.
     * @param success This is the paramter require boolean
     * @param name This is the paramter require ui table name
     * @param message This is the paramter require message content
     * @param result This is the paramter require result as some of data to return client
     * @return Json This returns as response.
     */
    private function responseBody($success, $name, $message, $result)
    {
        $body = [
            "success" => $success,
            "message" => $message,
            "name" => $name,
            "result" => $result
        ];
        return $body;
    }
}
