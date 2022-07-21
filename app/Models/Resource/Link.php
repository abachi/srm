<?php

namespace App\Models\Resource;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $table = 'links';
    protected $fillable = ['title', 'link', 'open_new_tab'];
    protected $casts = [
        'open_new_tab' => 'boolean'
    ];
}
