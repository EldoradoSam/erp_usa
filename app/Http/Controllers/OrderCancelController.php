<?php

namespace App\Http\Controllers;

use App\Mail\MailData;
use App\Models\CustomerOrder;
use App\Models\OrderCancel;
use App\Models\Reason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class OrderCancelController extends Controller
{
    //

    public function getFactoryPO()
    {
        try {
            $factory_po = DB::select('SELECT pp_customer_orders.order_id, pp_customer_orders.factory_po_num FROM pp_customer_orders WHERE pp_customer_orders.order_status < "4" AND pp_customer_orders.production_status < "2"');
            $responseBody = $this->responseBody(true, "OrderCancelController", "getFactoryPO", $factory_po);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "OrderCancelController", "getFactoryPO", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }


    public function getCustomerPO($order_id)
    {
        try {
            $factory_po = DB::select('SELECT pp_customer_orders.purchase_order FROM pp_customer_orders WHERE pp_customer_orders.order_id = "' . $order_id . '"');
            $responseBody = $this->responseBody(true, "OrderCancelController", "getCustomerPO", $factory_po);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "OrderCancelController", "getCustomerPO", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }



    public function getReason()
    {
        try {
            $reason = Reason::all();
            $responseBody = $this->responseBody(true, "OrderCancelController", "getReason", $reason);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "OrderCancelController", "getReason", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }



    public function getOrderCancel($id)
    {
        try {
            $orderCancel = OrderCancel::find($id);
            $responseBody = $this->responseBody(true, "OrderCancelController", "getOrderCancel", $orderCancel);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "OrderCancelController", "getOrderCancel", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }



    public function save(Request $request)
    {
        try {
            $orderCancel = new OrderCancel();
            $orderCancel->date = $request->get('date');
            $orderCancel->factory_po_no = $request->get('factory_po');
            $orderCancel->customer_po_no = $request->get('customer_po');
            $orderCancel->order_id = $request->get('order_id');
            $orderCancel->reason_id = $request->get('reason');
            $orderCancel->remarks = $request->get('remark');
            if ($orderCancel->save()) {
                $customer_order = CustomerOrder::find($request->get('order_id'));
                if ($customer_order) {
                    $customer_order->order_status = 6;
                    if ($customer_order->update()) {
                        $subject = "Order Canceled : " . $customer_order->purchase_order;
                        $email_body = "Factoy PO No : " . $request->get('factory_po') . "<br>";
                        $email_body .= "Customer PO No : " . $request->get('customer_po') . "<br>";
                        $email_body .= "Created By : " . Auth::user()->name;
                        $recievers = MailData::getRecievers();
                        foreach ($recievers as $address) {
                            MailController::createMail($subject, $email_body, MailData::getSender(), $address);
                        }
                    }
                }
            }
            $responseBody = $this->responseBody(true, "OrderCancelController", "save", true);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "OrderCancelController", "save", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }


    public function update(Request $request, $id)
    {
        try {
            $orderCancel =  OrderCancel::find($id);
            if ($orderCancel) {
                $orderCancel->date = $request->get('date');
                $orderCancel->factory_po_no = $request->get('factory_po');
                $orderCancel->customer_po_no = $request->get('customer_po');
                $orderCancel->order_id = $request->get('order_id');
                $orderCancel->reason_id = $request->get('reason');
                $orderCancel->remarks = $request->get('remark');
                $orderCancel->update();
            }
            $responseBody = $this->responseBody(true, "OrderCancelController", "update", true);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "OrderCancelController", "update", $exception);
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
