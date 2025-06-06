<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proprietario extends Model
{
    protected $table = 'proprietarios';
    protected $fillable = [
        'nome',
        'sigla',
        'descricao',
        'logo',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
