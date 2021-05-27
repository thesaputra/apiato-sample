<?php
/**
 * @apiGroup           OAuth2
 * @apiName            Login
 * @api                {DELETE} /v1/logout
 * @apiDescription     User Logout. (Revoking Access Token)
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 202 Accepted
{
  "message": "Token revoked successfully."
}
 */
$router->post('login', [
    'as' => 'api_authentication_login',
    'uses'  => 'Controller@login'
]);

