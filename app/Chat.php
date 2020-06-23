<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    //
    public function fsender(){
        return $this->belongsTo(User::class, 'sender', 'id');
    }

    public function freceiver(){
        return $this->belongsTo(User::class, 'receiver', 'id');
    }

    public function messages(){
        return $this->hasMany(Message::class, 'chat_id', 'id');
    }
}
