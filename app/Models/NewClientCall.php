<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewClientCall extends Model
{
    use HasFactory;
    protected $table = 'new_client_calls';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function client()
    {
        return $this->belongsTo(Customer::class, 'client_id', 'id_klien');
    }
}
