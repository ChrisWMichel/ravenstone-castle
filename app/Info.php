<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $guarded = [];
    protected $with = ['phones'];

    public function phones(){
        return $this->hasMany(Phone::Class);
    }
}
