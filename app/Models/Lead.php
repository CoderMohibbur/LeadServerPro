<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'linkedin_link',
        'company_name',
        'contact_name',
        'email',
        'title_position',
        'person_location',
        'full_address',
    ];
}
