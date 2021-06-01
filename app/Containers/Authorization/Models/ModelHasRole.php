<?php

namespace App\Containers\Authorization\Models;

use App\Ship\Parents\Models\Model;
use App\Containers\Traits\Uuid;

class ModelHasRole extends Model
{
    use Uuid;
    
    protected $table = 'model_has_roles';

    protected $guard_name = 'api';
    // protected $resourceKey = 'model_has_roles';
    protected $primaryKey = 'role_id';

    public $incrementing = false;

    protected $fillable = [
        'role_id',
        'model_type',
        'model_id'
    ];

    protected $casts = [
        'role_id' => 'uuid',
        'model_id' => 'uuid',
        'mode_type' => 'string'

    ];

}

