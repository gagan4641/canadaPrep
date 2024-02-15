<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefusalDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id', 'document_group_id', 'status',
    ];

    protected $table = 'refusal_document';

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }

    public function documentGroup()
    {
        return $this->belongsTo(DocumentGroup::class, 'document_group_id');
    }
}
