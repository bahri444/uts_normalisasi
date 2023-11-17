<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenanggungJawab extends Model
{
    use HasFactory;
    protected $table = 'administrasi';
    protected $primaryKey = 'administrasi_id';
    protected $fillable = ['administrasi_id',    'pic'];
    public $timestamps = true;
}
