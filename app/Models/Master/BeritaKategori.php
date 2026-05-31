<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaKategori extends Model
{
    use HasFactory;
    protected $table = 'master_berita_kategori';
    protected $guarded = [];

    public function beritas()
    {
        return $this->hasMany(Berita::class, 'kategori_id');
    }
}
