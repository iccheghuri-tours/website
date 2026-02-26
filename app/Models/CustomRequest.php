<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomRequest extends Model
{
    //
    protected $fillable = [
        'user_id',
        'request',
        'status',
        'note'
    ];
    function user(){
        return $this->belongsTo(User::class);
    }
}
