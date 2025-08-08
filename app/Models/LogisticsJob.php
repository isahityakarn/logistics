<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LogisticsJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        // Pickup Information
        'pickup_location',
        'pickup_phone',
        'pickup_company',
        'pickup_additional_info',
        'pickup_latitude',
        'pickup_longitude',
        'pickup_date_time_from',
        'pickup_date_time_to',
        'pickup_info',
        // Delivery Information
        'delivery_location',
        'delivery_phone',
        'delivery_company',
        'delivery_additional_info',
        'delivery_latitude',
        'delivery_longitude',
        'delivery_date_time_from',
        'delivery_date_time_to',
        'delivery_info',
        // Job Details
        'job_description',
        'suggested_vehicle',
        'packaging',
        'no_of_items',
        'gross_weight',
        'weight_unit',
        'body_type',
        'job_type',
        // Package Information
        'length',
        'width',
        'height',
        'dimension_unit',
        // Additional Information
        'notes',
        'document_name',
        'upload_document',
        // Distance and Pricing
        'distance_km',
        'distance_miles',
        'rate_per_km',
        'rate_per_mile',
        'currency',
        // Status and Tracking
        'status',
        'assigned_at',
        'completed_at',
    ];

    protected $casts = [
        'pickup_date_time_from' => 'datetime',
        'pickup_date_time_to' => 'datetime',
        'delivery_date_time_from' => 'datetime',
        'delivery_date_time_to' => 'datetime',
        'assigned_at' => 'datetime',
        'completed_at' => 'datetime',
        'pickup_latitude' => 'decimal:8',
        'pickup_longitude' => 'decimal:8',
        'delivery_latitude' => 'decimal:8',
        'delivery_longitude' => 'decimal:8',
        'gross_weight' => 'decimal:2',
        'length' => 'decimal:2',
        'width' => 'decimal:2',
        'height' => 'decimal:2',
        'distance_km' => 'decimal:2',
        'distance_miles' => 'decimal:2',
        'rate_per_km' => 'decimal:2',
        'rate_per_mile' => 'decimal:2',
    ];

    // Relationships
    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function prices(): HasMany
    {
        return $this->hasMany(LogisticsJobPrice::class, 'logisticjob_id');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeAssigned($query)
    {
        return $query->where('status', 'assigned');
    }

    public function scopeInProgress($query)
    {
        return $query->whereIn('status', ['in_progress', 'picked_up', 'in_transit']);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // Helper methods
    public function isAssigned(): bool
    {
        return !is_null($this->driver_id);
    }

    public function canBeAssigned(): bool
    {
        return $this->status === 'pending' && is_null($this->driver_id);
    }

    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            'pending' => 'bg-warning',
            'assigned' => 'bg-info',
            'in_progress' => 'bg-primary',
            'picked_up' => 'bg-success',
            'in_transit' => 'bg-success',
            'delivered' => 'bg-success',
            'completed' => 'bg-success',
            'cancelled' => 'bg-danger',
            default => 'bg-secondary',
        };
    }

    public function getFormattedStatus(): string
    {
        return ucwords(str_replace('_', ' ', $this->status));
    }
}
