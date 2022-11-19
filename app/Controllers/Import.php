<?php 

namespace App\Controllers;
use App\Models\importModel;
use Config\Services;



class Import extends BaseController
{
	protected $request;
	public function __construct(){
        $request = Services::request();
		$this->importModel = new importModel($request);
	}
	public function index(){
		$data = 
        [ 
			// 'import' => $this->importModel->findAll(),
          'header' => 'Import'
        ]; 
		return view('import',$data);
	}
	public function simpanExcel()
		{
			$file_excel = $this->request->getFile('fileexcel');
			$ext = $file_excel->getClientExtension();
			if($ext == 'xls') {
				$render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			} else {
				$render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}
			$spreadsheet = $render->load($file_excel);
	
			$data = $spreadsheet->getActiveSheet()->toArray();
			foreach($data as $x => $row) {
				if ($x == 0) {
					continue;
				}
				
				$casemark = $row[0];
				$kanban = $row[1];
				$qty = $row[2];
	
				$db = \Config\Database::connect();

				$cekcasemark = $db->table('import')->getWhere(['casemark'=>$casemark])->getResult();

				if(count($cekcasemark) > 0) {
					session()->setFlashdata('message','<b style="color:red">Data Gagal di Import Casemark ada yang sama</b>');
				} else {
	
				$simpandata = [
					'casemark' => $casemark, 'kanban' => $kanban, 'qty'=> $qty
				];
	
				$db->table('import')->insert($simpandata);
				session()->setFlashdata('message','Berhasil import excel'); 
			}
		}
			
			return redirect()->to('/import');
		}

		public function ajaxList()
    {
        $request = Services::request();
        $datatable = new importModel($request);

        if ($request->getMethod(true) === 'POST') {
            $lists = $datatable->getDatatables();
            $data = [];
            $no = $request->getPost('start');

            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->casemark;
                $row[] = $list->kanban;
                $row[] = $list->qty;
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