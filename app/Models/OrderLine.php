<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    protected $table = 'order_line';
    protected $primaryKey = 'order_line_id';
    public $incrementing = true;
    public $timestamps = false;
}
