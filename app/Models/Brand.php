<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'brand_name', 'meta_keywords', 'brand_desc', 'brand_status'
    ];
    protected $table = 'tbl_brand_product';
    protected $primaryKey = 'brand_id';
}
