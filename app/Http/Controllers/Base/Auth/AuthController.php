<?php

namespace App\Http\Controllers\Base\Auth;

use Illuminate\Http\Request;
use App\Services\Base\Auth\AuthService;
use App\Http\Requests\Base\Auth\LoginRequest;
use App\Http\Requests\Base\Auth\RegisterRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Exception;
use App\Http\Requests\Base\Auth\ResetRequest;

class AuthController extends Controller
{
    protected $auth;
    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }

    public function login(LoginRequest $request)
    {
        try {
            $data = $this->auth->login($request->only('email', 'password'));
            return $this->authenticateSuccess($data['data'], $data['token'], $data['expiration']);
        } catch (Exception $e) {
            return $this->exceptions($e);
        }
    }

    public function register(RegisterRequest $request)
    {
        DB::beginTransaction();

        try {
            $req_user = $request->only("email","password","last_name","first_name");

            $data = $this->auth->register($req_user);

            DB::commit();
            return $this->sendSuccessData($data,trans('response.success.register.name',['name' => $data['email']]));

        } catch (Exception $e) {
            DB::rollback();
            return $this->exceptions($e);
        }
    }

    public function logout()
    {
        try {
            $user = auth()->user();
            $return = $this->auth->logout($user);
            return $this->sendSuccessData($return,trans('response.success.auth.logout'));
        } catch (Exception $e) {
            return $this->sendErrorData("Logout false", 403);
        }
    }

    public function verifyEmail($userId, $verifyCode)
    {
        try {
            $data = $this->auth->verifyEmail($userId, $verifyCode);
            return $this->sendSuccessData($data, trans('response.success.verify.name',['name' => 'Email']));
        } catch (Exception $e) {
            return $this->exceptions($e);
        }
    }
    public function resetPassword(ResetRequest $request)
    {
        try {
            $data = $this->auth->resetPassword($request->only('email'));
            return $this->sendSuccessData($data, trans('response.success.auth.reset_password'));
        } catch (Exception $e) {
            return $this->exceptions($e);
        }
    }
}
