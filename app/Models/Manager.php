<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $fillable = ['name', 'email'];

    public function users(){
        return $this->hasMany(User::class);
    }
}
