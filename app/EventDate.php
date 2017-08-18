<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventDate extends Model
{
    protected $fillable = ['attribute_id', 'start_date', 'end_date', 'word_date'];

    public function attribute(){
        return $this->belongsTo(Attribute::Class);
    }
}
