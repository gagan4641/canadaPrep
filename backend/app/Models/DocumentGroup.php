<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentGroup extends Model
{
    use HasFactory;

    protected $table = 'document_group';

    protected $fillable = ['title', 'description', 'status'];

    public function commonDocuments()
    {
        return $this->hasMany(CommonDocument::class);
    }

    public function qualifications()
    {
        return $this->hasMany(Qualification::class, 'document_group_id');
    }

    public function workExperienceDocuments()
    {
        return $this->hasMany(WorkExperienceDocument::class);
    }

    public function maritalStatuses()
    {
        return $this->hasMany(MaritalStatus::class);
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
