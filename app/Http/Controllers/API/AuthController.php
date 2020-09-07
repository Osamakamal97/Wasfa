<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Traits\APITrait;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    use APITrait;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','registration']]);
    }

    public function login(Request $request)
    {
        try {
            // ! Validation
            $validator = Validator::make(
                $request->all(),
                [
                    'email' => ['required', 'email', 'exists:users,email'],
                    'password' => ['required']
                ]
            );
            if ($validator->fails()) {
                return $this->returnValidationError('E001', $validator);
            }
            // ! get user data
            $credentials = $request->only(['email', 'password']);
            $guard = Auth::guard('api');
            // ? check login data and get token
            $token = $guard->attempt($credentials);
            if (!$token)
                return $this->returnError('E001', 'بيانات الدخول غير صحيحة');
            // * return
            $user = $guard->user();
            $user->api_token = $token;
            return $this->returnData('user', $user, 'This is user.');
        } catch (Exception $e) {
            return $this->returnError('S000', 'Error happen when login, please try again.');
        }
    }

    public function registration(Request $request)
    {
        try {
            // ! Validation
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => ['required'],
                    'email' => ['required', 'email', 'unique:users,email'],
                    'password' => ['required', 'confirmed'],
                    'password_confirmation' => ['required'],
                ]
            );
            // Check if there is any validation errors ro return it
            if ($validator->fails()) {
                return $this->returnValidationError('E001', $validator);
            }
            // ? Register user
            $user = $request->only('name', 'email', 'password');
            User::create($user);
            // * return success
            return $this->returnSuccess('User created successfully', 'S005');
        } catch (Exception $e) {
            return $this->returnError('S001', 'Problem');
        }
    }
}
