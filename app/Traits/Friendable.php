<?php

namespace App\Traits;

use App\Models\Friend;

trait Friendable{
    public function add_friend($user_requested_id){
        $friendship = Friend::create([
            'requester' => $this->id,
            'user_requested'=>$user_requested_id
        ]);
        if($friendship){
            return 1;
        }
        return 0;
    }
}