<?php

namespace App\Modules\Licenses;
use App\Utils\Result;
use Illuminate\Http\Response;
class LicensesService {
    private LicensesRepository $licenses;
    public function __construct(LicensesRepository $a) {
        $this->licenses = $a;
    }


    public function all($uid, $appid) : Result{
        return new Result([
            "success" => true, 
            "message" => $this->licenses->all($uid, $appid)
        ], Response::HTTP_OK);
    }

    public function get($id) : Result {
        return new Result([
            "success" => true, 
            "message" => $this->licenses->get($id)
        ], Response::HTTP_OK);
    }

    public function create($uid, $appid, $data) : Result {
        return new Result([
            "success" => true, 
            "message" => $this->licenses->create($uid, $appid, $data)
        ], Response::HTTP_OK);
    }
}