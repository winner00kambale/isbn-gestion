<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    protected $fillable =[
        'code_etudiant',
        'code_promotion',
        'code_annee'
    ];
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'code_etudiant');
    }

    // 🔗 Relation avec Promotion
    public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'code_promotion');
    }

    // 🔗 Relation avec Annee
    public function annee()
    {
        return $this->belongsTo(Annee::class, 'code_annee');
    }
}
