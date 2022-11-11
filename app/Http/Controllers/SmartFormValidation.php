<?php

namespace App\Http\Controllers;

use App\Models\SmartFormValidation as ModelsSmartFormValidation;
use Illuminate\Http\Request;
use Validator;

class SmartFormValidation extends Controller
{
    public function store(Request $request)
    {
        dd($request->all());
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
            return response([
                "status" => "error",
                "message" => "Something is rong"
            ]);
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


    public function fileUploader(Request $request)
    {
        // dd($request->all());

        try {

            $validate = Validator::make(request()->only('file'), [
                'file' => 'required|max:10240',
            ]);
            if ($validate->fails()) {
                return response([
                    'status' => 'validation_error',
                    'data'   => $validate->errors(),
                ], 422);
            }

            if (request()->has('file')) {
                $folder    = $request->folder ?? 'all';
                $image     = $request->file('file');
                $imageName = $folder . "/" . time() . '.' . $image->getClientOriginalName();
                if (config('app.env') === 'production') {
                    $image->move('uploads/' . $folder, $imageName);
                } else {
                    $image->move(public_path('/uploads/' . $folder), $imageName);
                }
                $protocol = request()->secure() ? 'https://' : 'http://';

                return response([
                    'status'  => 'success',
                    'message' => 'File uploaded successfully',
                    'data'    => '/uploads/' . $imageName,
                ], 200);
            }
        } catch (\Exception $e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}