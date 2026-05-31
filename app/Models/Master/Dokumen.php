<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;
    protected $table = 'master_dokumen';
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(DokumenKategori::class, 'kategori_id');
    }
}
