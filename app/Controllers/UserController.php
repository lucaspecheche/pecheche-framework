<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
    public function create($array)
    {
        $query = User::query()
            ->where('id','=',2)
            ->where('name', '=', 'Teste');

        dd(User::all());


    }

    public function update($array)
    {
        return response()->json('update');
    }

}