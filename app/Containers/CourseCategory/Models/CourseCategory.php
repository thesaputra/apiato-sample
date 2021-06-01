<?php

namespace App\Containers\CourseCategory\Models;

use App\Ship\Parents\Models\Model;
use App\Containers\Traits\Uuid;

class CourseCategory extends Model
{
    use Uuid;

    protected $fillable = [
        'name'
    ];

    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [
        // 'id' => 'Uuid',
        // 'real_id' => 'string'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'course_categories';
}
