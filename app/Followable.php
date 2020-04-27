<?php

namespace App;

trait Followable
{
    public function follow(User $user)
    {
        $this->follows()->save($user);
    }

    public function following()
    {
        //
    }

    public function follows()
    {
        return $this->belongsToMany(
            User::class,
            'follows',
            'user_id',
            'following_user_id'
        );
    }
}
