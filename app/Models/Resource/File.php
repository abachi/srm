<?php

namespace App\Models\Resource;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $table = 'files';

    protected $fillable = ['title', 'path', 'type'];

    public function scopePdf($query)
    {
        $query->where('type', 'pdf');
    }
}
