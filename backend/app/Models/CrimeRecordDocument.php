<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrimeRecordDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id', 'document_group_id', 'status',
    ];

    protected $table = 'crime_record_document';

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }

    public function documentGroup()
    {
        return $this->belongsTo(DocumentGroup::class, 'document_group_id');
    }
}