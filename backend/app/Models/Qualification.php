<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;

    protected $table = 'qualification';

    protected $fillable = [
        'title', 'status', 'created_at', 'updated_at'
    ];

    public function documents()
    {
        return $this->hasMany(QualificationDocument::class, 'qualification_id');
    }

    public function generateChecklists()
    {
        return $this->belongsToMany(GenerateChecklist::class, 'generate_checklist_qualification')
            ->withPivot('completion_year');
    }

    public function documentGroup()
    {
        return $this->belongsTo(DocumentGroup::class, 'document_group_id');
    }
}
