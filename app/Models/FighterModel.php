<?php

namespace App\Models;

use App\Events\FighterDeletedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'url_sf',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($fighter) {
            event(new FighterDeletedEvent($fighter->id));
        });
    }
}
