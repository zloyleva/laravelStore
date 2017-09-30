<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use Notifiable;

  protected $fillable = [
      'name', 'email', 'password',
  ];

  protected $hidden = [
      'password', 'remember_token',
  ];

  public function generateToken()
  {
      $this->api_token = str_random(60);
      $this->save();

      return $this->api_token;
  }

  /**
   * Clear api_token
   */
  public function clearToken()
  {
      $this->api_token = null;
      $this->save();
  }

  public function isAdmin()
    {
        return $this->role === 'admin';
    }

}
