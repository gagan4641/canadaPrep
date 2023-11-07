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
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_qualification', 'qualification_id', 'user_id');
    }
    
    public function documents()
    {
        return $this->belongsToMany(Document::class, 'document_qualification', 'qualification_id', 'document_id');
    }
}
