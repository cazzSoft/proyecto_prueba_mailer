<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    protected $primaryKey  = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id', 'name', 'email','password','dni','fecha_na','idciudad','num_celular','codigo_ci','tipo_user'
    ];

    
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function adminlte_image()
    {
        return 'https://picsum.photos/300/300';
    }

    public function adminlte_desc()
    {
        return auth()->user()->email;
    }

    public function adminlte_profile_url()
    {
        // $id=encrypt(auth()->user()->id);
        return 'profile/perfil';
    }

    public function ciudad()
    {
        return $this->hasOne('App\CiudadModel', 'idciudad', 'idciudad');
    }
    
  
}

