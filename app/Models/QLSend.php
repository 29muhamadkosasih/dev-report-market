<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QLSend extends Model
{
    use HasFactory;
    protected $table = 'ql_sends';
    protected $guarded = [];

    protected $with = [
        'noQL',
        'user',
    ];

    public function noQL()
    {
        return $this->belongsTo(Quotation::class, 'no_ql_id', 'id_penawaran');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
