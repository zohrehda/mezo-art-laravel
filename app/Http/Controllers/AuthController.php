<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponseBuilderTrait;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    use ApiResponseBuilderTrait;


    private $login_type = '';
    private $user = '';

    public function __construct(Request $request)
    {
        $username = $request->username;

        if (is_numeric($username))
            $type = 'mobile';
        else if (filter_var($username, FILTER_VALIDATE_EMAIL))
            $type = 'email';
        else
            $type = 'username';

        $this->login_type = $type;

        $user = User::where('username', $username)->orWhere(function ($query) use ($username) {
            $query->where('mobile', $username)->orWhere('email', $username);
        })->first();

        $this->user = $user;
    }

    public function authenticate(Request $request)
    {
        $request->apiValidate([
            'username' => ['required', 'regex:/^(09[0-9]{9})|(\w+@\w+\.\w{2,3})$/'],
        ]);


        if (!$this->user) {

            return $this->response('کاربر یافت نشد', [
                'type' => $this->login_type,
                'new' => true
            ], 200);
        } else {
            return $this->response('success', [
                'type' => $this->login_type,
                'new' => false
            ], 200);
        }

    }




    public function sendOtp(Request $request)
    {

        $username = $request->username;
        $otp = rand(100000, 999999);


        Cache::put('otp-' . $username, '11111', 3000);

        if (app()->environment('local')) {
            return $this->response(trans('auth.otp-sent'), [
                'code' => $otp
            ]);
        }

        //   SendSms::dispatch($mobile, $otp, true)->onConnection('sync');
    }

    public function verifyOtp(Request $request)
    {
        $request->apiValidate([
            'username' => 'required|',
            'otp' => 'required',

        ]);

        $username = $request->input('username');

        $key = 'otp-' . $username;

        if (cache()->has($key) and cache()->get($key) == $request->input('otp')) {
            cache()->delete($key);
            return $this->response(trans('auth.successed'), $this->login(), 200);
        }

        return $this->response(trans('auth.failed'), [], 400);
    }

    public function verifyPassword(Request $request)
    {
        $request->apiValidate([
            'username' => 'required|',
            'password' => 'required',
        ]);

        if ($this->user && Hash::check($request->password, $this->user->password))
            return $this->response(trans('auth.successed'), $this->login(), 200);


        return $this->response(trans('auth.failed'), [], 400);
    }


    public function login()
    {
        $field = $this->login_type;
        $user = User::firstOrCreate([
            "$field" => $this->user[$field],
        ]);

        $token = $user->createToken('otp');
        return [
            'token' => $token->plainTextToken,
            'user' => $user->refresh(),
        ];
    }


    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
        return $this->response('user logout');
    }
}
