<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperienceDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'document_group_id',
        'status',
    ];

    protected $table = 'work_experience_document';

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function documentGroup()
    {
        return $this->belongsTo(DocumentGroup::class);
    }
}
