<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'autor',
        'numero_registro',
        'situacao',
        'genero_id'
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genero_id');
    }

    public function loans()
    {
        return $this->hasMany(Loans::class);
    }
}
