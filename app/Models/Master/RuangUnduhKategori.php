<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuangUnduhKategori extends Model
{
    use HasFactory;
    protected $table = 'master_ruang_unduh_kategori';
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(RuangUnduh::class, 'kategori_id');
    }
}
