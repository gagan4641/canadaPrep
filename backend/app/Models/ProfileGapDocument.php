<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileGapDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'document_group_id',
        'status',
    ];

    protected $table = 'profile_gap_document';

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function documentGroup()
    {
        return $this->belongsTo(DocumentGroup::class);
    }
}
