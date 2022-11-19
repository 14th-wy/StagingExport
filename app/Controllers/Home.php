<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'header' => 'STAGING'
        ];

        return view('staging', $data);
    }
}
