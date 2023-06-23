<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'subject',
        'event_type',
        'start_date',
        'end_date',
        'description',
        'created_at',
        'updated_at'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
