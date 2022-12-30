<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Genero;

class FighterModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'fighters';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nome',
        'arte_marcial',
        'nacionalidade',
        'genero',
        'idade',
        'altura',
        'peso',
        'passaporte',
    ];
}
