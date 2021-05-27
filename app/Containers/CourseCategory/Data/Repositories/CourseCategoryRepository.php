<?php

namespace App\Containers\CourseCategory\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class CourseCategoryRepository
 */
class CourseCategoryRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
