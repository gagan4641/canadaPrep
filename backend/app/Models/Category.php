<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'status',
    ];

    protected $table = 'category';

    public function documents()
    {
        return $this->belongsToMany(Document::class, 'category_document');
    }

    public function generateChecklists()
    {
        return $this->hasMany(GenerateChecklist::class);
    }
}
