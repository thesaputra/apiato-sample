<?php

namespace App\Containers\Authorization\Models;

use App\Ship\Parents\Models\Model;

class ModelHasRole extends Model
{

    protected $guard_name = 'api';
    // protected $resourceKey = 'model_has_roles';
    protected $primaryKey = 'role_id';

    public $incrementing = false;

    protected $fillable = [
        'role_id',
        'model_type',
        'model_id'
    ];
}

