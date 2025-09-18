<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payement extends Model
{
    protected $fillable = [
        'montant_lettre',
        'montant_chiffre',
        'code_type',
        'code_inscription',
        'date_payement'
    ];

    public function typeFrais()
    {
        return $this->belongsTo(Type_frais::class, 'code_type');
    }

    public function inscription()
    {
        return $this->belongsTo(Inscription::class, 'code_inscription');
    }
}
