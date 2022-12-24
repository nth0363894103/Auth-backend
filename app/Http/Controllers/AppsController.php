<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Apps\AppsService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
class AppsController extends Controller
{
    //
    private AppsService $apps;
    //
    public function __construct(AppsService $app)
    {
        $this->apps = $app;
    }

    public function all(Request $request) {
        return $this->apps->all($request->uid)->toResponse();
    }
    public function get(Request $request) {
        $validator = Validator::make($request->all(), [
            'appid' => "bail|required|min:40|max:40"
        ]);
        if ($validator->fails()) {
            return new Response([
                "success" => false,
                "message" => $validator->errors()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
        return $this->apps->get($validator->validated()["appid"])->toResponse();
    }
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'fullname' => "bail|required|min:3|max:255"
        ]);
        if ($validator->fails()) {
            return new Response([
                "success" => false,
                "message" => $validator->errors()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
        $create = $validator->validated();
        $create["created_by"] = $request->uid;
        return $this->apps->create($create)->toResponse();
    }
}
