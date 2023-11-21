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
}
