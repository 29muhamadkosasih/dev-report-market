<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;
    protected $connection = 'mysql_SECOND';
    protected $table = 'penawaran';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(UserGet::class, 'post_penawaran',);
    }

    public function client()
    {
        return $this->belongsTo(Customer::class, 'klien_penawaran', 'id_klien');
    }

    public function judulTraining()
    {
        return $this->belongsTo(JudulTraining::class, 'judul_penawaran', 'id_judul');
    }
}