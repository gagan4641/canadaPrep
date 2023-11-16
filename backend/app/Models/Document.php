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
        return $this->belongsToMany(Qualification::class, 'document_qualification', 'document_id', 'qualification_id');
    }

    public function maritalStatuses()
    {
        return $this->belongsToMany(MaritalStatus::class, 'marital_status_document');
    }

    public function commonDocuments()
    {
        return $this->hasMany(CommonDocument::class);
    }
}
