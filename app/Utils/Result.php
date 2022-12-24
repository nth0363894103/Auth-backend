<?php
namespace App\Utils;
use Illuminate\Http\Response;

class Result {
    private $json = [];
    private $code = 200;
    public function __construct($a, $b) {
        $this->json = $a;
        $this->code = $b;
    }
    public function toResponse() {
        return response()->json($this->json, $this->code);
    }
}