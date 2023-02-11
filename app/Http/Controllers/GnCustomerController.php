<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerContacts;
use App\Models\CustomerDelivery;
use App\Models\CustomerOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GnCustomerController extends Controller
{
    function checkcustomerID($id)
    {
        try {
            $Customerid = Customer::where('customer_id', $id)->first();
            if ($Customerid == null) {
                $responseBody = $this->responseBody(true, "customerid", "checked", null);
            } else {
                $responseBody = $this->responseBody(true, "customerid", "checked", $Customerid);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "customerid", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }
    // This function is use to save a supplier
    function saveCustomer(Request $request)
    {
        try {

            $web = $request->txtWebAddress;
            if ($web == NULL) {
                $web = "";
            }

            $notes = $request->textNotes;
            if ($notes == NULL) {
                $notes = "";
            }

            $Customer = new Customer();
            //$Customer->customer_id = $request->txtCustomerId;
            $Customer->customer_name = $request->txtCustomerName;
            $Customer->address = $request->txtAddress;
            $Customer->delivery_address = "";
            $Customer->cosignee_details = $request->txtCosigneeDetails;
            $Customer->party_details = $request->txtPartyDetails;
            $Customer->web = $web;
            $Customer->notes = $notes;
            $Customer->country_id = $request->selectCountry;
            $Customer->status_id = 1;
            $Customer->accountgroup_id = $request->selectAccountgroup_id;
            $Customer->create_from = 'USA';
            $saveCustomer = $Customer->save();

            if ($saveCustomer) {
                $responseBody = $this->responseBody(true, "customer", "Saved", $Customer->customer_id);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "customer", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }
    // This function is use to save a supplier
    function savecontacts(Request $request)
    {
        try {
            $contact = new CustomerContacts();

            $contact->customer_id = $request->hidecustomerId;
            $contact->designation = $request->txtDesignation;
            $contact->email = $request->txtEmail;
            $contact->mobile = $request->txtMobile;
            $contact->fixed = $request->txtFixedMobile;
            $contact->sms_alert = $request->has('checkSMSAlert');
            $contact->email_alert = $request->has('checkEmailAlert');
            $contact->primary = $request->has('checkPrimaryContact');
            $savecontact = $contact->save();

            if ($savecontact) {
                $responseBody = $this->responseBody(true, "savecontacts", "Saved", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "savecontacts", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }



    function saveCustomerDelivery(Request $request)
    {
        try {
            $delivery = new CustomerDelivery();

            $delivery->customer_id = $request->get('customer_id');
            $delivery->user = Auth::user()->id;
            $delivery->address = $request->get('address');
            $delivery->contact_no = $request->get('contact_no');

            if ($delivery->save()) {
                $responseBody = $this->responseBody(true, "saveCustomerDelivery", "Saved", null);
            } else {
                $responseBody = $this->responseBody(false, "saveCustomerDelivery", "error", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "saveCustomerDelivery", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }




    function updateCustomerDelivery(Request $request)
    {
        try {
            $delivery = CustomerDelivery::find($request->id);
            $delivery->user = Auth::user()->id;
            $delivery->address = $request->get('address');
            $delivery->contact_no = $request->get('contact_no');

            if ($delivery->update()) {
                $responseBody = $this->responseBody(true, "updateCustomerDelivery", "updated", null);
            } else {
                $responseBody = $this->responseBody(false, "updateCustomerDelivery", "error", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "updateCustomerDelivery", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }




    function loadcontacts($id)
    {
        try {
            $contact = CustomerContacts::where('customer_id', $id)->get();



            if ($contact) {
                $responseBody = $this->responseBody(true, "contacts", "found", $contact);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "contacts", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }



    function loadCustomerDeliveryData($id)
    {
        try {
            $delivery = CustomerDelivery::where('customer_id', $id)->get();



            if ($delivery) {
                $responseBody = $this->responseBody(true, "loadCustomerDeliveryData", "found", $delivery);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "loadCustomerDeliveryData", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }



    function deletecontacts($id)
    {
        try {
            $contact = CustomerContacts::where('contact_id', $id)->delete();

            $responseBody = $this->responseBody(true, "contacts delete", "deleted", $contact);
        } catch (\Exception $ex) {
            $responseBody = $this->responseBody(false, " contacts delete", "error", $ex);
        }
        return response()->json(["data" => $responseBody]);
    }




    function deleteDeliveryData($id)
    {
        try {
            $delivery = CustomerDelivery::where('id', $id)->delete();

            $responseBody = $this->responseBody(true, "deleteDeliveryData", "deleted", $delivery);
        } catch (\Exception $ex) {
            $responseBody = $this->responseBody(false, "deleteDeliveryData", "error", $ex);
        }
        return response()->json(["data" => $responseBody]);
    }



    function EditContct($id)
    {
        try {
            $contact = CustomerContacts::where('contact_id', $id)->first();

            $responseBody = $this->responseBody(true, "contacts edit data", "Sucess", $contact);
        } catch (\Exception $ex) {
            $responseBody = $this->responseBody(false, " contacts edit data", "error", $ex);
        }
        return response()->json(["data" => $responseBody]);
    }


    function editDeliveryData($id)
    {
        try {
            $delivery = CustomerDelivery::where('id', $id)->first();

            $responseBody = $this->responseBody(true, "editDeliveryData", "Sucess", $delivery);
        } catch (\Exception $ex) {
            $responseBody = $this->responseBody(false, "editDeliveryData", "error", $ex);
        }
        return response()->json(["data" => $responseBody]);
    }

    function updatecontacts(Request $request)
    {
        try {
            $contact = CustomerContacts::where('contact_id', $request->get('hidecontactId'))
                ->update([
                    'designation' => $request->get('txtDesignation'),
                    'email' => $request->get('txtEmail'),
                    'mobile' => $request->get('txtMobile'),
                    'fixed' => $request->get('txtFixedMobile'),
                    'sms_alert' => $request->has('checkSMSAlert'),
                    'email_alert' => $request->has('checkEmailAlert'),
                    'primary' => $request->has('checkPrimaryContact'),
                ]);

            if ($contact) {
                $responseBody = $this->responseBody(true, "contact", "updated", null);
            } else {
                $responseBody = $this->responseBody(false, " contact", "error", null);
            }
        } catch (\Exception $ex) {
            $responseBody = $this->responseBody(false, " machinary", "error", $ex);
        }
        return response()->json(["data" => $responseBody]);
    }
    function loadCustomers()
    {
        try {
            $Customer = Customer::where('create_from','=','USA')->get();

            if ($Customer) {
                $responseBody = $this->responseBody(true, "all Customer", "found", $Customer);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "all Customer", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }


    function deleteCustomer($id)
    {
        try {
            $Customer = Customer::where('customer_id', $id)->delete();

            $responseBody = $this->responseBody(true, "deleteCustomer", "deleted", $Customer);
        } catch (\Exception $ex) {
            $responseBody = $this->responseBody(false, "deleteCustomer", "error", $ex);
        }
        return response()->json(["data" => $responseBody]);
    }



    public function isAssignedCustomer($id)
    {

        $order = CustomerOrder::where('customer_id', '=', $id)->first();
        if ($order) {
            return 1;
        }
        return 0;
    }


    function EditCustomer($id)
    {
        try {
            $Customer = Customer::where('customer_id', $id)->first();

            $responseBody = $this->responseBody(true, "Customer edit data", "Sucess", $Customer);
        } catch (\Exception $ex) {
            $responseBody = $this->responseBody(false, " Customer edit data", "error", $ex);
        }
        return response()->json(["data" => $responseBody]);
    }
    function updateCustomer(Request $request)
    {
        try {
            $web = $request->txtWebAddress;
            if ($web == NULL) {
                $web = "";
            }

            $notes = $request->textNotes;
            if ($notes == NULL) {
                $notes = "";
            }

            $customer = Customer::find($request->get('hiddenCustomerId'));
            if ($customer) {
                $customer->customer_name = $request->get('txtCustomerName');
                $customer->address = $request->get('txtAddress');
                $customer->delivery_address = "";
                $customer->cosignee_details = $request->get('txtCosigneeDetails');
                $customer->party_details = $request->get('txtPartyDetails');
                $customer->web = $web;
                $customer->notes = $notes;
                $customer->country_id = $request->get('selectCountry');
                $customer->accountgroup_id = $request->get('selectAccountgroup_id');
                if ($customer->update()) {
                    $responseBody = $this->responseBody(true, "Customer", "updated", 'sssssssssss');
                } else {
                    $responseBody = $this->responseBody(false, " Customer", "error", "not updated");
                }
            }
        } catch (\Exception $ex) {
            $responseBody = $this->responseBody(false, " Customer", "error", $ex);
        }
        return response()->json(["data" => $responseBody]);
    }


    public function isAssignDeliveryData($id)
    {
        $order = CustomerOrder::where('delivery_address_id', '=', $id)->first();
        if ($order) {
            return 1;
        }
        return 0;
    }

    // Response Body function
    function responseBody($success, $name, $message, $result)
    {
        $body = [
            "success" => $success,
            "name" => $name,
            "message" => $message,
            "result" => $result
        ];
        return $body;
    }
}
