<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = ['info_id', 'name', 'phone', 'fax'];

    public function info(){
        return $this->belongsTo(Info::Class);
    }
}
