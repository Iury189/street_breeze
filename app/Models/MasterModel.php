<?php

namespace App\Models;

use App\Events\MasterDeletedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'masters';
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

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($master) {
            event(new MasterDeletedEvent($master->id));
        });
    }
}
