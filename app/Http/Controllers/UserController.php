<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $status_code = 200;

    public function userSignUp(Request $request) {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email",
            "password" => "required",
            "rol" => "required"
        ]);

        $rol = $request->rol;

        if ($rol != "alumno") {
            if ($rol != "profesor") {
                return response()->json(["status" => "failed", "success" => false, "message" => "Rol no válido. Roles válidos: alumno, profesor"]);
            }
        }

        if($validator->fails()) {
            return response()->json(["status" => "failed", "message" => "validation_error", "errors" => $validator->errors()]);
        }

        $userDataArray = array(
            "name" => $request->name,
            "email" => $request->email,
            "password" => md5($request->password),
            "rol" => $request->rol
        );

        $user_status = User::where("email", $request->email)->first();

        if(!is_null($user_status)) {
           return response()->json(["status" => "failed", "success" => false, "message" => "Ooops! Email ya registrado anteriormente"]);
        }

        $user = User::create($userDataArray);

        if(!is_null($user)) {
            return response()->json(["status" => $this->status_code, "success" => true, "message" => "Registro completado correctamente", "data" => $user]);
        }

        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Fallo al registrar"]);
        }
    }


    // ------------ [ User Login ] -------------------
    public function userLogin(Request $request) {

        $validator = Validator::make($request->all(),
            [
                "email" => "required|email",
                "password" => "required"
            ]
        );

        if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_error" => $validator->errors()]);
        }

        // check if entered email exists in db
        $email_status = User::where("email", $request->email)->first();

        // if email exists then we will check password for the same email

        if(!is_null($email_status)) {
            $password_status = User::where("email", $request->email)->where("password", md5($request->password))->first();

            // if password is correct
            if(!is_null($password_status)) {
                $user = $this->userDetail($request->email, true);

                return response()->json(["status" => $this->status_code, "success" => true, "message" => "Te has logeado correctamente", "data" => $user]);
            }

            else {
                return response()->json(["status" => "failed", "success" => false, "message" => "Fallo al logearse. Contraseña incorrecta"]);
            }
        }

        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Fallo al logearse. Email inexistente."]);
        }
    }

    // ------------------ [ User Detail ] ---------------------
    public function userDetail($email, $local = false) {
        if (!$local) {
            if (!Gate::allows('userDetail-UserController', $email)) {
                abort(403);
            }
        }

        $user = array();
        if($email != "") {
            $user = User::where("email", $email)->first();
            return $user;
        }
    }
}
