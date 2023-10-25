<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'status',
    ];

    protected $table = 'qualification';

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_qualification', 'qualification_id', 'user_id');
    }
}
