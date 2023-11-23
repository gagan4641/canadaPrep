<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'status', 'description',
    ];

    protected $table = 'document';

    public function qualifications()
    {
        return $this->hasMany(QualificationDocument::class, 'document_id');
    }

    public function commonDocuments()
    {
        return $this->hasMany(CommonDocument::class);
    }

    public function workExperienceDocuments()
    {
        return $this->hasMany(WorkExperienceDocument::class);
    }

    public function maritalStatusDocuments()
    {
        return $this->hasMany(MaritalStatusDocument::class);
    }
}
