<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PO extends Model
{
    use HasFactory;
    protected $connection = 'mysql_SECOND';
    protected $table = 'po';
    protected $guarded = [];

    public function noPo()
    {
        return $this->hasMany(Order::class, 'penawaran_order', 'ql_po');
    }
}
