<?php

namespace App\Controllers;

class UserController
{
    public function create($array)
    {
        $tt = file_get_contents("php://input");

        response()->json(json_decode($tt));

    }



}