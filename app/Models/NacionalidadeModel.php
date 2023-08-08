<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NacionalidadeModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'nacionalidades';
    protected $primaryKey = 'id';
    protected $fillable = [
        'descricao',
    ];
}
