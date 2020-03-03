<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public  function messages()
    {
        return $this->hasMany('App\Chats_Message');
    }

    public  function owner()
    {
        return $this->belongsTo('App\User', "id_animal_owner");
    }

    public  function adopter()
    {
        return $this->belongsTo('App\User', "id_adopter");
    }
}
