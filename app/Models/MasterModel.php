<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Genero;

class MasterModel extends Model
{
    use HasFactory;
    protected $table = 'master';
    protected $primary_key = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nome',
        'arte_marcial',
        'nacionalidade',
        'genero',
        'altura',
        'peso',
        'id_fighter',
    ];
    protected $casts = [
        'genero' => Genero::class
    ];
    public function fighter(){
        return $this->hasMany(FighterModel::class,'id_fighter','id');
    }
}