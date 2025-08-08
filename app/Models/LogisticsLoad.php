<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LogisticsLoad extends Model
{
    use HasFactory;

    protected $table = 'logistics_load';

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
        'company_id'
    ];

    protected $casts = [
        'pickup_date_time_from' => 'datetime',
        'pickup_date_time_to' => 'datetime',
        'delivery_date_time_from' => 'datetime',
        'delivery_date_time_to' => 'datetime',
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
        'assigned_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    /**
     * Get the company that created this logistics load.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    /**
     * Get the driver assigned to this logistics load.
     */
    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    /**
     * Get the load bids for this logistics load.
     */
    public function loadBids(): HasMany
    {
        return $this->hasMany(LoadBid::class, 'logisticjob_id');
    }

    /**
     * Scope a query to only include loads for a specific company.
     */
    public function scopeForCompany($query, $companyId)
    {
        return $query->where('company_id', $companyId);
    }

    /**
     * Scope a query to only include loads assigned to a specific driver.
     */
    public function scopeForDriver($query, $driverId)
    {
        return $query->where('driver_id', $driverId);
    }

    /**
     * Get the formatted pickup date range.
     */
    public function getPickupDateRangeAttribute()
    {
        if ($this->pickup_date_time_from && $this->pickup_date_time_to) {
            return $this->pickup_date_time_from->format('M d, Y H:i') . ' - ' . $this->pickup_date_time_to->format('H:i');
        }
        return $this->pickup_date_time_from?->format('M d, Y H:i') ?? 'Not specified';
    }

    /**
     * Get the formatted delivery date range.
     */
    public function getDeliveryDateRangeAttribute()
    {
        if ($this->delivery_date_time_from && $this->delivery_date_time_to) {
            return $this->delivery_date_time_from->format('M d, Y H:i') . ' - ' . $this->delivery_date_time_to->format('H:i');
        }
        return $this->delivery_date_time_from?->format('M d, Y H:i') ?? 'Not specified';
    }

    /**
     * Get the total weight with unit.
     */
    public function getFormattedWeightAttribute()
    {
        return $this->gross_weight ? $this->gross_weight . ' ' . $this->weight_unit : 'Not specified';
    }

    /**
     * Get the dimensions formatted string.
     */
    public function getFormattedDimensionsAttribute()
    {
        if ($this->length && $this->width && $this->height) {
            return $this->length . ' × ' . $this->width . ' × ' . $this->height . ' ' . $this->dimension_unit;
        }
        return 'Not specified';
    }

    /**
     * Get the distance with preferred unit.
     */
    public function getFormattedDistanceAttribute()
    {
        if ($this->distance_km) {
            return $this->distance_km . ' km';
        } elseif ($this->distance_miles) {
            return $this->distance_miles . ' miles';
        }
        return 'Not specified';
    }

    /**
     * Check if the load can be accepted by a driver.
     */
    public function canBeAccepted()
    {
        return $this->status === 'pending' && !$this->driver_id;
    }

    /**
     * Check if the load is assigned to a driver.
     */
    public function isAssigned()
    {
        return $this->driver_id && in_array($this->status, ['assigned', 'in_progress', 'picked_up', 'in_transit']);
    }

    /**
     * Check if the load is completed.
     */
    public function isCompleted()
    {
        return in_array($this->status, ['delivered', 'completed']);
    }

    /**
     * Get the appropriate Bootstrap badge class for the load status.
     */
    public function getStatusBadgeClass()
    {
        return match($this->status) {
            'pending' => 'badge bg-warning text-dark',
            'assigned' => 'badge bg-info text-white',
            'in_progress' => 'badge bg-primary text-white',
            'picked_up' => 'badge bg-secondary text-white',
            'in_transit' => 'badge bg-primary text-white',
            'delivered' => 'badge bg-success text-white',
            'completed' => 'badge bg-success text-white',
            'cancelled' => 'badge bg-danger text-white',
            default => 'badge bg-light text-dark',
        };
    }

    /**
     * Get the formatted status text for display.
     */
    public function getFormattedStatus()
    {
        return match($this->status) {
            'pending' => 'Pending',
            'assigned' => 'Assigned',
            'in_progress' => 'In Progress',
            'picked_up' => 'Picked Up',
            'in_transit' => 'In Transit',
            'delivered' => 'Delivered',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            default => ucfirst($this->status),
        };
    }
}
