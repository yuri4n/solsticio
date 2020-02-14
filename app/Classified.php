<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classified extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'title', 'slug', 'excerpt', 'body', 'file', 'status'
    ];

    public function users()
    {
        return $this . belongsTo('App\User');
    }

    public function categories()
    {
        return $this . belongsTo('App\Category');
    }

}
