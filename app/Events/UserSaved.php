<?php


namespace App\Events;


use App\User;

class UserSaved
{
    public $user;
    public function __construct(User $user){
        $this->user = $user;
    }
}
