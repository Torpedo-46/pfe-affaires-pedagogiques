<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Exam extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function names() {
        return $this->belongsTo(Module::class,'id_mod');
    }
    public function fin(){
        $dFormatted = Carbon::parse($this->deb);
        $duree = Carbon::parse($this->duree);
        return $fin = $dFormatted->copy()->addHours($duree->hour)->addMinutes($duree->minute);
    }
    public function name() {
        return $this->belongsTo(User::class,'surveillant');
    }
}
