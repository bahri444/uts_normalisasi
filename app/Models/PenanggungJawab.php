<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenanggungJawab extends Model
{
    use HasFactory;
    protected $table = 'penanggung_jawab';
    protected $primaryKey = 'penanggungjawab_id';
    protected $fillable = ['administrasi_id',    'pic'];
    public $timestamps = true;

    public function JoinToAdministrasi()
    {
        return $this->hasMany(Administrasi::class, 'administrasi_id', 'administrasi_id');
    }
}
