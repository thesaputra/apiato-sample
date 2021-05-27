<?php

namespace App\Containers\Traits;

use Illuminate\Support\Facades\Auth;

trait JWTUserAuth
{

  /**
   * @return mixed
   */
  public function guard()
  {
    return Auth::guard();
  }

  /**
   * @return mixed
   */
  public function current()
  {
    return $this->guard()->user();
  }

  /**
   * @return array
   */
  public function refresh()
  {
    return $this->respondWithToken($this->guard()->refresh());
  }

  /**
   * @return mixed
   */
  public function logout()
  {
    return $this->guard()->logout();
  }

  /**
   * @param $token
   * @return array
   */
  protected function respondWithToken($token)
  {
    return [
      'access_token' => $token,
      'token_type' => 'Bearer',
      'expires_in' => $this->guard()->factory()->getTTL() * 60
    ];
  }

}
