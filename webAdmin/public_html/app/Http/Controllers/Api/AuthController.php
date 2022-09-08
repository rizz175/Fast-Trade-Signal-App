<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDevice;
use App\Traits\Transformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    /**
     *  Login user and add device to current user devices
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        try {
            DB::beginTransaction();
            $credentials = [
                'email' => $request->email, 'password' => $request->password,
            ];

            if (Auth::attempt($credentials)) {

                $user = User::with('devices')->where('email', $request->email)->first();
                if ($user->device_token == null) {
                    $user->device_token = $request->device_token;
                    $user->save();
                }

                $token = $user->createToken($user->id)->accessToken;
                // $device_key = 'web';
                $device_key = $request->device_key;
                $device_type = $request->header('User-Agent');
                if (($user->devices()->count() >= 1) && ($user->devices[0]->device_key != $device_key)) {
                    $user->update([
                        'password' => bcrypt(''),
                        'device_token' => null,
                    ]);
                    UserDevice::where('user_id', $user->id)->delete();
                    DB::commit();
                    $response = $this->apiResponse(JsonResponse::HTTP_UNAUTHORIZED, 'message', 'User logout ,account is revoke contact to admin for new password to login');
                    return $response;
                }

                $device = $user->devices()->Create([
                    'device_key' => $device_key,
                    'device_type' => $request->header('User-Agent'),
                    'access_token' => $token,
                ]);
                $user_data = clone $user;
                $transformed_user = Transformer::transformUser($user_data, $device->access_token, true);
                $response = $this->apiResponse(JsonResponse::HTTP_OK, 'data', $transformed_user);

                DB::commit();
                return $response;
            } else {
                $response = $this->apiResponse(JsonResponse::HTTP_UNAUTHORIZED, 'message', 'Username or password is incorrect');
                return $response;
            }

        } catch (\Exception$e) {
            DB::rollBack();
            return $this->apiResponse(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, 'message', $e->getMessage());
        }
    }
    
    public function checkUser()
    {
        $user = auth('api')->user();
        $user['token'] = UserDevice::where('user_id', $user->id)->first('access_token');
        $response = $this->apiResponse(JsonResponse::HTTP_OK, 'data', $user);
        return $response;
    }
    
    public function setting()
    {
        try {
            DB::beginTransaction();
            $setting = Setting::first();
            $setting['cover_image'] = URL::to('/uploads/' . $setting->cover_image);
            DB::commit();
            return $this->apiResponse(JsonResponse::HTTP_OK, 'message', $setting);
        } catch (\Exception$e) {
            DB::rollBack();
            return $this->apiResponse(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, 'message', $e->getMessage());
        }
    }
    
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        $request->user()->devices()->delete();
        $request->user()->update([
            'device_token' => null,
        ]);
        $response = $this->apiResponse(JsonResponse::HTTP_OK, 'message', 'Successfully logged out.');
        return $response;
    }
    
}
