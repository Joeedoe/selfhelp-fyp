<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    //
    public function sender(){
        return $this->belongsTo(User::class, 'sender', 'id');
    }

    public function receiver(){
        return $this->belongsTo(User::class, 'receiver', 'id');
    }
}
