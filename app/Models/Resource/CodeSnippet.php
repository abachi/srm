<?php

namespace App\Models\Resource;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeSnippet extends Model
{
    use HasFactory;

    protected $table = 'code_snippets';

    protected $fillable = ['title', 'code_snippet', 'description', 'type'];

    public function scopeHtml($query)
    {
        $query->where('type', 'html');
    }

}
