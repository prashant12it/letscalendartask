<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CampaignAttendees extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'campaign_id',
        'invite_sent',
        'invite_sent_at',
        'created_at',
        'updated_at'
    ];
    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class,'campaign_id');
    }
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
