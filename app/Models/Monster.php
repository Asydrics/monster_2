<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monster extends Model
{
    
    public function monster_type() {
        return $this->belongsTo('App\Models\Monster_type', 'type_id', 'id');
    }
}
