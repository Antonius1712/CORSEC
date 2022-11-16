<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LGIGlobal_UserGroup extends Model
{
    protected $connection = 'LGIGlobal';
    protected $table = 'UserGroup';

    public function getGroups(){
        return $this->hasMany(LGIGlobal_Groups::class, 'GroupCode', 'GroupCode');
    }
}
