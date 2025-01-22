<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LedFilter extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'led_filters';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
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
        'sheets_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
