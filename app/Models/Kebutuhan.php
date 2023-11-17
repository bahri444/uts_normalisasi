<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kebutuhan extends Model
{
    use HasFactory;
    protected $table = 'kebutuhan';
    protected $primaryKey = 'kebutuhan_id';
    protected $fillable = ['pegawai_id',    'jenis_kebutuhan',    'kebutuhan_tentang',    'deskripsi_kebutuhan',    'foto_video'];
    public $timestamps = true;

    public function JoinToPegawai()
    {
        return $this->hasMany(Pegawai::class, 'pegawai_id', 'pegawai_id');
    }
}
