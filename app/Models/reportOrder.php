<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reportOrder extends Model
{
    use HasFactory;
    protected $table = 'report_orders';
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class, 'no_ql_id', 'penawaran_order');
    }

    public function orderJan()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id_order');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}