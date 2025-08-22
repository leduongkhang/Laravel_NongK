<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name_xaphuong', 'type', 'maqh'
    ];
    protected $table = 'tbl_xaphuongthitran';
    protected $primaryKey = 'xaid';
}
