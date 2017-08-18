<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['name', 'description'];

    public function attributes(){
        return $this->hasMany(Attribute::Class);
    }
}
