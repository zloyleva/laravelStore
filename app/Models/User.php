<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'fname', 'lname', 'email', 'password', 'role', 'price_type', 'address', 'phone', 'manager_id', 'client_type'
    ];

    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }

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

    public function isManager()
    {
        return $this->role === 'manager';
    }

    public function addNewUser($data)
    {
        return User::create([
            'name' => $data['name'],
            'fname' => $data['fname'] ?? 'Unnamed',
            'lname' => $data['lname'] ?? 'Unnamed',
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'] ?? 'user',
            'price_type' => $data['price_type'] ?? 'price_user',
            'address' => $data['address'] ?? '',
            'phone' => $data['phone'] ?? '',
            'manager_id' => $data['manager_id'],
        ]);
    }

    public function updateUser($data){

        $user = $this->where('id', $data['user_id'])->firstOrFail();



        $args = [
            'name' => $data['name'],
            'fname' => $data['fname'] ?? 'Unnamed',
            'lname' => $data['lname'] ?? 'Unnamed',
            'email' => $data['email'],
            'price_type' => $data['price_type'] ?? 'price_user',
            'address' => $data['address'] ?? '',
            'phone' => $data['phone'] ?? '',
            'manager_id' => $data['manager_id'],
        ];

        if($data['role']){
            $args['role'] = $data['role'];
        }
        if(isset($data['password']) && strlen($data['password'])>6){
            $args['password'] = bcrypt($data['password']);
        }

        $user->fill($args);

        return $user->save();
    }
}
