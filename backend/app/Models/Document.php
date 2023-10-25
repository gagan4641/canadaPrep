<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'status', 'common',
    ];

    protected $table = 'documents';

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_document');
    }

    public function qualifications()
    {
        return $this->belongsToMany(Qualification::class, 'document_qualification', 'document_id', 'qualification_id');
    }

    public function experiences()
    {
        return $this->belongsToMany(Experience::class, 'experience_document');
    }

    public function maritalStatuses()
    {
        return $this->belongsToMany(MaritalStatus::class, 'marital_status_document');
    }
}
