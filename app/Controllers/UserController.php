<?php

namespace App\Controllers;

class UserController
{
    public function create($array)
    {
        return response()->json('create');
    }

    public function update($array)
    {
        return response()->json('update');
    }

}