<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    protected $fillable = [
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

    public function payements()
    {
        return $this->hasMany(Payement::class, 'code_inscription');
    }

    public function modalites()
    {
        return $this->hasMany(Modalite::class, 'code_promotion', 'code_promotion');
    }
}
