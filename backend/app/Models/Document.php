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

    public function ChildrenDocuments()
    {
        return $this->hasMany(ChildrenDocument::class);
    }

    public function CrimeRecordDocuments()
    {
        return $this->hasMany(CrimeRecordDocument::class);
    }

    public function RefusalDocuments()
    {
        return $this->hasMany(RefusalDocument::class);
    }

    public function ProfileGapDocuments()
    {
        return $this->hasMany(ProfileGapDocument::class);
    }

    public function LanguageTestDocuments()
    {
        return $this->hasMany(LanguageTestDocument::class);
    }
}
