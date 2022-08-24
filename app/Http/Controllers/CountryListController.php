<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class CountryListController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('st::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('st::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('st::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('st::edit');
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }



    public function save(Request $request)
    {
        try {
            $instruction = $request->get("instruction");
	    if(!$instruction){
               $instruction = "";
            }
            $country = new Country();
            $country->country_code = $request->get("code");
            $country->country_name = $request->get("name");
            $country->import_instruction = $instruction;
            $country->status = 1;
            $country->save();
            $responseBody = $this->responseBody(true, "CountryListController", "save", true);
        } catch (Exception $exception) {
            $responseBody = $this->responseBody(false, "CountryListController", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }



    public function getCountry($id)
    {

        try {
            $country =  Country::find($id);
            $responseBody = $this->responseBody(true, "CountryListController", "getCountry", $country);
        } catch (Exception $exception) {
            $responseBody = $this->responseBody(false, "CountryListController", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }



    public function allCountries()
    {
        try {
            $countries =  Country::all();
            $responseBody = $this->responseBody(true, "CountryListController", "allCountries", $countries);
        } catch (Exception $exception) {
            $responseBody = $this->responseBody(false, "CountryListController", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }


    public function update(Request $request, $id)
    {
        try {
            $country = Country::find($id);
            $country->country_code = $request->get("code");
            $country->country_name = $request->get("name");
            $country->import_instruction = $request->get("instruction");
            //$country->status = 1;
            $country->update();
            $responseBody = $this->responseBody(true, "CountryListController", "update", true);
        } catch (Exception $exception) {
            $responseBody = $this->responseBody(false, "CountryListController", "error", $exception);
        }
        return response()->json(["data" => $responseBody]);
    }


    public function disable(Request $request, $id){
        try {
            $status = $request->get('status');
            $country = Country::find($id);
            if($status == 0)$country->status = 1;
            if($status == 1)$country->status = 0;
            $country->update();
            $responseBody = $this->responseBody(true, "CountryListController", "update", true);
        } catch (Exception $exception) {
            $responseBody = $this->responseBody(false, "CountryListController", "error", $exception);
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
