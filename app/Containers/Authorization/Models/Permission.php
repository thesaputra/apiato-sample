<?php

namespace App\Containers\Authorization\Models;

use Apiato\Core\Traits\HashIdTrait;
use Apiato\Core\Traits\HasResourceKeyTrait;
use App\Containers\Traits\Uuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission as SpatiePermission;

/**
 * Class Permission
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Permission extends SpatiePermission
{

    use HashIdTrait;
    use HasResourceKeyTrait;
    use Uuid;

    protected $guard_name = 'api';

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'guard_name',
        'display_name',
        'description',
    ];

    public function userPermission($module)
    {
      $autoAccessRoles = Config::get('apiato.requests.allow-roles-to-access-all-routes');

      if (!empty($module)) {

        return array(
          'isView' => !empty($autoAccessRoles) ? true : $this->isView($module),
          'isList' => !empty($autoAccessRoles) ? true : $this->isList($module),
          'isCreate' => !empty($autoAccessRoles) ? true : $this->isCreate($module),
          'isUpdate' => !empty($autoAccessRoles) ? true : $this->isUpdate($module),
          'isDelete' => !empty($autoAccessRoles) ? true : $this->isDelete($module)
        );

      }

      return array(
        'isView' => false,
        'isList' => false,
        'isUpdate' => false,
        'isDelete' => false,
        'isCreate' => false
      );

    }

    public function isView($module)
    {
      return $this->check('view-' . $module);
    }

    public function isList($module)
    {
      return $this->check('list-' . $module);
    }

    public function isCreate($module)
    {
      return $this->check('create-' . $module);
    }

    public function isUpdate($module)
    {
      return $this->check('update-' . $module);
    }

    public function isDelete($module)
    {
      return $this->check('delete-' . $module);
    }

    public function check($permission)
    {
      $user = Auth::guard()->user();
      // dd($user);
      $data = DB::table('model_has_roles')
        ->leftJoin('role_has_permissions', 'model_has_roles.role_id', '=', 'role_has_permissions.role_id')
        ->leftJoin('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
        ->where('model_id', $user->id)
        ->where('permissions.name', '=', $permission)
        ->count();

      return $data > 0 ? true : false;
    }
}
