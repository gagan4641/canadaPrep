<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildrenDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
    ];

    protected $table = 'children_document';

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }
}
