<?php

namespace App\Controllers;
use App\Models\customerModel;
use Config\Services;
use CodeIgniter\HTTP\RequestInterface;


class Customer extends BaseController
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
            'header' => 'CUSTOMER',
        ];

        return view('customer', $data);
    }

    public function ajaxList()
    {
        $request = Services::request();
        $datatable = new customerModel($request);

        if ($request->getMethod(true) === 'POST') {
            $lists = $datatable->getDatatables();
            $data = [];
            $no = $request->getPost('start');

            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->customer_code;
                $row[] = $list->customer_name;
                $row[] = 
                "<a href='/customer/edit/$list->customer_code' class='btn btn-primary'>Edit</a> || 
                <form action='/customer/delete/$list->customer_code' class='d-inline' method='post'>
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

    public function delete($customer_code)
    {
        $request = Services::request();
        $customerModel = new customerModel($request);
        $customerModel->delete($customer_code);
        return redirect()->to('/customer');
    }

    public function edit($customer_code = ''){

        // dd($customer_code);
        $customer_code1 = $customer_code;
        $request = Services::request();
        $customerModel = new customerModel($request);
        // $uri = $request->getVar($customer_code);

        $data = [
            'header' => 'Edit customer',
            'customer' => $customerModel->getCustomer($customer_code),
        ];

        return view('customerformedit', $data);

    }

    public function update($customer_code)
    {
        if (! $this->validate([
            // 'customer_code' => 'required',
            'customer_name' => 'required'
        ])) {
            return redirect()->to('/customer/edit/'.$customer_code);
        }

        $request = Services::request();
        $customerModel = new customerModel($request);
        $data = [
            'customer_code' => $customer_code,
            'customer_name' => $this->request->getVar('customer_name')
        ];

        // dd($customer_code);
        // $customerModel->where('customer_code', $customer_code);
        $customerModel->save($data);
        return redirect()->to('/customer');
    }

    public function formadd()
    {
        $data = [
            'header' => 'Tambah Data customer'
        ];

        return view('customerformadd', $data);
    }

    public function save()
    {

        if (! $this->validate([
            'customer_code' => 'required',
            'customer_name' => 'required'
        ])) {
            return redirect()->to('/customer/formadd');
        }

        $request = Services::request();
        $customerModel = new customerModel($request);
        $data = [
            'customer_code' => $this->request->getVar('customer_code'),
            'customer_name' => $this->request->getVar('customer_name')
        ];
        $customerModel->insert($data);
        return redirect()->to('/customer');

    }


    public function ajaxCustomerName()
    {
        $request = Services::request();
        $customerModel = new customerModel($request);
        $customer_code = $this->request->getVar('customer_code');
        $data = [
            'customer_code' => $customerModel->getCustomer($customer_code),
        ];

        echo json_encode($data);
    }
}
