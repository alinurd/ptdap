<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KarirLamaran extends Model
{
    use HasFactory;
    protected $table = 'master_karir_lamaran';
    protected $guarded = [];

    public function karir()
    {
        return $this->belongsTo(Karir::class, 'karir_id');
    }

    public function jawaban()
    {
        return $this->hasMany(KarirLamaranJawaban::class, 'lamaran_id');
    }
}
