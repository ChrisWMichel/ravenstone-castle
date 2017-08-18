<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = ['menu_id', 'title', 'details'];
    protected $with = ['eventDates'];

    public function menu(){
        return $this->belongsTo(Menu::Class);
    }

    public function eventDates(){
        return $this->hasMany(EventDate::Class);
    }
}
