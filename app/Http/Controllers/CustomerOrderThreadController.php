<?php

namespace App\Http\Controllers;

use App\Models\CustomerOrderThread;
use App\Models\Employee;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;



class CustomerOrderThreadController extends Controller
{
    public function submit(Request $request)
    {
        try {

            $order_id = $request->get('order_id');
            $text = $request->get('text');
            $user_id = Auth::user()->user_id;
            if ($user_id == null) {
                $user_id = 0;
            }
            $customer_order_thread = new CustomerOrderThread();
            $customer_order_thread->order_id = $order_id;
            $customer_order_thread->user_id = $user_id;
            $customer_order_thread->user_name = Auth::user()->name;
            $customer_order_thread->text = $text;
            if ($customer_order_thread->save()) {
                $responseBody = $this->responseBody(true, "CustomerOrderThreadController", "submit", true);
            } else {
                $responseBody = $this->responseBody(false, "CustomerOrderThreadController", "submit", false);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "error", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }


    public function loadCustomerOrderThread($order_id)
    {
        try {
            $customer_order_threads = CustomerOrderThread::where('order_id', '=', $order_id)->get();
            foreach ($customer_order_threads as $thread) {
                $data = '';
                $img = '/images/employee.jpg';
                if ($thread->user_name == 'admin') {
                    $data = $thread->created_at . " - Admin";
                }
                $employee = Employee::find($thread->user_id);
                if ($employee) {
                    $data = $thread->created_at . " - ".$employee->name_withinitial;
                    $img = $employee->photo_parth;
                }
                $thread->data = $data;
                $thread->img = $img;
            }

            $responseBody = $this->responseBody(true, "CustomerOrderThreadController", "allCustomerOrder", $customer_order_threads);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "CustomerOrderThreadController", "allCustomerOrder", $exception);
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
