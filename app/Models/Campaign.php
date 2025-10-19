<?php
// app/Models/Campaign.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description', 
        'category',
        'location',
        'tree_type',
        'target_trees',
        'tree_price',
        'campaign_duration',
        'planting_date',
        'planting_method',
        'benefits',
        'image',
        'status',
        'current_trees',
        'total_donors',
        'user_id'
    ];

    protected $casts = [
        'planting_date' => 'date',
        'tree_price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getProgressPercentageAttribute()
    {
        if ($this->target_trees == 0) return 0;
        return round(($this->current_trees / $this->target_trees) * 100);
    }

    public function getDaysLeftAttribute()
    {
        $endDate = $this->created_at->addDays($this->campaign_duration);
        return max(0, now()->diffInDays($endDate, false));
    }

    public function getStatusBadgeAttribute()
    {
        $statuses = [
            'pending' => ['color' => 'yellow', 'text' => 'Menunggu'],
            'active' => ['color' => 'green', 'text' => 'Aktif'],
            'completed' => ['color' => 'blue', 'text' => 'Selesai'],
            'rejected' => ['color' => 'red', 'text' => 'Ditolak']
        ];

        return $statuses[$this->status] ?? $statuses['pending'];
    }

    // Accessor untuk image URL
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return Storage::url($this->image);
        }
        return null;
    }
}