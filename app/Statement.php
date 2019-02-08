<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
