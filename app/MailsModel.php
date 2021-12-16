<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailsModel extends Model
{
    
    protected $table = 'mails';
    protected $primaryKey  = 'idmails';
    public $timestamps = true;

    protected $appens =['idmails_encrypt'];
    protected $hidden = ['idmenu'];
    //encryptar campo id
     public function getIdmailsEncryptAttribute()
    {
        return encrypt($this->attributes['idmails']);
    }

    public function usuario(){
        return $this->hasMany('App\User', 'id', 'iduser');
    }


}
