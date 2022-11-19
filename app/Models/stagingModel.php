<?php

namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class stagingModel extends Model
{

    protected $table = 'staging';
    protected $primaryKey = 'hdrid';
    protected $column_order = ['', 'transaction_date', 'date_scan', 'continent_code', 'kanban', 'casemark', 'staging_1', 'staging_2', 'staging_3', 'staging_4', 'status', ''];
    protected $column_search = ['transaction_date', 'date_scan', 'continent_code', 'kanban', 'casemark', 'staging_1', 'staging_2', 'staging_3', 'staging_4', 'status',];
    protected $order = ['transaction_date' => 'ASC'];
    protected $allowedFields = ['hdrid','transaction_date','date_scan', 'continent_code', 'kanban', 'casemark', 'staging_1', 'staging_2', 'staging_3', 'staging_4', 'status',];
    protected $request;
    protected $db;
    protected $dt;
    
    public function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table);

    }

    private function getDatatablesQuery()
    {
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }

    public function getDatatables()
    {
        $this->getDatatablesQuery();
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    public function countFiltered()
    {
        $this->getDatatablesQuery();
        return $this->dt->countAllResults();
    }

    public function countAll()
    {
        $tbl_storage = $this->db->table($this->table);
        return $tbl_storage->countAllResults();
    }

    // public function getPartnumber($partnumber = false)
    // {
    //     // var_dump($this->where(['partnumber' => "001"])->first());
    //     // exit();
    //     if ($partnumber == false) {
    //         return $this->findAll();
    //     }

    //     return $this->where(['part_number' => $partnumber])->first();
    // }

    public function insertStaging_1($hdrid, $transaction_date, $date_scan, $continent_code, $kanban, $casemark)
    {
       $query = $this->db->query("INSERT INTO staging (hdrid, transaction_date, date_scan, continent_code, kanban, casemark, staging_1, status) VALUES ('$hdrid', '$transaction_date', '$date_scan', '$continent_code', '$kanban', '$casemark', 'IN', 'IN')");
    //    dd($query);
        return $query;
    }

    public function insertStaging_2($hdrid, $transaction_date, $date_scan, $continent_code, $kanban, $casemark)
    {
       $query = $this->db->query("INSERT INTO staging (hdrid, transaction_date, date_scan, continent_code, kanban, casemark, staging_2, status) VALUES ('$hdrid', '$transaction_date', '$date_scan', '$continent_code', '$kanban', '$casemark', 'IN', 'IN')");
    //    dd($query);
        return $query;
    }

    public function insertStaging_3($hdrid, $transaction_date, $date_scan, $continent_code, $kanban, $casemark)
    {
       $query = $this->db->query("INSERT INTO staging (hdrid, transaction_date, date_scan, continent_code, kanban, casemark, staging_3, status) VALUES ('$hdrid', '$transaction_date', '$date_scan', '$continent_code', '$kanban', '$casemark', 'IN', 'IN')");
    //    dd($query);
        return $query;
    }

    public function insertStaging_4($hdrid, $transaction_date, $date_scan, $continent_code, $kanban, $casemark)
    {
       $query = $this->db->query("INSERT INTO staging (hdrid, transaction_date, date_scan, continent_code, kanban, casemark, staging_4, status) VALUES ('$hdrid', '$transaction_date', '$date_scan', '$continent_code', '$kanban', '$casemark', 'IN', 'IN')");
    //    dd($query);
        return $query;
    }

}