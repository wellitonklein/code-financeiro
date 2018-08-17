<?php

namespace CodeFin\Http\Controllers\Api;

use CodeFin\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class AuthController extends Controller
{

    use AuthenticatesUsers;

    public function accessToken(Request $request){
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)){
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->credentials($request);

        if ($token = Auth::guard('api')->attempt($credentials)){
            return $this->sendLoginResponse($request,$token);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendLoginResponse(Request $request, $token)
    {
        $this->clearLoginAttempts($request);

        return response()->json([
            'token' => $token
        ]);
    }

    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        $message = Lang::get('auth.throttle',['seconds' => $seconds]);

        return response()->json([
            'message' => $message
        ],403);
    }

    public function refreshToken(Request $request)
    {
        $token = Auth::guard('api')->refresh();
        return $this->sendLoginResponse($request,$token);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return response()->json([
            'message' => Lang::get('auth.failed')
        ],401);
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard('api')->logout();

        return Response()->json([],204);
    }

}
