<?php

namespace App\Http\Controllers;

use App\Models\OrderCancel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderCancelListController extends Controller
{
    //


    public function loadOrderCancel()
    {
        try {
            $query = 'SELECT pp_order_cancels.*,pp_reasons.reason FROM pp_order_cancels INNER JOIN pp_reasons ON pp_order_cancels.reason_id = pp_reasons.reason_id';
            $result = DB::select($query);
            $responseBody = $this->responseBody(true, "OrderCancelController", "loadOrderCancel", $result);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "OrderCancelController", "loadOrderCancel", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }



    function delete($id)
    {
        try {
            $order = OrderCancel::where('order_cancel_id', $id);
            if ($order) {
                if ($order->delete()) {

                }
            }

            $responseBody = $this->responseBody(true, "deleteOrder", "deleted", true);
        } catch (\Exception $ex) {
            $responseBody = $this->responseBody(false, "deleteOrder", "error", $ex);
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
