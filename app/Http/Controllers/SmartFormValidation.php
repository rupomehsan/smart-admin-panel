<?php

namespace App\Http\Controllers;

use App\Models\SmartFormValidation as ModelsSmartFormValidation;
use Illuminate\Http\Request;
use Validator;

class SmartFormValidation extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        try {

            $validator = Validator::make($request->all(), [
                "first_name" => "required",
                "last_name" => "required",
                "phone" => "required",
                "email" => "required",
                "address" => "required",
                "password" => "required",
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors()->messages();
                return validateError($errors);
            }
            //        dd($request->all());
            $attribute = new ModelsSmartFormValidation();
            $attribute->name = $request->name;
            $attribute->value = $request->attribute;
            if ($attribute->save()) {
                return response([
                    "status" => "success",
                    "message" => "Attribute Successfully Create"
                ]);
            }
        } catch (Exception $e) {
            return response([
                "status" => "server_error",
                "message" => $e->getMessage()
            ]);
        }
    }
}
