<?php

namespace App\Controllers;

use App\Models\productModel;
use App\Models\partnumberModel;
use App\Models\continentModel;
use App\Models\customerModel;
use Config\Services;
use CodeIgniter\HTTP\RequestInterface;


class Partnumber extends BaseController
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
        $request = Services::request();
        $join = new partnumberModel($request);
        $data = [
            'header' => 'PART NUMBER',
            'join' => $join->getPartnumber(),
        ];

        return view('partnumber', $data);
    }

    public function ajaxList()
    {
        $request = Services::request();
        $datatable = new partnumberModel($request);
        // $datatable2 = new customerModel($request);

        if ($request->getMethod(true) === 'POST') {
            $lists = $datatable->getDatatables();
            // $lists = $datatable2->getDatatables();
            $data = [];
            $no = $request->getPost('start');

            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->transaction_date;
                $row[] = $list->part_number;
                $row[] = $list->part_name;
                $row[] = $list->product_code;
                $row[] = $list->product_name;
                $row[] = $list->customer_code;
                $row[] = $list->customer_name;
                $row[] = $list->continent_code;
                $row[] = $list->continent_name;
                $row[] = 
                "<a href='/partnumber/edit/$list->part_number' class='btn btn-primary'>Edit</a> || 
                <form action='/partnumber/delete/$list->part_number' class='d-inline' method='post'>
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

    public function delete($part_number)
    {
        $request = Services::request();
        $partnumberModel = new partnumberModel($request);
        $partnumberModel->delete($part_number);
        return redirect()->to('/partnumber');
    }

    public function edit($part_number = ''){

        // dd($part_number);
        $part_number1 = $part_number;
        $request = Services::request();
        $partnumberModel = new partnumberModel($request);
        // $continentModel = new continentModel($request);
        // $customerModel = new customerModel($request);
        $productModel = new productModel($request);
        // $uri = $request->getVar($part_number);

        $data = [
            'header' => 'Edit Part Number',
            'product_code' => $productModel->getProduct(),
            'part_number' => $partnumberModel->getPartnumber($part_number),
        ];

        // dd($data);

        return view('partnumberformedit', $data);

    }

    public function update($part_number)
    {
        if (! $this->validate([
            // 'part_number' => 'required',
            'part_name' => 'required'
        ])) {
            return redirect()->to('/partnumber/edit/'.$part_number);
        }

        $request = Services::request();
        $partnumberModel = new partnumberModel($request);
        $data = [
            'part_number' => $part_number,
            'part_name' => $this->request->getVar('part_name'),
            'product_code' => $this->request->getVar('product_code'),
            'product_name' => $this->request->getVar('product_name'),
            'customer_code' => $this->request->getVar('customer_code'),
            'customer_name' => $this->request->getVar('customer_name'),
            'continent_code' => $this->request->getVar('continent_code'),
            'continent_name' => $this->request->getVar('continent_name'),
        ];

        // dd($data);
        // $partnumberModel->where('part_number', $part_number);
        $partnumberModel->save($data);
        return redirect()->to('/partnumber');
    }

    public function formadd()
    {
        $request = Services::request();
        $productModel = new productModel($request);
        $customerModel = new customerModel($request);
        $continentModel = new continentModel($request);
        $data = [
            'header' => 'Tambah Data Part Number',
            'product' => $productModel->findAll(),
            'customer' => $customerModel->getCustomer(),
            'continent' => $continentModel->getContinent(),

        ];

        return view('partnumberformadd', $data);
    }

    public function save()
    {

        if (! $this->validate([
            'part_number' => 'required',
            'part_name' => 'required'
        ])) {
            return redirect()->to('/partnumber/formadd');
        }

        $request = Services::request();
        $partnumberModel = new partnumberModel($request);
        $data = [
            'transaction_date' => date("Y-m-d H:i:s"),
            'part_number' => $this->request->getVar('part_number'),
            'part_name' => $this->request->getVar('part_name'),
            'product_code' => $this->request->getVar('product_code'),
            'product_name' => $this->request->getVar('product_name'),
            'customer_code' => $this->request->getVar('customer_code'),
            'customer_name' => $this->request->getVar('customer_name'),
            'continent_code' => $this->request->getVar('continent_code'),
            'continent_name' => $this->request->getVar('continent_name'),
        ];
        // dd($data);
        $partnumberModel->insert($data);
        return redirect()->to('/partnumber');

    }

    public function ajaxProductName()
    {
        $request = Services::request();
        $productModel = new productModel($request);
        $product_code = $this->request->getVar('product_code');
        $data = [
            'product_code' => $productModel->getProduct($product_code),
        ];

        echo json_encode($data);
    }

}
