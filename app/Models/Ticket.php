<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    // Fillable প্রোপার্টি, যেগুলো mass assignment এর জন্য সুরক্ষিত
    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
        'agent_id',
    ];

    // সম্পর্কিত মেসেজগুলির জন্য ফাংশন
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    
}

