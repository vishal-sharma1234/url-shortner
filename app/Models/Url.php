<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $table = 'urls';

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function client(){
        return $this->belongsTo(Company::class, 'company_invitation_id', 'id');
    }
}
