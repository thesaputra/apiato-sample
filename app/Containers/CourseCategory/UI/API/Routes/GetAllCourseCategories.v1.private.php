<?php

/**
 * @apiGroup           CourseCategory
 * @apiName            getAllCourseCategories
 *
 * @api                {GET} /v1/course_categories Endpoint title here..
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
$router->get('course_categories', [
    'as' => 'api_coursecategory_get_all_course_categories',
    'uses'  => 'Controller@getAllCourseCategories',
    'middleware' => [
      // 'auth:api',
    ],
]);
