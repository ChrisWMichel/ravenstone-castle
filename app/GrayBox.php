<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrayBox extends Model
{
    protected $fillable = ['menu_id', 'title', 'body'];
    public $timestamps = false;

    public function menu(){
        return $this->belongsTo(Menu::Class);
    }
}
