<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_group_id', 'title', 'status',
    ];

    protected $table = 'marital_status';

    public function generateChecklists()
    {
        return $this->hasMany(GenerateChecklist::class);
    }

    public function documentGroup()
    {
        return $this->belongsTo(DocumentGroup::class);
    }

    public function maritalStatusDocuments()
    {
        return $this->hasMany(MaritalStatusDocument::class);
    }
}
