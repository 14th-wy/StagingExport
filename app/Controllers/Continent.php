<?php

namespace App\Controllers;
use App\Models\continentModel;
use Config\Services;
use CodeIgniter\HTTP\RequestInterface;


class Continent extends BaseController
{

    // protected $continentModel;
    protected $request;

    // public function __construct()
    // {
    //     $request = Services::request();
    //     $this->continentModel = new \App\Models\continentModel($request);
    // }

    public function index()
    {
        $data = [
            'header' => 'CONTINENT',
        ];

        return view('continent', $data);
    }

    public function ajaxList()
    {
        $request = Services::request();
        $datatable = new continentModel($request);

        if ($request->getMethod(true) === 'POST') {
            $lists = $datatable->getDatatables();
            $data = [];
            $no = $request->getPost('start');

            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->continent_code;
                $row[] = $list->continent_name;
                $row[] = 
                "<a href='/continent/edit/$list->continent_code' class='btn btn-primary'>Edit</a> || 
                <form action='/continent/delete/$list->continent_code' class='d-inline' method='post'>
                <input type='hidden' name='_method' value='DELETE'>
                <button type='submit' class='btn btn-danger' onclick='return deleteconfig()'>Delete</button>
                </form>";
                $data[] = $row;
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $datatable->countAll(),
                'recordsFiltered' => $datatable->countFiltered(),
                'data' => $data
            ];

            echo json_encode($output);
        }
    }

    public function delete($continent_code)
    {
        $request = Services::request();
        $continentModel = new continentModel($request);
        $continentModel->delete($continent_code);
        return redirect()->to('/continent');
    }

    public function edit($continent_code = ''){

        // dd($continent_code);
        $continent_code1 = $continent_code;
        $request = Services::request();
        $continentModel = new continentModel($request);
        // $uri = $request->getVar($continent_code);

        $data = [
            'header' => 'Edit Continent',
            'continent' => $continentModel->getContinent($continent_code),
        ];

        return view('continentformedit', $data);

    }

    public function update($continent_code)
    {
        if (! $this->validate([
            // 'continent_code' => 'required',
            'continent_name' => 'required'
        ])) {
            return redirect()->to('/continent/edit/'.$continent_code);
        }

        $request = Services::request();
        $continentModel = new continentModel($request);
        $data = [
            'continent_code' => $continent_code,
            'continent_name' => $this->request->getVar('continent_name')
        ];

        // dd($continent_code);
        // $continentModel->where('continent_code', $continent_code);
        $continentModel->save($data);
        return redirect()->to('/continent');
    }

    public function formadd()
    {
        $data = [
            'header' => 'Tambah Data Continent'
        ];

        return view('continentformadd', $data);
    }

    public function save()
    {

        if (! $this->validate([
            'continent_code' => 'required',
            'continent_name' => 'required'
        ])) {
            return redirect()->to('/continent/formadd');
        }

        $request = Services::request();
        $continentModel = new continentModel($request);
        $data = [
            'continent_code' => $this->request->getVar('continent_code'),
            'continent_name' => $this->request->getVar('continent_name')
        ];
        $continentModel->insert($data);
        return redirect()->to('/continent');

    }

    public function ajaxContinentName()
    {
        $request = Services::request();
        $continentModel = new continentModel($request);
        $continent_code = $this->request->getVar('continent_code');
        $data = [
            'continent_code' => $continentModel->getcontinent($continent_code),
        ];

        echo json_encode($data);
    }

    public function getContinentName($continent_code)
    {
        $query = $this->db->query("SELECT continent_name AS continent_name FROM continent WHERE continent_code='$continent_code'");
        $hasil = $query->getRow();
        // var_dump($hasil);
        return $hasil->continent_name;
    }

}
