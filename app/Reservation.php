<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id', 'nombre_responsable', 'type', 'fecha_solicitada', 'additional_info'
    ];

    public function users()
    {
        return $this.belongsTo('App\User');
    }

}
