<?php

/**
 * @apiGroup           CourseCategory
 * @apiName            createCourseCategory
 *
 * @api                {POST} /v1/course_categories Endpoint title here..
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

/** @var Route $router */
$router->post('course_categories', [
    'as' => 'api_coursecategory_create_course_category',
    'uses'  => 'Controller@createCourseCategory',
    'middleware' => [
      'auth:api',
    ],
]);
