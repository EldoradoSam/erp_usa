<?php

namespace App\Http\Controllers;

// use Dotenv\Validator;

use App\Models\Country;
use App\Models\Customer;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderData;
use App\Models\DrainHoleShape;
use App\Models\DrainHoleSize;
use App\Models\OrderAttachment;
use App\Models\Productmix;
use App\Models\Shippingterm;
use App\Models\Washedlevel;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class CustomerOrderController extends Controller
{


    /**
     * save
     * This function is used to save new order to database.
     * @param request This is the paramter to save function
     * @return Json This returns as response.
     */
    public function save(Request $request)
    {

        try {

            $order = new CustomerOrder();
            $order->customer_name = $request->get('name');
            $order->purchase_order = $request->get('txtPurchase');
            $order->factory_po_num = $request->get('txtFactoryPo');
            $order->invoice_num = $request->get('txtInvoiceNumber');
            $order->bill_address = $request->get('txtBillAddress');
            $order->delivery_address = $request->get('txtDeliveryAddress');
            $order->cosignee_details = $request->get('txtCosigneeDetails');
            $order->party_details = $request->get('txtPartyDetails');
            $order->country_id = $request->get('cmbCountry');
            $order->date = $request->get('dteDate');
            $order->delivery_date = $request->get('dteDeliveryDate');
            $order->shipping_term_id = $request->get('selcShippingTerms');
            $order->name_fill = $request->get('txtFillName');
            $order->remarks = $request->get('remarks');
            $order->production_status = true;
            $order->status = true;
            $save = $order->save();

            if ($save) {
                $responseBody = $this->responseBody(true, "Order", "saved", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "error", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }


    /**
     * settings
     * This function is used to search settings records from the database.
     * @return Json This returns as response.
     */
    public function settings()
    {

        try {

            $shippingTerm = SettingsController::allEnableSettings("ShippingTerm");
            $productMix = SettingsController::allEnableSettings("ProductMix");
            $washedLevel = SettingsController::allEnableSettings("WashedLevel");

            $result = [
                "ShippingTerm" => $shippingTerm,
                "ProductMix" => $productMix,
                "WashedLevel" =>  $washedLevel,

            ];
            $responseBody = $this->responseBody(true, "Settings", "all", $result);
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


    /**
     * allOrder
     * This function is used to search all Order records from the database.
     * @return Json This returns as response.
     */
    public function allOrder()
    {

        try {
            $order =  CustomerOrder::orderBy('customer_name')->get();
            $responseBody = $this->responseBody(true, "Order", "all", $order);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "error", "error", $exception);
        }

        return response()->json(["data" => $responseBody]);
    }

    /**
     * order
     * This function is used to search order from order id.
     * @return Json This returns as response.
     */
    public function order($id)
    {

        try {
            $order = CustomerOrder::find($id);
            $shippingterm = SettingsController::getSettingsFromID('ShippingTerm', $order->shipping_term_id);

            $settings = [
                "shippingterm" => $shippingterm->shipping_term,
            ];

            $responseBody = $this->responseBody(true, "CustomerOrder", "all", ["order" => $order, "settings" => $settings]);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "error", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }



    /**
     * update
     * This function is used to update order.
     * @param request This is the paramter to update function
     * @return Json This returns as response.
     */
    public function update(Request $request)
    {

        try {
            $id = $request->get('hidOrderID');
            $order = CustomerOrder::find($id);
            $order->customer_name = $request->get('name');
            $order->purchase_order = $request->get('txtPurchase');

            $order->factory_po_num = $request->get('txtFactoryPo');
            $order->invoice_num = $request->get('txtInvoiceNumber');

            $order->bill_address = $request->get('txtBillAddress');
            $order->delivery_address = $request->get('txtDeliveryAddress');
            $order->cosignee_details = $request->get('txtCosigneeDetails');
            $order->party_details = $request->get('txtPartyDetails');
            $order->country_id = $request->get('cmbCountry');
            $order->date = $request->get('dteDate');
            $order->delivery_date = $request->get('dteDeliveryDate');
            $order->shipping_term_id = $request->get('selcShippingTerms');
            $order->name_fill = $request->get('txtFillName');
            $order->remarks = $request->get('remarks');

            $save = $order->save();

            $save = $order->save();


            if ($save) {
                $responseBody = $this->responseBody(true, "Order", "updated", "");
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "error", "error", $exception->getMessage());
        }
        return response()->json(["data" => $responseBody]);
    }


    /**
     * delete
     * This function is used to delete order from order id.
     * @return Json This returns as response.
     */
    public function delete($id)
    {
        try {
            $order = CustomerOrder::find($id);
            $delete = $order->delete();
            $orderdata = CustomerOrderData::where('order_id', $id)->delete();
            if ($delete) {
                $responseBody = $this->responseBody(true, "Order", "deleted", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "error", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    /**
     * saveData
     * This function is used to save new order data to database.
     * @param request This is the paramter to save function
     * @return Json This returns as response.
     */
    public function saveData(Request $request)
    {
        //validated by nipuna
        $validatedData = $request->validate([
            'txtProductType' => 'required',
            'txtProductCode' => 'required',
            'txtDimensions' => 'required',
            'txtQtyPieces' => 'required'
        ]);

        try {

            $orderData = new CustomerOrderData();
            $orderData->order_id = $request->get('hidOrderDataID');
            $orderData->product_type = $request->get('txtProductType');
            $orderData->product_code = $request->get('txtProductCode');
            $orderData->product_dimensions = $request->get('txtDimensions');
            $orderData->product_mix_id = $request->get('selcProductMix');
            $orderData->washed_level_id = $request->get('selcWashedLevel');
            $orderData->naked_plank = $this->isBoolean($request->get('group1'));
            $orderData->slab_position = $request->get('selcSlabPosition');
            $orderData->dripper_holes = $this->isBoolean($request->get('group2'));
            $orderData->no_of_dripper = $request->get('txtDripperHoles');
            $orderData->drain_holes = $this->isBoolean($request->get('group3'));
            $orderData->no_of_drain = $request->get('txtDrainHoles');
            $orderData->drain_holes_size = $request->get('txtDrainHolesSize');
            $orderData->plant_holes = $this->isBoolean($request->get('group4'));
            $orderData->no_of_plant = $request->get('txtPlantHoles');
            $orderData->plant_holes_size = $request->get('txtPlantHolesSize');
            $orderData->standing_Lying = $request->get('selcPlantHoles');
            $orderData->Bio_Degratable_Bags = $this->isBoolean($request->get('group5'));
            $orderData->pallet = $request->get('selcPallet');
            $orderData->Bottom_Mesh_Liner = $this->isBoolean($request->get('group6'));
            $orderData->Boxes_Cases = $this->isBoolean($request->get('group7'));
            $orderData->pcs_per_boxes = $request->get('txtPcsPerBoxes');
            $orderData->boxes_pallet = $request->get('txtBoxesPallet');
            $orderData->boxes_master_cartoon = $request->get('txtBoxesMasterCartoon');
            $orderData->master_cartoon_pallets = $request->get('txtMasterCartoonPallets');
            $orderData->quantity_pieces = $request->get('txtQtyPieces');

            //by nipuna start
            $orderData->dug_holes = $this->isBoolean($request->get('group8'));
            $orderData->no_of_dug = $request->get('txtDugHoles');
            $orderData->dug_holes_size = $request->get('txtDugHolesSize');
            $orderData->vegetableCheck = $request->has('vegetableCheck');
            $orderData->berryCheck = $request->has('berryCheck');
            $orderData->flowersCheck = $request->has('flowersCheck');
            $orderData->PCMCheck = $request->has('PCMCheck');
            $orderData->OthersCheck = $request->has('OthersCheck');
            //by nipuna ends

            $save = $orderData->save();

            if ($save) {
                $responseBody = $this->responseBody(true, "OrderData", "saved", $this->isBoolean($request->get('vegetableCheck')));
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "error", "error", $exception);
        }

        return response()->json(["data" => $responseBody]);
    }



    private function isBoolean($val)
    {
        if ($val == 'Yes') {
            return true;
        }
        return false;
    }

    /**
     * updateID
     * This function is used to update order id.
     * @param request This is the paramter to update function
     * @return Json This returns as response.
     */
    public function updateID(Request $request)
    {

        try {

            $orderID = DB::select("UPDATE pp_customer_orders_data
            SET order_id = (
                          SELECT order_id
                          FROM pp_customer_orders
                          ORDER BY order_id DESC
                          LIMIT 1
                        )
            WHERE order_id = 0;
            ");

            $responseBody = $this->responseBody(true, "Order", "updated", [$orderID]);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "error", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }


    /**
     * allOrderData
     * This function is used to search all Order order records from the database.
     * @return Json This returns as response.
     */
    public function allOrderDatax()
    {

        try {

            $orders = DB::table('pp_customer_orders_data')
                ->select('pp_customer_orders_data.*', 'pp_product_mixes.product_mix', 'pp_washed_levels.washed_level')
                ->join('pp_product_mixes', 'pp_product_mixes.product_mix_id', '=', 'pp_customer_orders_data.product_mix_id')
                ->join('pp_washed_levels', 'pp_washed_levels.washed_level_id', '=', 'pp_customer_orders_data.washed_level_id')
                ->where('order_id', '=', 0)
                ->get();

            $orderData = DB::select("SELECT
            if( naked_plank=0,'no', 'yes') as val01,
            if( dripper_holes=0,'no','yes' ) as val02,
            if( drain_holes=0,'no','yes' ) as val03,

            if( dug_holes=0,'no','yes' ) as val08,

            if( plant_holes=0,'no','yes' ) as val04,
            if( Bio_Degratable_Bags=0,'no','yes' ) as val05,
            if( Bottom_Mesh_Liner=0,'no','yes' ) as val06,

            if( vegetableCheck=0,'no','yes' ) as vegetable,
            if( berryCheck=0,'no','yes' ) as berry,
            if( flowersCheck=0,'no','yes' ) as flowers,
            if( PCMCheck=0,'no','yes' ) as PCM,
            if( OthersCheck=0,'no','yes' ) as Others,


            if( Boxes_Cases=0,'no','yes' ) as val07
            from pp_customer_orders_data
            WHERE order_id=0");
            //by nipuna

            $responseBody = $this->responseBody(true, "Order", "all", ["Order" => $orders, "OrderData" => $orderData]);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "error", "error", $exception);
        }

        return response()->json(["data" => $responseBody]);
    }


    /**
     * allOrderDataView
     * This function is used to search all Order data records in loadOrder from the database.
     * @return Json This returns as response.
     */
    public function allOrderDataView($id)
    {

        try {
            $orders = DB::table('pp_customer_orders_data')
                ->select('pp_customer_orders_data.*', 'pp_product_mixes.product_mix', 'pp_washed_levels.washed_level')
                ->join('pp_product_mixes', 'pp_product_mixes.product_mix_id', '=', 'pp_customer_orders_data.product_mix_id')
                ->join('pp_washed_levels', 'pp_washed_levels.washed_level_id', '=', 'pp_customer_orders_data.washed_level_id')
                ->where('order_id', '=', $id)
                ->get();

            $orderData = DB::select("SELECT
            if( naked_plank=0,'no', 'yes') as val01,
            if( dripper_holes=0,'no','yes' ) as val02,
            if( drain_holes=0,'no','yes' ) as val03,

            if( dug_holes=0,'no','yes' ) as val08,

            if( plant_holes=0,'no','yes' ) as val04,
            if( Bio_Degratable_Bags=0,'no','yes' ) as val05,
            if( Bottom_Mesh_Liner=0,'no','yes' ) as val06,

            if( vegetableCheck=0,'no','yes' ) as vegetable,
            if( berryCheck=0,'no','yes' ) as berry,
            if( flowersCheck=0,'no','yes' ) as flowers,
            if( PCMCheck=0,'no','yes' ) as PCM,
            if( OthersCheck=0,'no','yes' ) as Others,

            if( Boxes_Cases=0,'no','yes' ) as val07
            from pp_customer_orders_data
            WHERE order_id='" . $id . "'");


            $responseBody = $this->responseBody(true, "Order", "all", ["Order" => $orders, "OrderData" => $orderData]);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "error", "error", $exception);
        }

        return response()->json(["data" => $responseBody]);
    }


    /**
     * orderData
     * This function is used to search order from order data id.
     * @return Json This returns as response.
     */
    public function orderData($id)
    {


        try {
            $orderData = CustomerOrderData::find($id);
            $productmix = SettingsController::getSettingsFromID('ProductMix', $orderData->product_mix_id);
            $washedlevel = SettingsController::getSettingsFromID('WashedLevel', $orderData->washed_level_id);


            $settings = [
                "productmix" => $productmix->product_mix,
                "washedlevel" => $washedlevel->washed_level,
            ];

            $responseBody = $this->responseBody(true, "orderData", "all", ["OrderData" => $orderData, "settings" => $settings]);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "error", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    /**
     * updateOrderData
     * This function is used to update customer order data.
     * @param request This is the paramter to update function
     * @return Json This returns as response.
     */
    public function updateOrderDatax(Request $request)
    {
        try {

            $id = $request->get('hidOrderDataID');
            $orderData = CustomerOrderData::find($id);
            $orderData->product_type = $request->get('txtProductType');
            $orderData->product_code = $request->get('txtProductCode');
            $orderData->product_dimensions = $request->get('txtDimensions');
            $orderData->product_mix_id = $request->get('selcProductMix');
            $orderData->washed_level_id = $request->get('selcWashedLevel');
            $orderData->naked_plank = $this->isBoolean($request->get('group1'));
            $orderData->slab_position = $request->get('selcSlabPosition');
            $orderData->dripper_holes = $this->isBoolean($request->get('group2'));
            $orderData->no_of_dripper = $request->get('txtDripperHoles');
            $orderData->drain_holes = $this->isBoolean($request->get('group3'));
            $orderData->no_of_drain = $request->get('txtDrainHoles');
            $orderData->drain_holes_size = $request->get('txtDrainHolesSize');
            $orderData->plant_holes = $this->isBoolean($request->get('group4'));
            $orderData->no_of_plant = $request->get('txtPlantHoles');
            $orderData->plant_holes_size = $request->get('txtPlantHolesSize');
            $orderData->standing_Lying = $request->get('selcPlantHoles');
            $orderData->Bio_Degratable_Bags = $this->isBoolean($request->get('group5'));
            $orderData->pallet = $request->get('selcPallet');
            $orderData->Bottom_Mesh_Liner = $this->isBoolean($request->get('group6'));
            $orderData->Boxes_Cases = $this->isBoolean($request->get('group7'));
            $orderData->pcs_per_boxes = $request->get('txtPcsPerBoxes');
            $orderData->boxes_pallet = $request->get('txtBoxesPallet');
            $orderData->boxes_master_cartoon = $request->get('txtBoxesMasterCartoon');
            $orderData->master_cartoon_pallets = $request->get('txtMasterCartoonPallets');
            $orderData->quantity_pieces = $request->get('txtQtyPieces');

            //by nipuna start
            $orderData->dug_holes = $this->isBoolean($request->get('group8'));
            $orderData->no_of_dug = $request->get('txtDugHoles');
            $orderData->dug_holes_size = $request->get('txtDugHolesSize');
            $orderData->vegetableCheck = $request->has('vegetableCheck');
            $orderData->berryCheck = $request->has('berryCheck');
            $orderData->flowersCheck = $request->has('flowersCheck');
            $orderData->PCMCheck = $request->has('PCMCheck');
            $orderData->OthersCheck = $request->has('OthersCheck');
            //by nipuna ends

            $save = $orderData->save();

            if ($save) {
                $responseBody = $this->responseBody(true, "OrderData", "updated",  $orderData);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "error", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    /**
     * delete
     * This function is used to delete order data from order data id.
     * @return Json This returns as response.
     */
    public function deleteData($id)
    {
        try {
            $orderData = CustomerOrderData::find($id);
            $delete = $orderData->delete();
            if ($delete) {
                $responseBody = $this->responseBody(true, "Order", "deleted", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "error", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    /**
     * disableTown
     * This function is used to disable records.
     * @param request This is the paramter to disable function
     * @param id This is the paramter for identify update record.
     */
    public function disable(Request $request, $id)
    {
        try {

            $value = $request->get('status');

            $object = CustomerOrder::find($id);
            $object->status = $value;
            $update = $object->save();
            if ($update) {
                $responseBody = $this->responseBody(true, "Order", "updated", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "Order", "error", null);
        }
        return response()->json(["data" => $responseBody]);
    }


    public function allCustomers()
    {
        try {

            //$customer_arr = [];
            //$this->middleware(function ($request, $next) {

                /*if (Auth::user()->user_type == 'Customer') {
                    $customer_arr = [];
                } else {*/
                    $customer_arr = [];

                    $customers = Customer::all();

                    foreach ($customers as $customer) {
                        array_push($customer_arr, ["img" => "", "id" => $customer['customer_id'], "value" => $customer['customer_name']]);
                    }
                //}
            //});



            $responseBody = $this->responseBody(true, "all customers", "found", $customer_arr);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "customers", "error", null);
        }
        return response()->json(["data" => $responseBody]);
    }

    public function SelectedCustomersData($id)
    {
        try {

            $customer = Customer::where('customer_id', $id)->first();


            $responseBody = $this->responseBody(true, "Selected customers", "found", $customer);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "Selected customers", "error", $exception->getMessage());
        }
        return response()->json(["data" => $responseBody]);
    }
    public function loadPreviousData($id)
    {
        try {

            $customerorder = CustomerOrderData::where('product_code', $id)->first();


            $responseBody = $this->responseBody(true, "loadPreviousData", "found", $customerorder);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "loadPreviousData", "error", $exception->getMessage());
        }
        return response()->json(["data" => $responseBody]);
    }



    public function allCountries()
    {
        try {

            $countries = Country::where('status', '=', 1)->get();
            $responseBody = $this->responseBody(true, "CustomerOrderController", "allCountries", $countries);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "CustomerOrderController", "error", $exception->getMessage());
        }
        return response()->json(["data" => $responseBody]);
    }




    public function allShippingTerms()
    {
        try {

            $shipping_terms = Shippingterm::where('status', '=', '1')->get();
            $responseBody = $this->responseBody(true, "CustomerOrderController", "allShippingTerms", $shipping_terms);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "CustomerOrderController", "error", $exception->getMessage());
        }
        return response()->json(["data" => $responseBody]);
    }








    public function allDrainHoleSize()
    {
        try {

            $holes =  DrainHoleSize::where('status', '=', 1)->get();
            $responseBody = $this->responseBody(true, "allDrainHoleSize", "found", $holes);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "allDrainHoleSize", "error", null);
        }
        return response()->json(["data" => $responseBody]);
    }


    public function allDrainHoleShape()
    {
        try {

            $holes =  DrainHoleShape::where('status', '=', 1)->get();
            $responseBody = $this->responseBody(true, "allDrainHoleShape", "found", $holes);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "allDrainHoleShape", "error", null);
        }
        return response()->json(["data" => $responseBody]);
    }



    public function allProductMix()
    {
        try {

            $mix =  Productmix::where('status', '=', 1)->get();
            $responseBody = $this->responseBody(true, "allProductMix", "found", $mix);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "allProductMix", "error", null);
        }
        return response()->json(["data" => $responseBody]);
    }




    public function allWashedLevel()
    {
        try {

            $washed =  Washedlevel::where('status', '=', 1)->get();
            $responseBody = $this->responseBody(true, "allWashedLevel", "found", $washed);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "allWashedLevel", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }



    public function allOrderDataWithToken($id, $token)
    {
        try {

            $orderData =  DB::select('SELECT *FROM pp_customer_orders_data WHERE token = "' . $token . '" AND  (order_id = "' . $id . '" OR order_id = "0")');
            $responseBody = $this->responseBody(true, "allOrderDataWithToken", "found", $orderData);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "allOrderDataWithToken", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }


    public function allOrderData($id)
    {
        try {

            $orderData =  DB::select('SELECT *FROM pp_customer_orders_data WHERE  order_id = "' . $id . '"');
            $responseBody = $this->responseBody(true, "allOrderData", "found", $orderData);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "allOrderData", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }



    public function getCustomerAllOrderData($id)
    {
        try {
            $query = "SELECT '' AS img,pp_customer_orders_data.order_data_id AS id,pp_customer_orders_data.product_type AS value FROM pp_customer_orders_data INNER JOIN pp_customer_orders 
            ON pp_customer_orders_data.order_id = pp_customer_orders.order_id WHERE pp_customer_orders.customer_id = '" . $id . "'";
            $responseBody = $this->responseBody(true, "getCustomerAllOrderData", "found", DB::select($query));
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "getCustomerAllOrderData", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }


    public function getCustomerOrderData($id)
    {
        try {
            $order_data = CustomerOrderData::find($id);
            $responseBody = $this->responseBody(true, "getCustomerOrderData", "found", $order_data);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "getCustomerOrderData", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }


    public function getCustomerMainOrder($id)
    {
        try {
            $order = CustomerOrder::find($id);
            $responseBody = $this->responseBody(true, "getCustomerMainOrder", "found", $order);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "getCustomerMainOrder", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }


    public function saveOrderData(Request $request)
    {

        try {

            $orderData = json_decode($request->get('order_data'));
            $customer_order_data = new CustomerOrderData();
            $customer_order_data->order_id = "000";
            $customer_order_data->product_type = $orderData->product_type;
            $customer_order_data->product_code = $orderData->product_code;
            $customer_order_data->product_dimensions = $orderData->product_dimension;
            $customer_order_data->product_mix_id = $orderData->product_mix_id;
            $customer_order_data->washed_level_id = $orderData->washed_level_id;
            $customer_order_data->naked_plank = $orderData->naked_plank;
            $customer_order_data->slab_position = $orderData->slab_psition_id;
            $customer_order_data->dripper_holes = $orderData->dripper_holes;
            $customer_order_data->no_of_dripper = $orderData->dripper_holes_no;
            $customer_order_data->drain_holes = $orderData->drain_holes;
            $customer_order_data->no_of_drain = $orderData->drain_holes_no;
            $customer_order_data->drain_holes_size = $orderData->drain_holes_size_id;
            $customer_order_data->drain_holes_shape = $orderData->drain_holes_shape_id;
            $customer_order_data->dug_holes = $orderData->dug_holes;
            $customer_order_data->no_of_dug = $orderData->dug_holes_no;
            $customer_order_data->dug_holes_size = $orderData->dug_holes_size;
            $customer_order_data->vegetableCheck = $orderData->vegetable;
            $customer_order_data->berryCheck = $orderData->berry;
            $customer_order_data->flowersCheck = $orderData->flowers;
            $customer_order_data->PCMCheck = $orderData->pcm;
            $customer_order_data->OthersCheck = $orderData->others;
            $customer_order_data->plant_holes = $orderData->plant_holes;
            $customer_order_data->no_of_plant = $orderData->plant_holes_no;
            $customer_order_data->plant_holes_size = $orderData->plant_holes_size;
            $customer_order_data->standing_Lying = $orderData->plant_holes_standing_lying_id;
            $customer_order_data->Bio_Degratable_Bags = $orderData->bags;
            $customer_order_data->pallet = $orderData->pallet_id;
            $customer_order_data->Bottom_Mesh_Liner = $orderData->mesh_liner;
            $customer_order_data->Boxes_Cases = $orderData->boxes_cases;
            $customer_order_data->pcs_per_boxes = $orderData->pcs_boxes;
            $customer_order_data->boxes_pallet = $orderData->boxess_pallet;
            $customer_order_data->boxes_master_cartoon = $orderData->boxess_cartoon;
            $customer_order_data->master_cartoon_pallets = $orderData->master_pallet;
            $customer_order_data->quantity_pieces = $orderData->quantity;
            $customer_order_data->token = $orderData->token;
            $customer_order_data->save();
            $responseBody = $this->responseBody(true, "saveOrderData", "found", $orderData);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "saveOrderData", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }







    public function saveCustomerOrder(Request $request)
    {

        try {

            $order = json_decode($request->get('order'));
            $customer_order = new CustomerOrder();
            $customer_order->customer_id = $order->customer_id;
            $customer_order->customer_name = $order->customer_name;
            $customer_order->purchase_order = $order->purchase_order;
            $customer_order->factory_po_num = $order->factory_po_num;
            $customer_order->invoice_num = $order->invoice_num;
            $customer_order->bill_address = $order->bill_address;
            $customer_order->delivery_address = $order->delivery_address;
            $customer_order->cosignee_details = $order->cosignee_details;
            $customer_order->party_details = $order->party_details;
            $customer_order->date = $order->date;
            $customer_order->country_id = $order->country_id;
            $customer_order->delivery_date = $order->delivery_date;
            $customer_order->shipping_term_id = $order->shipping_term_id;
            $customer_order->name_fill = $order->name_fill;
            $customer_order->remarks = $order->remarks;
            $customer_order->production_status = $order->production_status;
            $customer_order->status = $order->status;
            if ($customer_order->save()) {
                $orders_data = CustomerOrderData::where([['order_id', '=', 0], ['token', '=', $order->token]])->get();
                foreach ($orders_data as $data) {
                    $data->order_id = $customer_order->order_id;
                    $data->update();
                }
                $order_attachments = OrderAttachment::where([['order_id', '=', 0], ['token', '=', $order->token]])->get();
                foreach ($order_attachments as $attachment) {
                    $attachment->order_id = $customer_order->order_id;
                    $attachment->update();
                }
            }
            $responseBody = $this->responseBody(true, "saveOrder", "found", $customer_order->order_id);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "saveOrder", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }






    public function updateOrderData(Request $request, $id)
    {

        try {

            $orderData = json_decode($request->get('order_data'));
            $customer_order_data =  CustomerOrderData::find($id);
            $customer_order_data->product_type = $orderData->product_type;
            $customer_order_data->product_code = $orderData->product_code;
            $customer_order_data->product_dimensions = $orderData->product_dimension;
            $customer_order_data->product_mix_id = $orderData->product_mix_id;
            $customer_order_data->washed_level_id = $orderData->washed_level_id;
            $customer_order_data->naked_plank = $orderData->naked_plank;
            $customer_order_data->slab_position = $orderData->slab_psition_id;
            $customer_order_data->dripper_holes = $orderData->dripper_holes;
            $customer_order_data->no_of_dripper = $orderData->dripper_holes_no;
            $customer_order_data->drain_holes = $orderData->drain_holes;
            $customer_order_data->no_of_drain = $orderData->drain_holes_no;
            $customer_order_data->drain_holes_size = $orderData->drain_holes_size_id;
            $customer_order_data->drain_holes_shape = $orderData->drain_holes_shape_id;
            $customer_order_data->dug_holes = $orderData->dug_holes;
            $customer_order_data->no_of_dug = $orderData->dug_holes_no;
            $customer_order_data->dug_holes_size = $orderData->dug_holes_size;
            $customer_order_data->vegetableCheck = $orderData->vegetable;
            $customer_order_data->berryCheck = $orderData->berry;
            $customer_order_data->flowersCheck = $orderData->flowers;
            $customer_order_data->PCMCheck = $orderData->pcm;
            $customer_order_data->OthersCheck = $orderData->others;
            $customer_order_data->plant_holes = $orderData->plant_holes;
            $customer_order_data->no_of_plant = $orderData->plant_holes_no;
            $customer_order_data->plant_holes_size = $orderData->plant_holes_size;
            $customer_order_data->standing_Lying = $orderData->plant_holes_standing_lying_id;
            $customer_order_data->Bio_Degratable_Bags = $orderData->bags;
            $customer_order_data->pallet = $orderData->pallet_id;
            $customer_order_data->Bottom_Mesh_Liner = $orderData->mesh_liner;
            $customer_order_data->Boxes_Cases = $orderData->boxes_cases;
            $customer_order_data->pcs_per_boxes = $orderData->pcs_boxes;
            $customer_order_data->boxes_pallet = $orderData->boxess_pallet;
            $customer_order_data->boxes_master_cartoon = $orderData->boxess_cartoon;
            $customer_order_data->master_cartoon_pallets = $orderData->master_pallet;
            $customer_order_data->quantity_pieces = $orderData->quantity;
            $customer_order_data->update();
            $responseBody = $this->responseBody(true, "saveOrderData", "found", $orderData);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "saveOrderData", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }







    public function updateCustomerOrder(Request $request, $id)
    {

        try {

            $order = json_decode($request->get('order'));
            $customer_order =  CustomerOrder::find($id);
            $customer_order->customer_id = $order->customer_id;
            $customer_order->customer_name = $order->customer_name;
            $customer_order->purchase_order = $order->purchase_order;
            $customer_order->factory_po_num = $order->factory_po_num;
            $customer_order->invoice_num = $order->invoice_num;
            $customer_order->bill_address = $order->bill_address;
            $customer_order->delivery_address = $order->delivery_address;
            $customer_order->cosignee_details = $order->cosignee_details;
            $customer_order->party_details = $order->party_details;
            $customer_order->date = $order->date;
            $customer_order->country_id = $order->country_id;
            $customer_order->delivery_date = $order->delivery_date;
            $customer_order->shipping_term_id = $order->shipping_term_id;
            $customer_order->name_fill = $order->name_fill;
            $customer_order->remarks = $order->remarks;
            $customer_order->production_status = $order->production_status;
            $customer_order->status = $order->status;
            if ($customer_order->update()) {
                $orders_data = CustomerOrderData::where([['order_id', '=', 0], ['token', '=', $order->token]])->get();
                foreach ($orders_data as $data) {
                    $data->order_id = $customer_order->order_id;
                    $data->update();
                }
                $order_attachments = OrderAttachment::where([['order_id', '=', 0], ['token', '=', $order->token]])->get();
                foreach ($order_attachments as $attachment) {
                    $attachment->order_id = $customer_order->order_id;
                    $attachment->update();
                }
            }
            $responseBody = $this->responseBody(true, "updateCustomerOrder", "found", true);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "updateCustomerOrder", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }








    public function deleteOrderData($id)
    {

        try {

            $order_data = CustomerOrderData::find($id);
            $order_data->delete();
            $responseBody = $this->responseBody(true, "deleteOrderData", "found", true);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "deleteOrderData", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }




    public function deleteAttachment($id)
    {

        try {

            $attachment = OrderAttachment::find($id);
            $attachment->delete();
            $responseBody = $this->responseBody(true, "deleteAttachment", "found", true);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "deleteAttachment", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }




    public function uploadAttachment(Request $request)
    {

        $id = $request->get('order_id');
        $description = $request->get('foo');
        $token = $request->get('attachmnet_token');
        $file = $request->file('file');
        $file_name = $file->getClientOriginalName();
        $filename = uniqid() . '_' . time() . '.' . $file_name;
        $file->move(public_path('order'), $filename);

        $order_attachment = new OrderAttachment();
        $order_attachment->order_id = 0;
        $order_attachment->description = $description;
        $order_attachment->file_path = $filename;
        $order_attachment->token = $token;
        return $order_attachment->save();
    }





    public function allAttachment($id)
    {
        try {

            $attachment = DB::select('SELECT *FROM pp_order_attachments WHERE  order_id = "' . $id . '" OR order_id = "0"');
            $responseBody = $this->responseBody(true, "allAttachment", "found", $attachment);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "allAttachment", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }
}
