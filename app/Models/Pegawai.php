<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $table = 'pegawai';
    protected $primaryKey = 'pegawai_id';
    protected $fillable = ['bagian_id', 'nama', 'kontak_wa'];
    public $timestamps = true;

    // join ke tabel bagian
    public function JoinToBagian()
    {
        return $this->hasOne(Bagian::class, 'bagian_id', 'bagian_id');
    }
}
