<?php

namespace App\Modules\Apps;
use App\Models\Apps;
use App\Models\AppUserRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class AppsRepository {
    public function all($uid) {
        return DB::select("SELECT apps.id, apps.appid, users.fullname as created_by, apps.fullname, apps.enabled, apps_user_role.role FROM apps
        INNER JOIN apps_user_role ON apps.appid = apps_user_role.appid
        INNER JOIN users ON apps.created_by = users.uid
        WHERE users.uid = ?", [$uid]);
    }

    public function get($id) {
        return DB::select("SELECT apps.id, apps.appid, apps.fullname, apps.enabled, apps_user_role.role, apps.version FROM apps
        INNER JOIN apps_user_role ON apps.appid = apps_user_role.appid
        WHERE apps.appid = ?", [$id])[0];
    }
    
    private function getBy($f, $v) {
        return Apps::where($f, $v);
    }

    public function create($data) {
        $row = Apps::create([
            "created_by" => $data["created_by"],
            "fullname" => $data["fullname"]
        ]);
        AppUserRole::create([
            "uid" => $data["created_by"],
            "appid" => $row->appid
        ]);
        return DB::select("SELECT DISTINCT apps.id, apps.appid, users.fullname as created_by, apps.fullname, apps.enabled, apps_user_role.role FROM apps
        INNER JOIN apps_user_role ON apps.appid = apps_user_role.appid
        INNER JOIN users ON apps.created_by = users.uid
        WHERE users.uid = ? AND apps.appid = ?", [$data["created_by"], $row["appid"]])[0];
    }

    public function update($data) {
        $row = Apps::where("appid", $data["appid"]);
        $row->fullname = $data["fullname"];
        $row->enabled = $data["enabled"];
        $row->disabled_reason = $data["disabled_reason"];
        $row->cooldown_when_disabled = $data["cooldown_when_disabled"];
        $row->version = $data["version"];
        $row->download_link = $data["download_link"];
        $row->save();
    }

    public function delete($data) {
        Apps::where("appid", $data)->delete();
        AppUserRole::where("appid", $data)->delete();
    }

    public function assignSeller($appid, $new_uid) {
        return AppUserRole::create([
            "uid" => $new_uid,
            "appid" => $appid,
            "role" => "reseller"
        ]);
    }
}