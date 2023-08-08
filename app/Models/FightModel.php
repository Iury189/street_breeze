<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FightModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'fights';
    protected $primaryKey = 'id';
    protected $fillable = [
        'fighter1_id',
        'fighter2_id',
        'vencedor',
    ];

    public function fighter1(){
        return $this->hasOne(FighterModel::class,'id','fighter1_id');
    }
    public function fighter2(){
        return $this->hasOne(FighterModel::class,'id','fighter2_id');
    }
}
