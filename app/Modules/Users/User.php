<?php

namespace App\Modules\Users;

class User {
    private ?int $id;
    private ?string $uid;
    private string $username;
    private string $email;
    private string $fullname;
    private ?string $role;
    private $hidden = [];
    public function __construct(
        ?int $id,
        ?string $uid,
        string $username,
        string $email,
        string $fullname,
        ?string $role
    ) {
        $this->id = $id;
        $this->uid = $uid;
        $this->username = $username;
        $this->email = $email;
        $this->fullname = $fullname;
        $this->role = $role;
    }
    public function toArray() {
        $data = [
            'id' => $this->id,
            'uid' => $this->uid,
            'username' => $this->username,
            'email' => $this->email,
            'fullname' => $this->fullname,
            'role' => $this->role
        ];
        foreach($this->hidden as $value) {
            unset($data[$value]);
        }
        return $data;
    }
    public function hidden($arr) {
        $this->hidden = $arr;
    }
    public function toObject() {
        return (object)$this->toArray();
    }
    public function getId():?int {
        return $this->id;
    }
    public function getUid():?string {
        return $this->uid;
    }
    public function getUsername():string {
        return $this->username;
    }
    public function getEmail():string {
        return $this->email;
    }
    public function getFullname():string {
        return $this->fullname;
    }
    public function getRole():?string {
        return $this->role;
    }
}