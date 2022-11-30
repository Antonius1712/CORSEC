<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    protected $table = 'document';
    protected $fillable = [
        'document_type_id',
        'document_name',
        'document_filename',
        'document_full_path',
        'document_file_directory',
        'document_description',
        'document_number_of_download',
        'status',
        'created_by',
        'updated_by'
    ];

    public function created_by(){
        return LGIGlobal_Users::where('UserId', $this->created_by)->value('name');
    }
    
    public function updated_by(){
        return LGIGlobal_Users::where('UserId', $this->updated_by)->value('name');
    }

    public function status(){
        return $this->status == 1 ? 'Active' : 'InActive';
    }

    public function history(){
        return $this->hasMany(History::class, 'document_id', 'id');
    }

    public function last_history_name(){
        $name = '';
        $nik = History::where('document_id', $this->id)->orderby('id', 'desc');
        if( $nik ){
            $nik = $nik->get()[0]->nik;
            $name = LGIGlobal_Users::where('UserId', $nik)->value('name');
        }
        return $name;
    }

    public function last_history_desc(){
        $log = '';
        $data = History::where('document_id', $this->id)->orderby('id', 'desc');
        if( $data ){
            $data = $data->get()[0];
            $log = $data->action.' '.$data->description;
        }
        return $log;
    }

    public function master_document(){
        return $this->hasOne(MasterDocument::class, 'id', 'document_type_id');
    }
}
