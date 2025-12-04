<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FarmerPlantOrder extends Model
{
    use HasFactory;

    protected $table = 'farmer_plant_orders';

    protected $fillable = [
        'farmer_id',
        'farmer_plant_id',
        'campaign_id',
        'donation_id',
        'quantity',
        'remaining_stock',
        'status',
        'notes',
        'plant_type_id',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'remaining_stock' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship: Order belongs to Farmer
     */
    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }

    /**
     * Relationship: Order belongs to FarmerPlant
     */
    public function farmerPlant()
    {
        return $this->belongsTo(FarmerPlant::class, 'farmer_plant_id');
    }

    /**
     * Relationship: Order belongs to Campaign
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    /**
     * Relationship: Order belongs to Donation
     */
    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }

    /**
     * Scope: Get pending orders
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope: Get confirmed orders
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Scope: Get completed orders
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope: Get orders by farmer
     */
    public function scopeByFarmer($query, $farmerId)
    {
        return $query->where('farmer_id', $farmerId);
    }

    /**
     * Mark order as confirmed
     */
    public function markAsConfirmed()
    {
        $this->status = 'confirmed';
        $this->save();
        return $this;
    }

    /**
     * Mark order as completed
     */
    public function markAsCompleted()
    {
        $this->status = 'completed';
        $this->save();
        return $this;
    }

    /**
     * Cancel order and restore stock
     */
    public function cancel()
    {
        if ($this->status !== 'cancelled') {
            // Restore stock
            $this->farmerPlant->increment('stok', $this->quantity);
            $this->status = 'cancelled';
            $this->save();
        }
        return $this;
    }

    /**
     * Mark order as paid
     */
    public function markAsPaid()
    {
        $this->status = 'paid';
        $this->save();
        return $this;
    }
}
