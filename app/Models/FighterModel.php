<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\GeneroFighter;

class FighterModel extends Model
{
    use HasFactory;
    protected $table = 'fighter';
    protected $primary_key = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nome',
        'arte_marcial',
        'nacionalidade',
        'genero',
        'altura',
        'peso',
    ];
    protected $casts = [
        'genero' => GeneroFighter::class
    ];
}