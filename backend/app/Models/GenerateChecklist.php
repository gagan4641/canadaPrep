<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenerateChecklist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'dob',
        'crime_record',
        'category_id',
        'country_id',
        'marital_status_id',
    ];

    // Define the Category relationship (many-to-one)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Define the Country relationship (many-to-one)
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // Define the MaritalStatus relationship (many-to-one)
    public function maritalStatus()
    {
        return $this->belongsTo(MaritalStatus::class);
    }
}
