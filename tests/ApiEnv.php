<?php

namespace Tests;

use App\Models\User;
use App\Models\Order;

trait ApiEnv
{
    private $user = null;
    private $testUser = null;
    private $order = null;
    private $headers = null;

    public function createEnvironment($role=['role'=>'admin'], $login=false, $order=false, $testUser=false){

        if($this->user == null){
            $this->user = factory(User::class)->create($role);
            //echo "\n Create User with id: {$this->user->id} \n";

            if($order){
                $this->order = factory(Order::class)->create(['user_id' =>$this->user->id]);
//                echo "\n Create Order with id: {$this->order->id} \n";
            }
            if($testUser){
                $this->testUser = factory(User::class)->create(['role'=>'user']);
//                echo "\n Create User with id: {$this->testUser->id} \n";
            }

            $this->headers = ['Authorization' => 'Bearer '.$this->user->generateToken()];

            $this->beforeApplicationDestroyed(function () {
                //echo "\n Remove User with id: {$this->user->id} \n";
                User::where('id', '=', $this->user->id)->delete();
                if($this->order){
                    Order::where('id', '=', $this->order->id)->delete();
                }
                if($this->testUser){
                    User::where('id', '=', $this->testUser->id)->delete();
                }
            });

            if ($login) {
                $this->be(User::where('id', '=', $this->user->id)->first());
            }

        }else{
            User::where('id', '=', $this->user->id)->delete();
            $this->user = null;
            if($this->order){
                Order::where('id', '=', $this->order->id)->delete();
                $this->order = null;
            }
            if($this->testUser){
                User::where('id', '=', $this->testUser->id)->delete();
                $this->testUser = null;
            }
        }

    }

    public function removeEnvironment()
    {
        if ($this->user) {
            User::where('id', '=', $this->user->id)->delete();
            $this->user = null;
        }
        if($this->order){
            Order::where('id', '=', $this->order->id)->delete();
            $this->order = null;
        }
    }

}