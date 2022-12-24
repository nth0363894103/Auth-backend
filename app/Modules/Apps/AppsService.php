<?php

namespace App\Modules\Apps;
use App\Utils\Result;
use Illuminate\Http\Response;
class AppsService {
    private AppsRepository $apps;
    public function __construct(AppsRepository $a) {
        $this->apps = $a;
    }


    public function all($uid) : Result{
        return new Result([
            "success" => true, 
            "message" => $this->apps->all($uid)
        ], Response::HTTP_OK);
    }

    public function get($id) : Result {
        return new Result([
            "success" => true, 
            "message" => $this->apps->get($id)
        ], Response::HTTP_OK);
    }

    public function create($data) : Result {
        return new Result([
            "success" => true, 
            "message" => $this->apps->create($data)
        ], Response::HTTP_OK);
    }
}