<?php

namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class productModel extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'product_code';
    protected $column_order = ['', 'product_code', 'product_name', ''];
    protected $column_search = ['product_code', 'product_name'];
    protected $order = ['product_code' => 'ASC'];
    protected $allowedFields = ['product_code', 'product_name'];
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

    public function getProduct($product_code = false)
    {
        // var_dump($this->where(['product_code' => "001"])->first());
        // exit();
        if ($product_code == false) {
            return $this->findAll();
        }

        return $this->where(['product_code' => $product_code])->first();
    }

    public function getProductName($product)
    {
        $query = $this->db->query("SELECT product_name AS product_name FROM product WHERE product_code='$product'");
        $hasil = $query->getRow();
        // var_dump($hasil);
        return $hasil->product_name;
    }
}
