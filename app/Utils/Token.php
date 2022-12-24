<?php
namespace App\Utils;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Response;
class Token {
    private $key = NULL;
    private $exp = 30 * 60 * 60;
    private $payload = NULL;
    private $jwt = NULL;
    public function __construct() {
        $this->key = env('JWT_SECRET') ?? "hahahahahahahahahahahahahahahaha";
        $this->exp = env('JWT_EXPIRATION')?? 30 * 60 * 60;
        $tim = time();
        $this->payload = [
            'iat' => $tim,
            'exp' => $tim + $this->exp
        ];
    }
    public function set($token) {
        $this->jwt = $token;
        return $this;
    }
    public function __call($name, $args) {
        $this->payload[$name] = $args[0];
        return $this;
    }
    public function create() {
        $jwt = JWT::encode($this->payload, $this->key, 'HS256');
        return $jwt;
    }
    private function parse($jwt = null) {
        $jwt = $this->jwt ?? $jwt;
        return JWT::decode($jwt, new Key($this->key, 'HS256'));
    }
    public function toArray($jwt = null) {
        $jwt = $this->jwt ?? $jwt;
        $decoded = $this->parse($jwt);
        return $decoded;
    }
    public function auth($jwt = null) {
        $jwt = $this->jwt ?? $jwt;
        $obj = $this->toObject($jwt);

    }
    public function toObject($jwt = null) {
        $jwt = $this->jwt ?? $jwt;
        $decoded = $this->parse($jwt);
        return (object)$decoded;
    }
}