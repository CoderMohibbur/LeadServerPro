<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class SheetList extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sheet_lists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file',
        'sheet_working_date',
        'sheet_name',
        'client_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'sheet_working_date' => 'date',
    ];

    /**
     * Define a relationship with the Client model.
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
