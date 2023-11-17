<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrasi extends Model
{
    use HasFactory;
    protected $table = 'administrasi';
    protected $primaryKey = 'administrasi_id';
    protected $fillable = ['kebutuhan_id',    'urgenci',    'kategori',    'progres'];
    public $timestamps = true;

    public function JoinToKebutuhan()
    {
        return $this->hasMany(Kebutuhan::class, 'kebutuhan_id', 'kebutuhan_id');
    }
}
