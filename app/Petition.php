<?php

namespace Solsticio;

use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo('Solsticio\User', 'user_id');
    }
}
