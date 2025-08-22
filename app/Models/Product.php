<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'category_id', 'product_name', 'product_quantity', 'meta_keywords', 'brand_id', 'product_desc', 'product_content', 'product_price', 'product_image', 'product_status'
    ];
    protected $table = 'tbl_product';
    protected $primaryKey = 'product_id';
}
