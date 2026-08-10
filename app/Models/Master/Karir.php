<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Karir extends Model
{
    use HasFactory;
    protected $table = 'master_karir';
    protected $guarded = [];

    public function formFields()
    {
        return $this->hasMany(KarirFormField::class, 'karir_id')->orderBy('sort');
    }

    public function lamarans()
    {
        return $this->hasMany(KarirLamaran::class, 'karir_id');
    }

    public static function generateSlug(string $judul, ?int $exceptId = null): string
    {
        $slug = Str::slug($judul);
        $original = $slug;
        $count = 1;

        while (
            static::where('slug', $slug)
                ->when($exceptId, fn($q) => $q->where('id', '!=', $exceptId))
                ->exists()
        ) {
            $slug = $original . '-' . $count++;
        }

        return $slug;
    }
}
