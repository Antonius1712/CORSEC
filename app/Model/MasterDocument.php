<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterDocument extends Model
{
    use SoftDeletes;

    protected $table = 'master_document';
    protected $fillable = [
        'document_type',
        'document_description',
        'created_by',
        'updated_by'
    ];
}
