<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $fillable = [
        'nom',
        'postnom',
        'prenom',
        'genre',
        'email',
        'phone',
        'adresse',
        'image'
    ];
}
