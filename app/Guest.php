<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Encryption\DecryptException;
use \Crypt;

class Guest extends Model
{
    protected $fillable = ['name','email','content'];

    public function getIDAttr($value)
    {
        return Crypt::decrypt($value);;
    }

    public function setIDAttr($value)
    {
        $this->attributes['id'] = Crypt::encrypt($value);
    }
}
