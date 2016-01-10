<?php

namespace SmartCarBazar\Models;

//use Illuminate\Database\Eloquent\Model;
use \Hash;
use Auth;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends BaseModel implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable,
        CanResetPassword,
        SoftDeletes;

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
    protected $fillable = ['first_name', 'last_name', 'username', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = Hash::make($password);
    }

    /*
      |--------------------------------------------------------------------------
      | ACL Methods
      |--------------------------------------------------------------------------
     */

    /**
     * Checks a Permission
     *
     * @param  String permission Slug of a permission (i.e: manage_user)
     * @return Boolean true if has permission, otherwise false
     */
    public function can($permission = null) {
        return !is_null($permission) && $this->checkPermission($permission);
    }

    /**
     * Check if the permission matches with any permission user has
     *
     * @param  String permission slug of a permission
     * @return Boolean true if permission exists, otherwise false
     */
    protected function checkPermission($perm) {
        $permissions = $this->getAllPernissionsFormAllRoles();

        $permissionArray = is_array($perm) ? $perm : [$perm];

        return count(array_intersect($permissions, $permissionArray));
    }

    /**
     * Get all permission slugs from all permissions of all roles
     *
     * @return Array of permission slugs
     */
    protected function getAllPernissionsFormAllRoles() {
        $permissionsArray = [];

        $permissions = $this->roles->load('permissions')->fetch('permissions')->toArray();

        return array_map('strtolower', array_unique(array_flatten(array_map(function ($permission) {

                                    return array_fetch($permission, 'permission_slug');
                                }, $permissions))));
    }

    /*
      |--------------------------------------------------------------------------
      | Relationship Methods
      |--------------------------------------------------------------------------
     */

    /**
     * Many-To-Many Relationship Method for accessing the User->roles
     *
     * @return QueryBuilder Object
     */
    public function roles() {
        return $this->belongsToMany('SmartCarBazar\Models\Role');
    }

    public function login($username, $password, $corporate_id = null) {
        try {
            $credentials = array('email' => $username, 'password' => $password);
            $flag = Auth::attempt($credentials);
            if($flag){
                $user = Auth::user();
                $user->last_login = date('Y-m-d H:i:s');
                $user->last_activity = date('Y-m-d H:i:s');
                $user->save();
                return $user;
            }
            return false;
        } catch (\Exception $e) {
            echo $e->getMessage();exit;
           // $this->validations->add('error', 'Please enter valid credentials.');
        }

        return false;
    }

}
