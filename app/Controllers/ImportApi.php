<?php namespace App\Controllers;

use App\Models\continentModel;
use App\Models\customerModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\importModel;
use App\Models\productModel;
use App\Models\scanModel;
use App\Models\partnumberModel;
use App\Models\stagingModel;
use Config\Services;

class ImportApi extends ResourceController
{
    use ResponseTrait;
    protected $request;
    public function __construct(){
        $request = Services::request();
		$this->importModel = new importModel($request);
        $this->scanModel = new scanModel($request);
        $this->productModel = new productModel($request);
        $this->partnumberModel = new partnumberModel($request);
        $this->continentModel = new continentModel($request);
        $this->customerModel = new customerModel($request);
        $this->stagingModel = new stagingModel($request);
	}

    public function index()
    {
        $request = Services::request();
		$model = new importModel($request);
        $data = $model->findAll();
        return $this->respond($data, 200);
    }

    public function create()
    {
        $request = Services::request();
        $model = new scanModel($request);
        $counthdrid = $this->scanModel->countHdrid();
        $nourut = substr($counthdrid, 11, 2);
        $newhdrid = 'HDRID202208'. $nourut + 1;
        $product_name = $this->productModel->getProductName($this->request->getVar('product_code'));
        $part_name = $this->partnumberModel->getPartName($this->request->getVar('part_number'));
        $continent_name = $this->continentModel->getContinentName($this->request->getVar('continent_code'));
        $customer_name = $this->customerModel->getCustomerName($this->request->getVar('customer_code'));
        // var_dump($product_name);
        $data = [
            'hdrid' => $newhdrid,
            'transaction_date'  => date('Y-m-d H:i:s'),
            'part_number' => $this->request->getVar('part_number'),
            'part_name' => $part_name,
            'production_date' => $this->request->getVar('production_date'),
            'qty' => $this->request->getVar('qty'),
            'date_scan' => $this->request->getVar('date_scan'),
            'product_code' => $this->request->getVar('product_code'),
            'product_name' => $product_name,
            'customer_code' => $this->request->getVar('customer_code'),
            'customer_name' => $customer_name,
            'continent_code' => $this->request->getVar('continent_code'),
            'continent_name' => $continent_name,
            'casemark' => $this->request->getVar('casemark'),
            'kanban' => $this->request->getVar('kanban'),
        ];
        // var_dump($data['hdrid']);
        // die();
        $model->insert($data);
        if ($continent_name == 'China') {
            $this->stagingModel->insertStaging_1($data['hdrid'], $data['transaction_date'], $data['date_scan'], $data['continent_code'], $data['kanban'], $data['casemark']);
        } else if ($continent_name == 'Japan'){
            $this->stagingModel->insertStaging_2($data['hdrid'], $data['transaction_date'], $data['date_scan'], $data['continent_code'], $data['kanban'], $data['casemark']);
        } else if ($continent_name == 'Thailand'){
            $this->stagingModel->insertStaging_3($data['hdrid'], $data['transaction_date'], $data['date_scan'], $data['continent_code'], $data['kanban'], $data['casemark']);
        } else {
            $this->stagingModel->insertStaging_4($data['hdrid'], $data['transaction_date'], $data['date_scan'], $data['continent_code'], $data['kanban'], $data['casemark']);
        }
        
        // $response = [
        //     'status'   => 201,
        //     'error'    => null,
        //     'messages' => [
        //         'success' => 'Data scan berhasil ditambahkan.'
        //     ]
        // ];
        return $this->respondCreated(201);
    }
}