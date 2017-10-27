<?php

namespace App\Composers;

class ProfileComposer
{
    protected $users;

    public function compose($view)
    {
        $view->with('user', \Auth::user());
    }
}