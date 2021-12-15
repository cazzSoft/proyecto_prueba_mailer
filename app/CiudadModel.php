<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CiudadModel extends Model
{
    protected $table = 'ciudad';
    protected $primaryKey  = 'idciudad';
    public $timestamps = true;

    public function usuario()
    {
        return $this->belongsTo('App\User', 'idciudad', 'idciudad');
    }
}
