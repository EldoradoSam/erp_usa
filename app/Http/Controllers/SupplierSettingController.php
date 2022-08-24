<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BankBranch;
use App\Models\Country;
use App\Models\District;
use App\Models\GLPosting;
use App\Models\SupplierStatus;
use App\Models\SupplierType;
use App\Models\Town;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class SupplierSettingController extends Controller
{
    // This function is use to save a country
    function SaveCountry(Request $request)
    {
        try {
            $value = $request->get('value');
            $object = new Country();
            $object->country = $value;
            $save = $object->save();

            if ($save) {
                $responseBody = $this->responseBody(true, "country", "Saved", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "country", $exception, null);
        }
        return response()->json(["data" => $responseBody]);
    }

    // This function is use to save a district
    function SaveDistrict(Request $request)
    {
        try {
            $value = $request->get('value');
            $object = new District();
            $object->district = $value;
            $save = $object->save();

            if ($save) {
                $responseBody = $this->responseBody(true, "district", "Saved", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(true, "district", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    // This function is use to save a town
    function SaveTown(Request $request)
    {
        try {
            $value = $request->get('value');
            $district_id = $request->get('district_id');
            $object = new Town();
            $object->town = $value;
            $object->district_foreign_id = $district_id;
            $object->status = true;
            $save = $object->save();

            if ($save) {
                $responseBody = $this->responseBody(true, "town", "Saved", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "town", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    // This function is use to save a supplier type
    function SaveSupplierType(Request $request)
    {
        try {
            $value = $request->get('value');
            $object = new SupplierType();
            $object->supplier_type = $value;
            $save = $object->save();

            if ($save) {
                $responseBody = $this->responseBody(true, "supplierType", "Saved", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "supplierType", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    // This function is use to save a supplier status
    function SaveSupplierStatus(Request $request)
    {
        try {
            $value = $request->get('value');
            $object = new SupplierStatus();
            $object->supplier_status = $value;
            $save = $object->save();

            if ($save) {
                $responseBody = $this->responseBody(true, "supplierStatus", "Saved", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(true, "supplierStatus", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    // This function is use to save a bank
    function SaveBank(Request $request)
    {
        try {
            $value = $request->get('value');
            $object = new Bank();
            $object->bank_name = $value;
            $save = $object->save();

            if ($save) {
                $responseBody = $this->responseBody(true, "bank", "Saved", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "bank", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    // This function is use to save a bank branch
    function SaveBankBranch(Request $request)
    {
        try {
            $value = $request->get('value');
            $object = new BankBranch();
            $object->bank_branch_name = $value;
            $save = $object->save();

            if ($save) {
                $responseBody = $this->responseBody(true, "bankBranch", "Saved", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "bankBranch", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    // This function is use to get all country data
    function AllCountry()
    {
        try {
            // $SSC=new SupplierSettingsController();
            $result = $this->AllSettings('country');
            $responseBody = $this->responseBody(true, "country", "Found", $result);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "country", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }


    // This function is use to get all country data
    function AllGLPostData()
    {
        try {
            // $SSC=new SupplierSettingsController();
            $result = $this->AllSettings('gl_posting');
            $responseBody = $this->responseBody(true, "gl_posting", "Found", $result);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "gl_posting", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }


    // This function is use to get all district data
    function AllDistrict()
    {
        try {
            $result = $this->AllSettings('district');
            $responseBody = $this->responseBody(true, "district", "Found", $result);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "district", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    // This function is use to get all town data
    function AllTown()
    {
        try {
            $result = $this->AllSettings('town');
            // $district_id = $result->district_foreign_id;
            // $district_name = District::find($district_id);
            $responseBody = $this->responseBody(true, "town", "Found", $result);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "town", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    // This function is use to get all supplier type data
    function AllSupplierType()
    {
        try {
            // $result = $this->AllSettings('supplierType');

            // $result = SupplierType::where('status',1)->get(); old code
            $types = new SupplierType();
            $result = $types->all(); //error fixed by nipuna

            $responseBody = $this->responseBody(true, "supplierType", "Found", $result);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "supplierType", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    // This function is use to get all supplier status data
    function AllSupplierStatus()
    {
        try {
            $result = $this->AllSettings('supplierStatus');
            $responseBody = $this->responseBody(true, "supplierStatus", "Found", $result);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "supplierStatus", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    // This function is use to get all bank data
    function AllBanks()
    {
        try {
            $result = $this->AllSettings('banks');
            $responseBody = $this->responseBody(true, "bank", "Found", $result);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "bank", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    // This function is use to get all bank branch data
    function AllBankBranches()
    {
        try {
            $result = $this->AllSettings('bankBranch');
            $responseBody = $this->responseBody(true, "bankBranch", "Found", $result);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "bankBranch", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    // All Settings Function
    function AllSettings($name)
    {
        if ($name == 'country') {
            return Country::all();
        } else if ($name == 'district') {
            return District::all();
        } else if ($name == 'supplierType') {
            return SupplierType::all();
        } else if ($name == 'supplierStatus') {
            return SupplierStatus::all();
        } else if ($name == 'town') {
            return Town::all();
        } else if ($name == 'banks') {
            return Bank::all();
        } else if ($name == 'bankBranch') {
            return BankBranch::all();
        } else if ($name == 'gl_posting') {
            return GLPosting::all();
        }
    }

    // This function is use to update a country
    function UpdateCountry(Request $request, $id)
    {
        try {
            $value = $request->get('country');

            $object = Country::find($id);
            $object->country = $value;
            $update = $object->save();

            if ($update) {
                $responseBody = $this->responseBody(true, "country", "Updated", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "country", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    // This function is use to update a district
    function UpdateDistrict(Request $request, $id)
    {
        try {
            $value = $request->get('district');

            $object = District::find($id);
            $object->district = $value;
            $update = $object->save();

            if ($update) {
                $responseBody = $this->responseBody(true, "district", "Updated", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "district", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    // This functioin is use to update a town
    function UpdateTown(Request $request, $id)
    {
        try {
            $value = $request->get('town');
            $district_id = $request->get('selectDistrict');

            $object = Town::find($id);
            $object->district_foreign_id = $district_id;
            $object->town = $value;
            $update = $object->save();

            if ($update) {
                $responseBody = $this->responseBody(true, "town", "Updated", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(true, "town", "Updated", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    // This function is use to update a supplier type
    function UpdateSupplierType(Request $request, $id)
    {
        try {
            $value = $request->get('supplierType');

            $object = SupplierType::find($id);
            $object->supplier_type = $value;
            $update = $object->save();

            if ($update) {
                $responseBody = $this->responseBody(true, "supplierType", "Updated", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "supplierType", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    // This function is use  to update supplier status
    function UpdateSupplierStatus(Request $request, $id)
    {
        try {
            $value = $request->get('supplierStatus');

            $object = SupplierStatus::find($id);
            $object->supplier_status = $value;
            $update = $object->save();

            if ($update) {
                $responseBody = $this->responseBody(true, "supplierStatus", "Updated", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "supplierStatus", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    // This function is use to update bank
    function UpdateBank(Request $request, $id)
    {
        try {
            $value = $request->get('bank');

            $object = Bank::find($id);
            $object->bank_name = $value;
            $update = $object->save();

            if ($update) {
                $responseBody = $this->responseBody(true, "bank", "Updated", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "bank", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    // This function is use to update bank branch
    function UpdateBankBranch(Request $request, $id)
    {
        try {
            $value = $request->get('bankBranch');

            $object = BankBranch::find($id);
            $object->bank_branch_name = $value;
            $update = $object->save();

            if ($update) {
                $responseBody = $this->responseBody(true, "bankBranch", "Updated", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "bankBranch", "Updated", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    // Disable country
    function DisableCountry(Request $request, $id)
    {
        try {
            $value = $request->get('status');

            $object = Country::find($id);
            $object->status = $value;
            $update = $object->save();
            $res = $object->status;
            if ($update) {
                $responseBody = $this->responseBody(true, "country", "updated", $res);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "country", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    // Disable District
    function DisableDistrict(Request $request, $id)
    {
        try {
            $value = $request->get('status');

            $object = District::find($id);
            $object->status = $value;
            $update = $object->save();
            $res = $object->status;
            if ($update) {
                $responseBody = $this->responseBody(true, "district", "updated", $res);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "district", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    // Disable Town
    function DisableTown(Request $request, $id)
    {
        try {
            $value = $request->get('status');

            $object = Town::find($id);
            $object->status = $value;
            $update = $object->save();
            $res = $object->status;
            if ($update) {
                $responseBody = $this->responseBody(true, "town", "updated", $res);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "town", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    // Disable Supplier Type
    function DisableSupplierType(Request $request, $id)
    {
        try {
            $value = $request->get('status');

            $object = SupplierType::find($id);
            $object->status = $value;
            $update = $object->save();
            $res = $object->status;
            if ($update) {
                $responseBody = $this->responseBody(true, "supplierType", "updated", $res);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "town", "supplierType", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    // Disable supplier status
    function DisableSupplierStatus(Request $request, $id)
    {
        try {
            $value = $request->get('status');

            $object = SupplierStatus::find($id);
            $object->status = $value;
            $update = $object->save();
            $res = $object->status;
            if ($update) {
                $responseBody = $this->responseBody(true, "supplierStatus", "updated", $res);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "town", "supplierStatus", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    // Disable Bank
    function DisableBank(Request $request, $id)
    {
        try {
            $value = $request->get('status');

            $object = Bank::find($id);
            $object->status = $value;
            $update = $object->save();
            $res = $object->status;
            if ($update) {
                $responseBody = $this->responseBody(true, "bank", "Updated", $res);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "bank", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    // Disable Ban Branch
    function DisableBankBranch(Request $request, $id)
    {
        try {
            $value = $request->get('status');

            $object = BankBranch::find($id);
            $object->status = $value;
            $update = $object->save();
            $res = $object->status;
            if ($update) {
                $responseBody = $this->responseBody(true, "bankBranch", "Updated", $res);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "bankBranch", "Error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    // responseBody function
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
