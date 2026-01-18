<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company_invitations';


    public function users()
    {
        return $this->hasMany(User::class, 'company_invitation_id');
    }

    public function urls()
    {
        return $this->hasMany(Url::class, 'company_invitation_id');
    }
}
