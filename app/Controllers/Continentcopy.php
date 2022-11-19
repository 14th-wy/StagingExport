<?php

namespace App\Controllers;
use App\Models\continentModel;
use Config\Services;
use CodeIgniter\HTTP\RequestInterface;
use Config\App;

class Continentcopy extends BaseController
{
    protected $continentModel;
    public function __construct()
    {
        $this->continentModel = new continentModel();
    }
    
    public function index()
    {
        $continent = $this->continentModel->findAll();
        $data = [
            'header' => 'Continent',
            'continent' => $this->continentModel->get_Continent_Code(),
        ];

        return view('continent', $data);        
    }

    public function edit($continent_code)
    {
        $data = [
            'header' => 'Edit Continent',
            'continent' => $this->continentModel->get_Continent_Code($continent_code),
        ];

        return view('continentform', $data);
    }

}
