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
        'user_id',
        'farmer_plant_id',
        'trees_from_farmer'
    ];

    protected $casts = [
        'planting_date' => 'date',
        'tree_price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function paidDonations()
    {
        return $this->hasMany(Donation::class)->where('status', 'paid');
    }

    public function farmerPlant()
    {
        return $this->belongsTo(FarmerPlant::class, 'farmer_plant_id');
    }

    public function orders()
    {
        return $this->hasMany(FarmerPlantOrder::class);
    }

    public function getProgressPercentageAttribute()
    {
        if (empty($this->target_trees) || $this->target_trees <= 0) {
            return 0;
        }

        $percentage = round(($this->current_trees / $this->target_trees) * 100);

        // Clamp to 0-100 to avoid negative or overflow values
        $percentage = (int) max(0, min(100, $percentage));

        return $percentage;
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