<?php

namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class continentModel extends Model
{
    protected $table = 'continent';
    protected $primaryKey = 'continent_code';
    protected $column_order = ['', 'continent_code', 'continent_name', ''];
    protected $column_search = ['continent_code', 'continent_name'];
    protected $order = ['continent_code' => 'ASC'];
    protected $allowedFields = ['continent_code', 'continent_name'];
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

    public function getContinent($continent_code = false)
    {
        // var_dump($this->where(['continent_code' => "001"])->first());
        // exit();
        if ($continent_code == false) {
            return $this->findAll();
        }

        return $this->where(['continent_code' => $continent_code])->first();
    }

    public function getContinentName($continent_code)
    {
        $query = $this->db->query("SELECT continent_name AS continent_name FROM continent WHERE continent_code='$continent_code'");
        $hasil = $query->getRow();
        // var_dump($hasil);
        return $hasil->continent_name;
    }
}
