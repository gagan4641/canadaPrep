<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'status',
    ];

    protected $table = 'marital_statuses';

    public function documents()
    {
        return $this->belongsToMany(Document::class, 'marital_status_document');
    }
}
