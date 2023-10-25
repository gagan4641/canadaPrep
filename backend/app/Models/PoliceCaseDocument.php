<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliceCaseDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
    ];

    protected $table = 'police_case_document';

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }
}
