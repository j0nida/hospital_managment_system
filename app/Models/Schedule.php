<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo("App\Models\User");
    }
    public function shift(){
        return $this->belongsTo("App\Models\Shift");
    }
}
