<?php

namespace Solsticio;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'description', 'file'
    ];
}
