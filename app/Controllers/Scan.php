<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\scanModel;
use Config\Services;


class Scan extends BaseController
{

    use ResponseTrait;
    protected $request;
    public function __construct(){
        $request = Services::request();
		$this->scanModel = new scanModel($request);
	}
    public function index()
    {
        $data = [
            'header' => 'SCAN'
        ];

        return view('scan', $data);
    }

    public function create()
    {
        $request = Services::request();
        $model = new scanModel($request);
        $data = [
            'product_name' => $this->request->getVar('product_name'),
            'product_price' => $this->request->getVar('product_price')
        ];
        
        // $data = json_decode(file_get_contents("php://input"));
        //$data = $this->request->getPost();
        $model->insert($data);
        // dd($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];
         
        return $this->respondCreated($response);
    }

    public function ajaxList()
    {
        $request = Services::request();
        $datatable = new scanModel($request);

        if ($request->getMethod(true) === 'POST') {
            $lists = $datatable->getDatatables();
            $data = [];
            $no = $request->getPost('start');

            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->hdrid;
                $row[] = $list->transaction_date;
                $row[] = $list->part_number;
                $row[] = $list->part_name;
                $row[] = $list->production_date;
                $row[] = $list->qty;
                $row[] = $list->date_scan;
                $row[] = $list->product_code;
                $row[] = $list->product_name;
                $row[] = $list->customer_code;
                $row[] = $list->customer_name;
                $row[] = $list->continent_code;
                $row[] = $list->continent_name;
                $row[] = $list->casemark;
                $row[] = $list->kanban;
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
}
