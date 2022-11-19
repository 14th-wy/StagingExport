<?php

namespace App\Controllers;
use App\Models\stagingModel;
use Config\Services;

class Staging extends BaseController
{

    protected $request;
    public function __construct(){
        $request = Services::request();
		$this->stagingModel = new stagingModel($request);
	}

    public function index()
    {
        $data = [
            'header' => 'STAGING'
        ];

        return view('staging', $data);
    }

    public function ajaxList()
    {
        $request = Services::request();
        $datatable = new stagingModel($request);

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
                $row[] = $list->date_scan;
                $row[] = $list->continent_code;
                $row[] = $list->kanban;
                $row[] = $list->casemark;
                $row[] = $list->staging_1;
                $row[] = $list->staging_2;
                $row[] = $list->staging_3;
                $row[] = $list->staging_4;
                $row[] = $list->status;
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
