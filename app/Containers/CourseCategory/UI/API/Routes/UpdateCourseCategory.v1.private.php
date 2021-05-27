<?php

/**
 * @apiGroup           CourseCategory
 * @apiName            updateCourseCategory
 *
 * @api                {PATCH} /v1/course_categories/:id Endpoint title here..
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
$router->patch('course_categories/{id}', [
    'as' => 'api_coursecategory_update_course_category',
    'uses'  => 'Controller@updateCourseCategory',
    'middleware' => [
      'auth:api',
    ],
]);
