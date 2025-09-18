<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = ['designation','code_option'];

    public function option()
    {
        return $this->belongsTo(Option::class, 'code_option');
    }
}
