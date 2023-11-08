<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'generate_checklist_id',
        'company',
        'position',
        'from_date',
        'to_date',
        'status',
    ];
    protected $table = 'experience';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function generateChecklist()
    {
        return $this->belongsTo(GenerateChecklist::class);
    }
}
