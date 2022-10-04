<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Genero;

class MasterModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'master';
    protected $primaryKey = 'id';
    // protected $foreignKeys = ['fighter' => 'id_fighter'];
    protected $fillable = ['nome','arte_marcial','nacionalidade','genero','altura','peso','id_fighter'];
    protected $casts = ['genero' => Genero::class];

    public function fighter(){
        return $this->hasOne(FighterModel::class,'id','id_fighter');
    }
}