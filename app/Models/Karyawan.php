<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $connection = 'mysql_THRE';
    protected $table = 'users';
    protected $guarded = [];
}
