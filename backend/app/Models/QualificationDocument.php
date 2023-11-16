<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualificationDocument extends Model
{
    use HasFactory;

    protected $table = 'qualification_document';

    protected $fillable = [
        'qualification_id',
        'document_id'
    ];
}
