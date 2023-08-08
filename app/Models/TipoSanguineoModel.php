<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoSanguineoModel extends Model
{
    use HasFactory;
    protected $table = 'tipos_sanguineos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'descricao',
    ];
}
