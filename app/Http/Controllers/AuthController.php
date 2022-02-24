<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //

    public function create_token($type, $id)
    {
        $data = null;
        switch ($type) {
            case 'access':
                $data = [
                    'id' => $id,
                    'iat' => time(),
                    "exp" => time() + 60 * 3
                ];
                break;
            case 'refresh':
                $data = [
                    'id' => $id,
                ];
                break;
            default:
                # code...
                break;
        }
        return JWT::encode($data, env('JWT_SECRET'), 'HS256');
    }
    public function login(Request $req)
    {
        $user = user::where("email", $req->email)->first(["password", "id"]);
        if ($user && Hash::check($req->password, $user->password)) {
            return $this->try(["access" => $this->create_token("access", $user->id), "refresh" => $this->create_token("refresh", $user->id)]);
        }
        return $this->catch("Giriş bilgilerinizi kontrol ederek, tekrar deneyiniz !");
    }
}
