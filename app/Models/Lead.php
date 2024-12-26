<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    // Fillable attributes for mass assignment
    protected $fillable = [
        'linkedin_link',
        'company_name',
        'contact_name',
        'name_prefix',
        'full_name',
        'first_name',
        'last_name',
        'email',
        'title_position',
        'person_location',
        'full_address',
        'company_phone',
        'company_head_count',
        'country',
        'city',
        'state',
        'tag',
        'source_link',
        'middle_name',
        'sur_name',
        'gender',
        'personal_phone',
        'employee_range',
        'company_website',
        'company_linkedin_link',
        'company_hq_address',
        'industry',
        'revenue',
        'street',
        'zip_code',
        'rating',
        'sheet_name',
        'job_link',
        'job_role',
        'checked_by',
        'review',
        'sheets_id', // Foreign key column for sheets
    ];

    // Define the relationship with the Sheets model
    public function sheet()
    {
        return $this->belongsTo(Sheet::class, 'sheets_id');
    }
}
