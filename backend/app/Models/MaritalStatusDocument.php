<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaritalStatusDocument extends Model
{
    use HasFactory;

    protected $fillable = ['marital_status_id', 'document_id', 'status'];

    protected $table = 'marital_status_document';

    public function maritalStatus()
    {
        return $this->belongsTo(MaritalStatus::class);
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
