<?php

namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class partnumberModel extends Model
{
    protected $table = 'part_number';
    protected $primaryKey = 'part_number';
    protected $column_order = ['', 'transaction_date', 'part_number', 'part_name', 'product_code', 'product_name', 'customer_code', 'customer_name', 'continent_code', 'continent_name', ''];
    protected $column_search = ['transaction_date', 'part_number', 'part_name', 'product_code', 'product_name', 'customer_code', 'customer_name', 'continent_code', 'continent_name'];
    protected $order = ['transaction_date' => 'ASC'];
    protected $allowedFields = ['transaction_date','part_number', 'part_name', 'product_code', 'product_name', 'customer_code', 'customer_name', 'continent_code', 'continent_name'];
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

    public function getPartnumber($partnumber = false)
    {
        // var_dump($this->where(['partnumber' => "001"])->first());
        // exit();
        if ($partnumber == false) {
            return $this->findAll();
        }

        return $this->where(['part_number' => $partnumber])->first();
    }

    public function getJoin()
    {
         return $this->db->table('part_number')
         ->join('continent','continent.continent_code=part_number.part_number')
         ->join('customer', 'customer.customer_code=part_number.part_number')
         ->join('product', 'product.product_code=part_number.part_number')
         ->get()->getResultArray();  
    }


    public function getPartName($part_number)
    {
        $query = $this->db->query("SELECT part_name AS part_name FROM part_number WHERE part_number='$part_number'");
        $hasil = $query->getRow();
        // var_dump($hasil);
        return $hasil->part_name;
    }

}
