<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'user_id',
        'campaign_id',
        'amount',
        'trees_count',
        'xendit_invoice_id',
        'external_id',
        'status',
        'donor_name',
        'donor_email',
        'message',
        'paid_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->nullable();
    }
}
