<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    protected $table = 'visits';
    protected $guarded = [];

    public static function generateNumber()
    {
        // Ambil nomor terakhir
        $lastRecord = Visit::orderBy('vi_number', 'desc')->first();
        $lastNumber = $lastRecord ? $lastRecord->vi_number : 'VI-00000';

        // Pisahkan prefix dan angka
        $prefix = 'VI-';
        $lastNumber = (int) substr($lastNumber, strlen($prefix));

        // Tambah 1 pada angka terakhir
        $newNumber = $lastNumber + 1;

        // Format angka baru
        $newPecNumber = sprintf('%s%05d', $prefix, $newNumber);

        // Pastikan nomor yang dihasilkan tidak sama dengan yang sudah ada
        $existingRecord = Visit::where('vi_number', $newPecNumber)->exists();
        if ($existingRecord) {
            // Jika nomor sudah ada, panggil fungsi kembali untuk mencoba nomor lain
            return self::generateNumber();
        }

        return $newPecNumber;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function client()
    {
        return $this->belongsTo(Customer::class, 'client_id', 'id_klien');
    }
}
