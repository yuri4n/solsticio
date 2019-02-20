<?php

namespace Solsticio;

use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo('Solsticio\User', 'user_id');
    }
}
