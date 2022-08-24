<?php

namespace App\Permissions;

use App\Models\Permission as ModelsPermission;
use App\Models\Role as ModelsRole;
use App\Models\UserRole as ModelsUserRole;
use Modules\St\Entities\Permission;
use Modules\St\Entities\Role;
use Modules\St\Entities\UserRole;

trait HasPermissionsTrait
{

    public function givePermissionsTo($permissions)
    {

        $permissions = $this->getAllPermissions($permissions);
        dd($permissions);
        if ($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    public function withdrawPermissionsTo($permissions)
    {

        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    public function refreshPermissions($permissions)
    {

        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }

    public function hasPermissionTo($permission)
    {

        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    public function hasPermissionThroughRole($permission)
    {

        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if (ModelsRole::all()->contains('name', $role)) {
            return true;
        }
        return false;
    }

    public function roles()
    {

        return $this->belongsToMany(Role::class, 'user_roles');
    }


    public function getRole($user_id)
    {

        $user_roles = ModelsUserRole::where('user_id','=',$user_id)->first();
        if($user_roles){
            return $user_roles->role_id;
        }
        return 0;

    }


    public function permissions()
    {

        return $this->belongsToMany(Permission::class, 'user_permissions');
    }
    protected function hasPermission($permission)
    {

        return (bool) $this->permissions->where('slug', $permission->slug)->count();
    }

    protected function getAllPermissions(array $permissions)
    {

        return ModelsPermission::whereIn('slug', $permissions)->get();
    }
}
