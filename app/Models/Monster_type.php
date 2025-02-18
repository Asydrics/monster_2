<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monster_type extends Model
{
    public function monsters()
{
    return $this->hasMany('App\Models\Monster', 'type_id', 'id');
}
}
