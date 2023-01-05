<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogDeletionFKModel extends Model
{
    use HasFactory;
    protected $table = 'logs_deletions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'descricao',
        'data',
    ];
}
