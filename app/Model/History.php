<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'history';

    protected $fillable = [
        'document_id',
        'nik',
        'action',
        'description',
        'status',
    ];

    public function getUser() {
        return $this->hasOne(LGIGlobal_Users::class, 'UserId', 'nik');
    }

    public function username() {
        return LGIGlobal_Users::where('UserId', $this->nik)->value('name');
    }
}
