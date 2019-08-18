<?php

namespace App\Controllers;

class UserController
{
    public function create($array)
    {
        response()->json(request()->all());
    }

}