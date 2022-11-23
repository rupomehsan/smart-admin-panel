<?php

namespace App\Http\Controllers;

use App\Models\SmartFormValidation as ModelsSmartFormValidation;
use Illuminate\Http\Request;
use Validator;

class SmartFormValidation extends Controller
{

    public function index()
    {
        $target = ModelsSmartFormValidation::paginate(20);
        return response([
            "status" => "success",
            "data" => $target
        ]);
    }


    public function store(Request $request)
    {

        try {
            // dd($request->all());

            $validator = Validator::make($request->all(), [
                "first_name" => "required",
                "last_name" => "required",
                "phone" => "required",
                "email" => "required",
                "address" => "required",
                "password" => "required",
                "confirm_password" => "required",
                "date_time" => "required",
                "date" => "required",
                "start_time" => "required",
                "color" => "required",
                "multi_chips_select" => "required",
                "category_id" => "required",
                "chips" => "required",
                "multi_category_selector" => "required",
                "days" => "required",
                "image" => "required",
                "description" => "required",
                "description2" => "required",
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors()->messages();
                return validateError($errors);
            }

            // custom field vlaidation
            // custom field vlaidation

            // if ($request->single_item) {
            //     foreach ($request->single_item as $item) {
            //         if ($item === null) {
            //             $errors = [
            //                 "single_item" => ["The single item field is required."]
            //             ];
            //             return validateError($errors);
            //         }
            //     }
            // }

            // custom toaster vlaidation
            // custom toaster vlaidation

            // if ($request->multi_item) {
            //     foreach ($request->multi_item as $index => $item) {
            //         // dd($item['one']);
            //         if ($item['one'] === null || $item['two'] === null || $item['three'] === null) {
            //             return response([
            //                 "status" => "error",
            //                 "message" =>  "Multiitem field   must not be empty"
            //             ]);
            //         }
            //     }
            // }
            $description = str_replace(['<p>', '</p>'], '', $request->description);
            $description2 = str_replace(['<p>', '</p>'], '', $request->description2);

            $target = new ModelsSmartFormValidation();
            $target->first_name = $request->first_name;
            $target->last_name = $request->last_name;
            $target->phone = $request->phone;
            $target->email = $request->email;
            $target->address = $request->address;
            $target->password = $request->password;
            $target->date_time = $request->date_time;
            $target->date = $request->date;
            $target->start_time = $request->start_time;
            $target->color = $request->color;
            $target->switch = $request->switch ?? "off";
            $target->multi_category_selector = $request->multi_category_selector;
            $target->category_id = $request->category_id;
            $target->chips = $request->chips;
            $target->multi_chips_select = $request->multi_chips_select;
            $target->days = $request->days;
            $target->image = $request->image;
            $target->image_sec = $request->image_sec;
            $target->single_item = $request->single_item;
            $target->multi_item = $request->multi_item;
            $target->description = $description;
            $target->description2 = $description2;
            if ($target->save()) {
                return response([
                    "status" => "success",
                    "message" => "target Successfully Create"
                ]);
            }
        } catch (\Exception $e) {
            return response([
                "status" => "server_error",
                "message" => $e->getMessage()
            ]);
        }
    }


    function show($id)
    {
        try {

            $getData = ModelsSmartFormValidation::where("id", $id)->first();
            return response([
                "status" => "success",
                "data" => $getData
            ]);
        } catch (\Exception $e) {
            return response([
                'status'  => 'server_error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {

        try {
            // dd($request->all());

            $validator = Validator::make($request->all(), [
                "first_name" => "required",
                "last_name" => "required",
                "phone" => "required",
                "email" => "required",
                "address" => "required",
                "password" => "required",
                "date_time" => "required",
                "date" => "required",
                "start_time" => "required",
                "color" => "required",
                "multi_chips_select" => "required",
                "category_id" => "required",
                "chips" => "required",
                "multi_category_selector" => "required",
                "days" => "required",
                "description" => "required",
                "description2" => "required",
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors()->messages();
                return validateError($errors);
            }

            // custom field vlaidation
            // custom field vlaidation

            if ($request->single_item) {
                foreach ($request->single_item as $item) {
                    if ($item === null) {
                        $errors = [
                            "single_item" => ["The single item field is required."]
                        ];
                        return validateError($errors);
                    }
                }
            }

            // custom toaster vlaidation
            // custom toaster vlaidation

            if ($request->multi_item) {
                foreach ($request->multi_item as $index => $item) {
                    // dd($item['one']);
                    if ($item['one'] === null || $item['two'] === null || $item['three'] === null) {
                        return response([
                            "status" => "error",
                            "message" =>  "Multiitem field   must not be empty"
                        ]);
                    }
                }
            }
            $description = str_replace(['<p>', '</p>'], '', $request->description);
            $description2 = str_replace(['<p>', '</p>'], '', $request->description2);

            $target = ModelsSmartFormValidation::where("id", $id)->first();
            $target->first_name = $request->first_name ??  $target->first_name;
            $target->last_name = $request->last_name ?? $target->last_name;
            $target->phone = $request->phone ?? $target->phone;
            $target->email = $request->email ??  $target->email;
            $target->address = $request->address ?? $target->address;
            $target->password = $request->password ?? $target->password;
            $target->date_time = $request->date_time ?? $target->date_time;
            $target->date = $request->date ?? $target->date;
            $target->start_time = $request->start_time ?? $target->start_time;
            $target->color = $request->color ?? $target->color;
            $target->switch = $request->switch ?? "off";
            $target->multi_category_selector = $request->multi_category_selector ?? $target->multi_category_selector;
            $target->category_id = $request->category_id ?? $target->category_id;
            $target->chips = $request->chips ?? $target->chips;
            $target->multi_chips_select = $request->multi_chips_select ?? $target->multi_chips_select;
            $target->days = $request->days ??  $target->days;
            $target->image = $request->image ??  $target->image;
            $target->image_sec = $request->image_sec ??  $target->image_sec;
            $target->single_item = $request->single_item ?? $target->single_item;
            $target->multi_item = $request->multi_item ?? $target->multi_item;
            $target->description = $description ?? $target->description;
            $target->description2 = $description2 ?? $target->description2;
            if ($target->update()) {
                return response([
                    "status" => "success",
                    "message" => "Target Successfully Update"
                ]);
            }
        } catch (\Exception $e) {
            return response([
                "status" => "server_error",
                "message" => $e->getMessage()
            ]);
        }
    }


    public function destroy($id)
    {
        $target = ModelsSmartFormValidation::find($id);
        if ($target->delete()) {
            return response([
                "status" => "success",
                "message" => "Target Successfully Delete"
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