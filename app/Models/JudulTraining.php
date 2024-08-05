<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JudulTraining extends Model
{
    use HasFactory;
    protected $connection = 'mysql_SECOND';
    protected $table = 'judul';
    protected $guarded = [];

    public function sertifikasi()
    {
        return $this->belongsTo(Sertifikasi::class, 'paket_judul', 'id_paket');
    }
}
