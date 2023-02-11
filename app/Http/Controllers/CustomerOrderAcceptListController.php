<?php

namespace App\Http\Controllers;

use App\Mail\MailData;
use App\Models\CustomerOrder;
use App\Models\CustomerPlan;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerOrderAcceptListController extends Controller
{

    public function allCustomerOrder()
    {
        try {
            $customer_orders = CustomerOrder::where('create_from', '=', 'USA')->orderBy('order_id', 'DESC')->get();
            foreach ($customer_orders as $order) {
                $plan = CustomerPlan::where('order_id', '=', $order->order_id)->first();
                if ($plan) {
                    $order->isAllowcated = 1;
                } else {
                    $order->isAllowcated = 0;
                }
            }

            $responseBody = $this->responseBody(true, "CustomerOrderListController", "allCustomerOrder", $customer_orders);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "CustomerOrderListController", "allCustomerOrder", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }


    public function new_order_staus(Request $request)
    {
        try {

            $id = $request->get('id');
            $customer_order = CustomerOrder::find($id);
            if ($customer_order) {
                $customer_order->order_status = 0;
                $customer_order->update();
            }
            $responseBody = $this->responseBody(true, "CustomerOrderAcceptListController", "status", 'New status');
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "error", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    public function accept(Request $request)
    {
        try {

            $id = $request->get('id');
            $customer_order = CustomerOrder::find($id);
            if ($customer_order) {
                $customer_order->order_status = 1;
                $customer_order->update();
            }
            $responseBody = $this->responseBody(true, "CustomerOrderAcceptListController", "status", 'Accepted');
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "error", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }



    public function revice(Request $request)
    {
        try {

            $id = $request->get('id');
            $customer_order = CustomerOrder::find($id);
            if ($customer_order) {
                $customer_order->order_status = 2;
                $customer_order->update();
            }
            $responseBody = $this->responseBody(true, "CustomerOrderAcceptListController", "status", 'Reviced');
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "error", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }



    public function reject(Request $request)
    {
        try {

            $id = $request->get('id');
            $customer_order = CustomerOrder::find($id);
            if ($customer_order) {
                $customer_order->order_status = 3;
                $customer_order->update();
            }
            $responseBody = $this->responseBody(true, "CustomerOrderAcceptListController", "status", 'Rejected');
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "error", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }


    public function proceed(Request $request)
    {
        try {

            $id = $request->get('id');
            $customer_order = CustomerOrder::find($id);
            if ($customer_order) {
                $customer_order->order_status = 4;
                if ($customer_order->update()) {
                    $subject = "Order Proceeded : " . $customer_order->factory_po_num;
                    $email_body = "Factoy PO No : " . $customer_order->factory_po_num . "<br>";
                    $email_body .= "Customer PO No : " . $customer_order->purchase_order . "<br>";
                    $email_body .= "Created By : " . Auth::user()->name;
                    $recievers = MailData::getRecievers();
                    foreach ($recievers as $address) {
                        MailController::createMail($subject, $email_body, MailData::getSender(), $address);
                    }
                }
            }
            $responseBody = $this->responseBody(true, "CustomerOrderAcceptListController", "status", 'proceed');
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "error", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }



    public function hold(Request $request)
    {
        try {

            $id = $request->get('id');
            $customer_order = CustomerOrder::find($id);
            if ($customer_order) {
                $customer_order->order_status = 5;
                $customer_order->update();
            }
            $responseBody = $this->responseBody(true, "CustomerOrderAcceptListController", "status", 'Hold');
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "error", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }



    public function fund_status_yes(Request $request)
    {
        try {

            $id = $request->get('id');
            $customer_order = CustomerOrder::find($id);
            if ($customer_order) {
                $customer_order->fund_status = 1;
                $update = $customer_order->update();
                if ($update) {
                    $subject = "Fund Status Alert : PO NO." . $customer_order->purchase_order;
                    $email_body = "Fund :  Yes <br> Created By : " . Auth::user()->name;
                    $recievers = MailData::getRecievers();
                    foreach ($recievers as $address) {
                        MailController::createMail($subject, $email_body, MailData::getSender(), $address);
                    }
                }
            }
            $responseBody = $this->responseBody(true, "CustomerOrderAcceptListController", "fund status", 'Yes');
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "error", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }



    public function fund_status_no(Request $request)
    {
        try {

            $id = $request->get('id');
            $customer_order = CustomerOrder::find($id);
            if ($customer_order) {
                $customer_order->fund_status = 0;
                $update = $customer_order->update();
                if ($update) {
                    $subject = "Fund Status Alert : PO NO." . $customer_order->purchase_order;
                    $email_body = "Fund :  No <br> Created By : " . Auth::user()->name;
                    $recievers = MailData::getRecievers();
                    foreach ($recievers as $address) {
                        MailController::createMail($subject, $email_body, MailData::getSender(), $address);
                    }
                }
            }
            $responseBody = $this->responseBody(true, "CustomerOrderAcceptListController", "fund status", 'No');
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "error", "error", $exception);
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
