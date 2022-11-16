<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class LGIGlobal_Users extends Authenticatable
{
    protected $connection = 'LGIGlobal';
    protected $table = 'Users';
    protected $primaryKey = 'UserId';
    public $incrementing = false;

    // DISABLE REMEMBER TOKEN.
    public function setAttribute($key, $value)
    {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
        if (!$isRememberTokenAttribute){
            parent::setAttribute($key, $value);
        }
    }

    protected $hidden = [
        'Password',
    ];

    public function getDept(){
        return $this->hasOne(LGIGlobal_Dept::class, 'DeptCode', 'DeptCode');
    }

    public function getBranch(){
        return $this->hasOne(LGIGlobal_Branch::class, 'BranchCode', 'BranchCode');
    }
    
    public function getUserGroup(){
        return $this->hasMany(LGIGlobal_UserGroup::class, 'UserId', 'UserId');
    }

    public function isAdmin(){
        $group = LGIGlobal_UserGroup::where('UserId', $this->UserId)->pluck('GroupCode')->toArray();
        if( in_array('ADMIN_CORSEC', $group) ){
            return true;
        }else{
            return false;
        }
    }

    
}
