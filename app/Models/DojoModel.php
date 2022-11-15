<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DojoModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'dojos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'fighter_id',
        'master_id'
    ];

    public function fighter(){
        return $this->hasOne(FighterModel::class,'id','fighter_id');
    }

    public function master(){
        return $this->hasOne(MasterModel::class,'id','master_id');
    }
}