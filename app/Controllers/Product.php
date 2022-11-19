<?php

namespace App\Controllers;
use App\Models\productModel;
use Config\Services;
use CodeIgniter\HTTP\RequestInterface;


class Product extends BaseController
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
            'header' => 'PRODUCT',
        ];

        return view('product', $data);
    }

    public function ajaxList()
    {
        $request = Services::request();
        $datatable = new productModel($request);

        if ($request->getMethod(true) === 'POST') {
            $lists = $datatable->getDatatables();
            $data = [];
            $no = $request->getPost('start');

            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->product_code;
                $row[] = $list->product_name;
                $row[] = 
                "<a href='/product/edit/$list->product_code' class='btn btn-primary'>Edit</a> || 
                <form action='/product/delete/$list->product_code' class='d-inline' method='post'>
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

    public function delete($product_code)
    {
        $request = Services::request();
        $productModel = new productModel($request);
        $productModel->delete($product_code);
        return redirect()->to('/product');
    }

    public function edit($product_code = ''){

        // dd($product_code);
        $product_code1 = $product_code;
        $request = Services::request();
        $productModel = new productModel($request);
        // $uri = $request->getVar($product_code);

        $data = [
            'header' => 'Edit product',
            'product' => $productModel->getProduct($product_code),
        ];

        return view('productformedit', $data);

    }

    public function update($product_code)
    {
        if (! $this->validate([
            // 'product_code' => 'required',
            'product_name' => 'required'
        ])) {
            return redirect()->to('/product/edit/'.$product_code);
        }

        $request = Services::request();
        $productModel = new productModel($request);
        $data = [
            'product_code' => $product_code,
            'product_name' => $this->request->getVar('product_name')
        ];

        // dd($product_code);
        // $productModel->where('product_code', $product_code);
        $productModel->save($data);
        return redirect()->to('/product');
    }

    public function formadd()
    {
        $data = [
            'header' => 'Tambah Data Product'
        ];

        return view('productformadd', $data);
    }

    public function save()
    {

        if (! $this->validate([
            'product_code' => 'required',
            'product_name' => 'required'
        ])) {
            return redirect()->to('/product/formadd');
        }

        $request = Services::request();
        $productModel = new productModel($request);
        $data = [
            'product_code' => $this->request->getVar('product_code'),
            'product_name' => $this->request->getVar('product_name')
        ];
        $productModel->insert($data);
        return redirect()->to('/product');

    }



}
