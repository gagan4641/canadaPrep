<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonDocument extends Model
{
    use HasFactory;

    protected $table = 'common_document';

    protected $fillable = [
        'document_group_id',
        'document_id'
    ];

    public function documentGroup()
    {
        return $this->belongsTo(DocumentGroup::class);
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
