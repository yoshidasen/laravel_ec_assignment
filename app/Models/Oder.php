<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oder extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function oder_status() {
        return $this->belongsTo('App\Models\OderStatus');
    }
}
