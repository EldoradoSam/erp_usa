<?php

namespace App\Http\Controllers;

use App\Models\DrainHoleShape;
use App\Models\DrainHoleSize;
use App\Models\Plantholesize;
use App\Models\Productmix;
use App\Models\ProductSize;
use App\Models\Shippingterm;
use App\Models\Washedlevel;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;


class SettingsController extends Controller
{
    /**
     * saveTown
     * This function is used to save new town to database.
     * @param request This is the paramter to saveTown function
     * @return Json This returns as response.
     */
    public function saveShippingTerm(Request $request)
    {

        try {
            $value = $request->get('value');
            $object = new Shippingterm();
            $object->shipping_term = $value;
            $object->status = true;
            $save = $object->save();

            if ($save) {
                $responseBody = $this->responseBody(true, "ShippingTerm", "saved", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "ShippingTerm", $exception, null);
        }
        return response()->json(["data" => $responseBody]);
    }

    /**
     * saveTown
     * This function is used to save new town to database.
     * @param request This is the paramter to saveTown function
     * @return Json This returns as response.
     */
    public function saveProductMix(Request $request)
    {

        try {
            $value = $request->get('value');
            $object = new Productmix();
            $object->product_mix = $value;
            $object->status = true;
            $save = $object->save();

            if ($save) {
                $responseBody = $this->responseBody(true, "ProductMix", "saved", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "ProductMix", $exception, null);
        }
        return response()->json(["data" => $responseBody]);
    }

    /**
     * saveTown
     * This function is used to save new town to database.
     * @param request This is the paramter to saveTown function
     * @return Json This returns as response.
     */
    public function saveWashedLevel(Request $request)
    {

        try {
            $value = $request->get('value');
            $object = new Washedlevel();
            $object->washed_level = $value;
            $object->status = true;
            $save = $object->save();

            if ($save) {
                $responseBody = $this->responseBody(true, "WashedLevel", "saved", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "WashedLevel", $exception, null);
        }
        return response()->json(["data" => $responseBody]);
    }

    /**
     * saveTown
     * This function is used to save new town to database.
     * @param request This is the paramter to saveTown function
     * @return Json This returns as response.
     */
    public function savePlantHoleSize(Request $request)
    {

        try {
            $value = $request->get('value');
            $object = new Plantholesize();
            $object->plant_hole_size = $value;
            $object->status = true;
            $save = $object->save();

            if ($save) {
                $responseBody = $this->responseBody(true, "PlantHoleSize", "saved", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "PlantHoleSize", $exception, null);
        }
        return response()->json(["data" => $responseBody]);
    }




    public function saveDrainHoleSize(Request $request)
    {

        try {
            $value = $request->get('value');
            $object = new DrainHoleSize();
            $object->size = $value;
            $object->status = true;
            $save = $object->save();

            if ($save) {
                $responseBody = $this->responseBody(true, "DrainHoleSize", "saved", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "DrainHoleSize", $exception, null);
        }
        return response()->json(["data" => $responseBody]);
    }




    
    public function saveDrainHoleShape(Request $request)
    {

        try {
            $value = $request->get('value');
            $object = new DrainHoleShape();
            $object->shape = $value;
            $object->status = true;
            $save = $object->save();

            if ($save) {
                $responseBody = $this->responseBody(true, "DrainHoleShape", "saved", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "DrainHoleShape", $exception, null);
        }
        return response()->json(["data" => $responseBody]);
    }




    public function saveProductSize(Request $request)
    {

        try {
            $value = $request->get('value');
            $object = new ProductSize();
            $object->size = $value;
            $object->status = true;
            $save = $object->save();

            if ($save) {
                $responseBody = $this->responseBody(true, "ProductSize", "saved", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "ProductSize", $exception, null);
        }
        return response()->json(["data" => $responseBody]);
    }



    /**
     * allTown
     * This function is used to search all town records from the database.
     * @return Json This returns as response.
     */
    public function allShippingTerm()
    {
        try {
            $result = SettingsController::allSettings('ShippingTerm');
            $responseBody = $this->responseBody(true, "ShippingTerm", "all", $result);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "ShippingTerm", "error", null);
        }
        return response()->json(["data" => $responseBody]);
    }

    /**
     * allTown
     * This function is used to search all town records from the database.
     * @return Json This returns as response.
     */
    public function allProductMix()
    {
        try {
            $result = SettingsController::allSettings('ProductMix');
            $responseBody = $this->responseBody(true, "ProductMix", "all", $result);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "ProductMix", "error", null);
        }
        return response()->json(["data" => $responseBody]);
    }

    /**
     * allTown
     * This function is used to search all town records from the database.
     * @return Json This returns as response.
     */
    public function allWashedLevel()
    {
        try {
            $result = SettingsController::allSettings('WashedLevel');
            $responseBody = $this->responseBody(true, "WashedLevel", "all", $result);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "WashedLevel", "error", null);
        }
        return response()->json(["data" => $responseBody]);
    }

    /**
     * allTown
     * This function is used to search all town records from the database.
     * @return Json This returns as response.
     */
    public function allPlantHoleSize()
    {
        try {
            $result = SettingsController::allSettings('PlantHoleSize');
            $responseBody = $this->responseBody(true, "PlantHoleSize", "all", $result);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "PlantHoleSize", "error", null);
        }
        return response()->json(["data" => $responseBody]);
    }



    public function allDrainHoleSize()
    {
        try {
            $result = SettingsController::allSettings('DrainHoleSize');
            $responseBody = $this->responseBody(true, "DrainHoleSize", "all", $result);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "DrainHoleSize", "error", null);
        }
        return response()->json(["data" => $responseBody]);
    }




    public function allDrainHoleShape()
    {
        try {
            $result = SettingsController::allSettings('DrainHoleShape');
            $responseBody = $this->responseBody(true, "DrainHoleShape", "all", $result);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "DrainHoleShape", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }


    public function allProductSize()
    {
        try {
            $result = SettingsController::allSettings('ProductSize');
            $responseBody = $this->responseBody(true, "ProductSize", "all", $result);
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "ProductSize", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }




    /**
     * updateTown
     * This function is used to update town records.
     * @param request This is the paramter to updateTown function
     * @return Json This returns as response.
     */
    public function updateShippingTerm(Request $request, $id)
    {


        try {
            $value = $request->get('ShippingTerm');

            $object = Shippingterm::find($id);
            $object->shipping_term = $value;
            $update = $object->save();
            if ($update) {
                $responseBody = $this->responseBody(true, "ShippingTerm", "updated", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "ShippingTerm", "error", null);
        }
        return response()->json(["data" => $responseBody]);
    }


    /**
     * updateCivilStatus
     * This function is used to update civilstatus records.
     * @param request This is the paramter to updateCivilStatus function
     * @return Json This returns as response.
     */
    public function updateProductMix(Request $request, $id)
    {

        try {
            $value = $request->get('ProductMix');

            $object = Productmix::find($id);
            $object->product_mix = $value;
            $update = $object->save();
            if ($update) {
                $responseBody = $this->responseBody(true, "ProductMix", "updated", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "ProductMix", "error", null);
        }
        return response()->json(["data" => $responseBody]);
    }


    /**
     * updateDesignation
     * This function is used to update designation records.
     * @param request This is the paramter to updateDesignation function
     * @return Json This returns as response.
     */
    public function updateWashedLevel(Request $request, $id)
    {

        try {
            $value = $request->get('WashedLevel');

            $object = Washedlevel::find($id);
            $object->washed_level = $value;
            $update = $object->save();
            if ($update) {
                $responseBody = $this->responseBody(true, "WashedLevel", "updated", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "WashedLevel", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }


    /**
     * updateEmployeeType
     * This function is used to update employee type records.
     * @param request This is the paramter to updateEmployeeType function
     * @return Json This returns as response.
     */
    public function updatePlantHoleSize(Request $request, $id)
    {

        try {
            $value = $request->get('PlantHoleSize');

            $object = Plantholesize::find($id);
            $object->plant_hole_size = $value;
            $update = $object->save();
            if ($update) {
                $responseBody = $this->responseBody(true, "PlantHoleSize", "updated", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "PlantHoleSize", "error", null);
        }
        return response()->json(["data" => $responseBody]);
    }




    public function updateDrainHoleSize(Request $request, $id)
    {

        try {
            $value = $request->get('DrainHoleSize');

            $object = DrainHoleSize::find($id);
            $object->size = $value;
            $update = $object->save();
            if ($update) {
                $responseBody = $this->responseBody(true, "DrainHoleSize", "updated", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "DrainHoleSize", "error", null);
        }
        return response()->json(["data" => $responseBody]);
    }





    public function updateDrainHoleShape(Request $request, $id)
    {

        try {
            $value = $request->get('DrainHoleShape');

            $object = DrainHoleShape::find($id);
            $object->shape = $value;
            $update = $object->save();
            if ($update) {
                $responseBody = $this->responseBody(true, "DrainHoleShape", "updated", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "DrainHoleShape", "error", null);
        }
        return response()->json(["data" => $responseBody]);
    }




    public function updateProductSize(Request $request, $id)
    {

        try {
            $value = $request->get('ProductSize');

            $object = ProductSize::find($id);
            $object->size = $value;
            $update = $object->save();
            if ($update) {
                $responseBody = $this->responseBody(true, "ProductSize", "updated", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "ProductSize", "error", null);
        }
        return response()->json(["data" => $responseBody]);
    }





    /**
     * allSettings
     * This is the main function of search all records from the database.
     * @param name This is the paramter,This is used to specifi table name
     * @return Json This returns as response.
     */
    public static function allSettings($name)
    {

        if ($name == 'ShippingTerm') {
            return Shippingterm::all();
        } else if ($name == 'ProductMix') {
            return Productmix::all();
        } else if ($name == 'WashedLevel') {
            return Washedlevel::all();
        } else if ($name == 'PlantHoleSize') {
            return Plantholesize::all();
        } else if ($name == 'DrainHoleSize') {
            return DrainHoleSize::all();
        } else if ($name == 'DrainHoleShape') {
            return DrainHoleShape::all();
        } else if ($name == 'ProductSize') {
            return ProductSize::all();
        }
    }





    public static function allEnableSettings($name)
    {

        if ($name == 'ShippingTerm') {
            return Shippingterm::where('status', '=', '1')->get();
        } else if ($name == 'ProductMix') {
            return Productmix::where('status', '=', '1')->get();
        } else if ($name == 'WashedLevel') {
            return Washedlevel::where('status', '=', '1')->get();
        } else if ($name == 'PlantHoleSize') {
            return Plantholesize::where('status', '=', '1')->get();
        }
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
     * disableTown
     * This function is used to disable town records.
     * @param request This is the paramter to disableTown function
     * @param id This is the paramter for identify update record.
     */
    public function disableShippingTerm(Request $request, $id)
    {
        try {

            $value = $request->get('status');

            $object = Shippingterm::find($id);
            $object->status = $value;
            $update = $object->save();
            if ($update) {
                $responseBody = $this->responseBody(true, "ShippingTerm", "updated", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "ShippingTerm", "error", null);
        }
        return response()->json(["data" => $responseBody]);
    }



    /**
     * desableCivilStatus
     * This function is used to disable civilstatus records.
     * @param request This is the paramter to desableCivilStatus function
     * @param id This is the paramter for identify update record.
     */
    public function disableProductMix(Request $request, $id)
    {
        try {

            $value = $request->get('status');

            $object = Productmix::find($id);
            $object->status = $value;
            $update = $object->save();
            if ($update) {
                $responseBody = $this->responseBody(true, "ProductMix", "updated", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "ProductMix", "error", null);
        }
        return response()->json(["data" => $responseBody]);
    }



    /**
     * disableDesignation
     * This function is used to disable designation records.
     * @param request This is the paramter to disableDesignation function
     * @param id This is the paramter for identify update record.
     */
    public function disableWashedLevel(Request $request, $id)
    {
        try {

            $value = $request->get('status');

            $object = Washedlevel::find($id);
            $object->status = $value;
            $update = $object->save();
            if ($update) {
                $responseBody = $this->responseBody(true, "WashedLevel", "updated", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "WashedLevel", "error", null);
        }
        return response()->json(["data" => $responseBody]);
    }




    /**
     * desableEmployeeType
     * This function is used to disable employee type records.
     * @param request This is the paramter to desableEmployeeType function
     * @param id This is the paramter for identify update record.
     */
    public function desablePlantHoleSize(Request $request, $id)
    {
        try {

            $value = $request->get('status');

            $object = Plantholesize::find($id);
            $object->status = $value;
            $update = $object->save();
            if ($update) {
                $responseBody = $this->responseBody(true, "PlantHoleSize", "updated", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "PlantHoleSize", "error", null);
        }
        return response()->json(["data" => $responseBody]);
    }



    public function desableDrainHoleSize(Request $request, $id)
    {
        try {

            $value = $request->get('status');

            $object = DrainHoleSize::find($id);
            $object->status = $value;
            $update = $object->save();
            if ($update) {
                $responseBody = $this->responseBody(true, "DrainHoleSize", "updated", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "DrainHoleSize", "error", null);
        }
        return response()->json(["data" => $responseBody]);
    }



    public function desableDrainHoleShape(Request $request, $id)
    {
        try {

            $value = $request->get('status');

            $object = DrainHoleShape::find($id);
            $object->status = $value;
            $update = $object->save();
            if ($update) {
                $responseBody = $this->responseBody(true, "DrainHoleShape", "updated", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "DrainHoleShape", "error", null);
        }
        return response()->json(["data" => $responseBody]);
    }





    public function desableProductSize(Request $request, $id)
    {
        try {

            $value = $request->get('status');

            $object = ProductSize::find($id);
            $object->status = $value;
            $update = $object->save();
            if ($update) {
                $responseBody = $this->responseBody(true, "ProductSize", "updated", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "ProductSize", "error", null);
        }
        return response()->json(["data" => $responseBody]);
    }


    /**
     * delete
     * This function is used to delete recruitment from recruitment id.
     * @return Json This returns as response.
     */
    public function deleteShippingTerm($id)
    {
        try {
            $shippingterm = ShippingTerm::find($id);
            $delete = $shippingterm->delete();
            if ($delete) {
                $responseBody = $this->responseBody(true, "ShippingTerm", "deleted", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "error", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }

    /**
     * delete
     * This function is used to delete recruitment from recruitment id.
     * @return Json This returns as response.
     */
    public function deleteProductMix($id)
    {
        try {
            $productmix = ProductMix::find($id);
            $delete = $productmix->delete();
            if ($delete) {
                $responseBody = $this->responseBody(true, "ProductMix", "deleted", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "error", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }


    /**
     * delete
     * This function is used to delete recruitment from recruitment id.
     * @return Json This returns as response.
     */
    public function deleteWashedLevel($id)
    {
        try {
            $washedlevel = Washedlevel::find($id);
            $delete = $washedlevel->delete();
            if ($delete) {
                $responseBody = $this->responseBody(true, "WashedLevel", "deleted", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "error", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }


    /**
     * delete
     * This function is used to delete recruitment from recruitment id.
     * @return Json This returns as response.
     */
    public function deletePlantHoleSize($id)
    {
        try {
            $plantholesize = Plantholesize::find($id);
            $delete = $plantholesize->delete();
            if ($delete) {
                $responseBody = $this->responseBody(true, "PlantHoleSize", "deleted", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "error", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }




    public function deleteDrainHoleSize($id)
    {
        try {
            $plantholesize = DrainHoleSize::find($id);
            $delete = $plantholesize->delete();
            if ($delete) {
                $responseBody = $this->responseBody(true, "DrainHoleSize", "deleted", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "DrainHoleSize", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }



    public function deleteDrainHoleShape($id)
    {
        try {
            $plantholeshape = DrainHoleShape::find($id);
            $delete = $plantholeshape->delete();
            if ($delete) {
                $responseBody = $this->responseBody(true, "DrainHoleShape", "deleted", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "DrainHoleShape", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }



    public function deleteProductSize($id)
    {
        try {
            $productsize = ProductSize::find($id);
            $delete = $productsize->delete();
            if ($delete) {
                $responseBody = $this->responseBody(true, "ProductSize", "deleted", null);
            }
        } catch (\Exception $exception) {
            $responseBody = $this->responseBody(false, "ProductSize", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }



    public static function getSettingsFromID($name, $id)
    {

        if ($name == 'ShippingTerm') {
            return Shippingterm::find($id);
        } else if ($name == 'ProductMix') {
            return Productmix::find($id);
        } else if ($name == 'WashedLevel') {
            return Washedlevel::find($id);
        } else if ($name == 'PlantHoleSize') {
            return Plantholesize::find($id);
        }
    }
}
