<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterDocument extends Model
{
    use SoftDeletes;

    // public $timestamps = false;

    protected $table = 'master_document';
    protected $fillable = [
        'document_type',
        'document_description',
        'created_by',
        'updated_by'
    ];
    

    public function created_by(){
        return LGIGlobal_Users::where('UserId', $this->created_by)->value('name');
    }
    
    public function updated_by(){
        return LGIGlobal_Users::where('UserId', $this->updated_by)->value('name');
    }
}
