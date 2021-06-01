<?php

namespace App\Containers\CourseCategory\UI\API\Transformers;

use App\Containers\CourseCategory\Models\CourseCategory;
use App\Ship\Parents\Transformers\Transformer;

class CourseCategoryTransformer extends Transformer
{
    /**
     * @var  array
     */
    protected $defaultIncludes = [

    ];

    /**
     * @var  array
     */
    protected $availableIncludes = [

    ];

    /**
     * @param CourseCategory $entity
     *
     * @return array
     */
    public function transform(CourseCategory $entity)
    {
        $response = [
            'object' => 'CourseCategory',
            'id' => $entity->getHashedKey(),
            'name' => $entity->name,
            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at,

        ];

        $response = $this->ifAdmin([
            'real_id'    => $entity->id,
            // 'deleted_at' => $entity->deleted_at,
        ], $response);

        return $response;
    }
}
