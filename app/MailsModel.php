<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailsModel extends Model
{
    use Notifiable;
    protected $table = 'mails';
    protected $primaryKey  = 'idmails';
    public $timestamps = true;
}
