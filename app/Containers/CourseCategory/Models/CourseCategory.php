<?php

namespace App\Containers\CourseCategory\Models;

use App\Ship\Parents\Models\Model;

class CourseCategory extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [

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
