<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClasseModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'classe';
    protected $primaryKey = 'id';
    protected $fillable = ['id_fighter','id_master'];

    public function fighter(){
        return $this->hasOne(FighterModel::class,'id','id_fighter');
    }

    public function master(){
        return $this->hasOne(MasterModel::class,'id','id_master');
    }
}