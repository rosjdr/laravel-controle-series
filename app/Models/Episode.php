<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    public $timestamps = false; //não vai gravar os timestamps de episódios... também removeu da migration

    public function season(){
        return $this->belongsTo(Season::class);
    }
}
