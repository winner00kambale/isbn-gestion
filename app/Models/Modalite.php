<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modalite extends Model
{
    protected $fillable = [
        'code_promotion',
        'code_type',
        'montant'
    ];

     public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'code_promotion');
    }

    // 🔗 Relation avec Annee
    public function type()
    {
        return $this->belongsTo(Type_frais::class, 'code_type');
    }
}
