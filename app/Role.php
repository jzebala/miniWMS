<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Role has users
     */
    public function users() {
        return $this->belongsToMany(User::class);
    }
}
