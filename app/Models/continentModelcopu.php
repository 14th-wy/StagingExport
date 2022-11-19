<?php

namespace App\Models;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class continentModelcopu extends Model
{
    protected $table = 'continent';
    protected $primaryKey = 'continent_code';
    protected $column_order = ['', 'continent_code', 'continent_name', ''];
    protected $column_search = ['continent_code', 'continent_name'];
    protected $order = ['continent_code' => 'ASC'];
    protected $allowedFields = ['continent_code', 'continent_name'];
    // protected $request;
    // protected $db;
    // protected $dt;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function get_Continent_Code($continent_code = false)
    {
        if($continent_code == false)
        {
            return $this->findAll();
        }

        return $this->where(['continent_code' => $continent_code])->first();
    }

}
