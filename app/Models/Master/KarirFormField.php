<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KarirFormField extends Model
{
    use HasFactory;
    protected $table = 'master_karir_form_field';
    protected $guarded = [];
    protected $casts = [
        'is_required' => 'boolean',
    ];

    public function karir()
    {
        return $this->belongsTo(Karir::class, 'karir_id');
    }

    public function optionList(): array
    {
        return $this->options
            ? array_values(array_filter(array_map('trim', explode("\n", $this->options))))
            : [];
    }
}
