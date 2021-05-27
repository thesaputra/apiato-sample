<?php

namespace App\Containers\User\Models;

use App\Containers\Account\Models\Account;
use App\Containers\Account\Models\UserAccount;
use App\Containers\Authorization\Models\Role;
use App\Containers\User\Models\UserType;
use App\Containers\Authorization\Traits\AuthorizationTrait;
use App\Containers\Payment\Contracts\ChargeableInterface;
use App\Containers\Payment\Models\PaymentAccount;
use App\Containers\Payment\Traits\ChargeableTrait;
use App\Containers\Traits\Uuid;
use App\Ship\Parents\Models\UserModel;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class User.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class User extends UserModel implements ChargeableInterface, JWTSubject
{

    use ChargeableTrait;
    use AuthorizationTrait;
    use Notifiable;
    use Uuid;

    protected $guard_name = 'api';

    const MODULE = 'admins';

    public $incrementing = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'password',
        'temporary_password',
        'device',
        'platform',
        'gender',
        'birth',
        'address',
        'postal_code',
        'social_provider',
        'social_token',
        'social_refresh_token',
        'social_expires_in',
        'social_token_secret',
        'social_id',
        'social_avatar',
        'social_avatar_original',
        'social_nickname',
        'confirmed',
        'is_client',
        'user_type_id',
        'last_login',
        'deleted_at',
        'is_terms_condition',
        'status',
        'string_activation',
        'reverse_status',
    ];

    protected $casts = [
        'is_client' => 'boolean',
        'confirmed' => 'boolean',
    ];

    /**
     * The dates attributes.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
    public function paymentAccounts()
    {
        return $this->hasMany(PaymentAccount::class);
    }

    public function roleData()
    {
      return $this->hasOne(Role::class, 'id', 'role')->select('*');
    }

    public function accounts()
    {
      return $this->belongsToMany(Account::class, 'user_account', 'user_id', 'account_id');
    }

    public function userType()
    {
      return $this->belongsTo(UserType::class, 'user_type_id', 'id');
    }

    /**
     * @return mixed
     */
    public function getJWTIdentifier()
    {
      return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
      return array();
    }

    public function getDataRoleIds()
    {
        return $this->roles->pluck('id');
    }

    public function cardType()
    {
      return $this->belongsTo(CardType::class, 'card_type_id', 'id');
    }

    public function cardCode()
    {
      return $this->belongsTo(CardCode::class, 'card_code_id', 'id');
    }

}
