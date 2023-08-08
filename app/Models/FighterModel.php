<?php

namespace App\Models;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use App\Events\FighterDeletedEvent;

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
        'tipo_sangue',
        'idade',
        'altura',
        'peso',
        'passaporte',
        'url_sf',
        'quantidade_vitorias',
        'quantidade_derrotas'
    ];
    // Passaporte será criptado no banco de dados
    public function setPassaporteAttribute($value)
    {
        $this->attributes['passaporte'] = Crypt::encryptString($value);
    }
    // Passaporte será decriptado na view (coluna de tablea, campo de formulário)
    public function getPassaporteAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            return $value;
        }
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($fighter) {
            event(new FighterDeletedEvent($fighter->id));
        });
    }

}
