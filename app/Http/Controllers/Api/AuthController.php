<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// Requests
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
// Resources
use App\Http\Resources\Api\ClientResources;
// Models
use App\Models\User;
use App\Support\API;
use Hash;

class AuthController extends Controller {

    public function login(LoginRequest $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();

            return (new API)
                ->isOk(__('You are logged in successfully'))
                ->setData(new ClientResources($user))
                ->addAttribute("auth_data", ['access_token'  => $user->createToken("API TOKEN")->plainTextToken])
                ->build();
        }else{
            return (new API)
                ->isError(__('The login information is incorrect'))
                ->build();
        }
    }

    public function register(RegisterRequest $request){
        $info = [
            'name'              =>  $request->name,
            'email'             =>  $request->email,
            'password'          =>  Hash::make($request->password),
        ];
        $user = User::create($info);
        return (new API)
            ->isOk(__('Your data has been received'))
            ->setData(new ClientResources($user))
            ->build();
    }

    public function logout()
    {
        Auth::logout();
        return (new API)
            ->isOk(__('LogOut has been successfully'))
            ->build();
    }
}
