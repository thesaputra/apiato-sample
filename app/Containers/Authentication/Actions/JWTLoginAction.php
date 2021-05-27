<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\Authentication\Exceptions\LoginFailedException;
use App\Containers\Traits\JWTUserAuth;
use App\Ship\Parents\Actions\Action;
use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;

class JWTLoginAction extends Action
{

  use JWTUserAuth;

  public function run(DataTransporter $data)
  {
    Config::set('auth.defaults.guard', 'api');

    $credentials = array(
      'email' => $data->email,
      'password' => $data->password
    );

    try {
      $token = $this->guard()->attempt($credentials);
      
      if ($token)
      {
          $user = $this->current();
          $user->last_login  = date("Y-m-d H:i:s");
          $user->save();

          return $this->respondWithToken($token);
      }
      else 
      {
        throw new LoginFailedException(trans('localization::auth.failed'));
      }
    } catch (JWTException $exception) {
      throw new LoginFailedException(trans('localization::auth.failed'));
    }

  }

}
