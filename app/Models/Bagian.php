<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    use HasFactory;
    protected $table = 'bagian';
    protected $primaryKey = 'bagian_id';
    protected $fillable = ['bagian'];
    public $timestamps = true;
}
