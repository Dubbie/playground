<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoredFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'name',
        'size',
        'type',
    ];

    protected $appends = [
        'download_link',
    ];

    protected function downloadLink(): Attribute
    {
        return Attribute::make(
            get: fn () => route('file.download', $this->id)
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
