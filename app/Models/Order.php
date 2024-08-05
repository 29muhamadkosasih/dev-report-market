<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $connection = 'mysql_SECOND';
    protected $table = 'orders';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(UserGet::class, 'post_order',);
    }
    public function ql()
    {
        return $this->belongsTo(Quotation::class, 'penawaran_order', 'id_penawaran');
    }

    public function noPo()
    {
        return $this->belongsTo(PO::class, 'ql_po', 'penawaran_order');
    }
}