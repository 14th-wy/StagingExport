<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class tbproductModel extends Model
{
    protected $table = 'tb_product';
    protected $primaryKey = 'product_id';
    protected $allowedFields = ['product_name','product_price'];
}