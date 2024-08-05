<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGet extends Model
{
    use HasFactory;

    protected $connection = 'mysql_SECOND';
    protected $table = 'user';
    protected $guarded = [];

    public function user()
    {
        return $this->hasMany(Customer::class);
    }
}
