<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuangUnduh extends Model
{
    use HasFactory;
    protected $table = 'master_ruang_unduh';
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(RuangUnduhKategori::class, 'kategori_id');
    }
}
