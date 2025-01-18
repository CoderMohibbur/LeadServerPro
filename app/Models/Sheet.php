<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;  // Make sure this line is added

class Sheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'file', 'sheet_working_date', 'sheet_name', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
