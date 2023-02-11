<?php

namespace App\Http\Controllers;

use App\Models\CustomerOrder;
use App\Models\CustomerOrderData;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class CustomerOrderListController extends Controller
{
    public function allCustomerOrder()
    {
        try {
            $customer_orders = CustomerOrder::where('create_from','=','USA')->orderBy('order_id', 'DESC')->get();
            $responseBody = $this->responseBody(true, "CustomerOrderListController", "allCustomerOrder", $customer_orders);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "CustomerOrderListController", "allCustomerOrder", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }


    function delete($id)
    {
        try {
            $order = CustomerOrder::where('order_id', $id);
            if ($order) {
                if ($order->delete()) {
                    $query = 'DELETE FROM pp_customer_orders_data WHERE order_id = "' . $id . '"';
                    DB::select($query);
                }
            }

            $responseBody = $this->responseBody(true, "deleteOrder", "deleted", true);
        } catch (\Exception $ex) {
            $responseBody = $this->responseBody(false, "deleteOrder", "error", $ex);
        }
        return response()->json(["data" => $responseBody]);
    }



    public function isAllowcateOrder($id)
    {

        $order = CustomerOrder::where([['order_id', '=', $id], ['production_status', '>', 0]])->first();
        if ($order) {
            return 1;
        }
        return 0;
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
