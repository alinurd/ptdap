<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KarirLamaranJawaban extends Model
{
    use HasFactory;
    protected $table = 'master_karir_lamaran_jawaban';
    protected $guarded = [];

    public function lamaran()
    {
        return $this->belongsTo(KarirLamaran::class, 'lamaran_id');
    }

    public function formField()
    {
        return $this->belongsTo(KarirFormField::class, 'karir_form_field_id');
    }
}
