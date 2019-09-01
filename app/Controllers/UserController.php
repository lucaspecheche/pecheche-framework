<?php

namespace App\Controllers;

use App\Models\User;
use Core\App\Database\Database;

class UserController
{
    public function create($array)
    {
        $query = User::query()
            //->where('id', 2)
            ->where('name', 'Teste')
            ->first();

        dd($query);


    }

    public function update($array)
    {
        return response()->json('update');
    }

}