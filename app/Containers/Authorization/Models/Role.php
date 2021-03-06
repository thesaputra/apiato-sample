<?php

namespace App\Containers\Authorization\Models;

use Apiato\Core\Traits\HashIdTrait;
use Apiato\Core\Traits\HasResourceKeyTrait;
use App\Containers\Traits\Uuid;
use Spatie\Permission\Models\Role as SpatieRole;

/**
 * Class Role
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Role extends SpatieRole
{
     use Uuid;

    use HashIdTrait;
    use HasResourceKeyTrait;
    use Uuid;

    protected $guard_name = 'api';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'guard_name',
        'display_name',
        'description',
        'level'
    ];
}
