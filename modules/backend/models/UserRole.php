<?php namespace Backend\Models;

use Backend\Classes\AuthManager;
use October\Rain\Auth\Models\Role as RoleBase;

/**
 * Administrator role
 *
 * @package october\backend
 * @author Alexey Bobkov, Samuel Georges
 * @property int $id
 * @property string $name
 * @property string|null $code
 * @property string|null $description
 * @property string|null $permissions
 * @property int $is_system
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \October\Rain\Database\Collection|static[] all($columns = ['*'])
 * @method static \October\Rain\Database\Collection|static[] get($columns = ['*'])
 * @method static \October\Rain\Database\Builder|UserRole newModelQuery()
 * @method static \October\Rain\Database\Builder|UserRole newQuery()
 * @method static \October\Rain\Database\Builder|UserRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereIsSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole wherePermissions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserRole whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserRole extends RoleBase
{
    const CODE_DEVELOPER = 'developer';
    const CODE_PUBLISHER = 'publisher';

    /**
     * @var string The database table used by the model.
     */
    protected $table = 'backend_user_roles';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required|between:2,128|unique:backend_user_roles',
        'code' => 'unique:backend_user_roles',
    ];

    /**
     * @var array Relations
     */
    public $hasMany = [
        'users' => [User::class, 'key' => 'role_id'],
        'users_count' => [User::class, 'key' => 'role_id', 'count' => true]
    ];

    public function filterFields($fields)
    {
        if ($this->is_system) {
            $fields->code->disabled = true;
            $fields->permissions->disabled = true;
        }
    }

    public function afterFetch()
    {
        if ($this->is_system) {
            $this->permissions = $this->getDefaultPermissions();
        }
    }

    public function beforeSave()
    {
        if ($this->isSystemRole()) {
            $this->is_system = true;
            $this->permissions = [];
        }
    }

    public function isSystemRole()
    {
        if (!$this->code || !strlen(trim($this->code))) {
            return false;
        }

        if ($this->is_system || in_array($this->code, [
            self::CODE_DEVELOPER,
            self::CODE_PUBLISHER
        ])) {
            return true;
        }

        return AuthManager::instance()->hasPermissionsForRole($this->code);
    }

    public function getDefaultPermissions()
    {
        return AuthManager::instance()->listPermissionsForRole($this->code);
    }
}
