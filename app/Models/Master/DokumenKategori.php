<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenKategori extends Model
{
    use HasFactory;
    protected $table = 'master_dokumen_kategori';
    protected $guarded = [];

    public function dokumens()
    {
        return $this->hasMany(Dokumen::class, 'kategori_id');
    }
}
