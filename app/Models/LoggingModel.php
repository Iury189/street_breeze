<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoggingModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'loggings';
    protected $primaryKey = 'id';
    protected $fillable = [
        'descricao_log',
        'relacao',
    ];
}
