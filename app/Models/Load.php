<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Load extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'driver_id',
        'pickup_location',
        'pickup_phone',
        'pickup_company',
        'pickup_additional_info',
        'pickup_latitude',
        'pickup_longitude',
        'pickup_date_time_from',
        'pickup_date_time_to',
        'pickup_info',
        'delivery_location',
        'delivery_phone',
        'delivery_company',
        'delivery_additional_info',
        'delivery_latitude',
        'delivery_longitude',
        'delivery_date_time_from',
        'delivery_date_time_to',
        'delivery_info',
        'job_description',
        'suggested_vehicle',
        'packaging',
        'no_of_items',
        'gross_weight',
        'weight_unit',
        'body_type',
        'job_type',
        'length',
        'width',
        'height',
        'dimension_unit',
        'notes',
        'document_name',
        'upload_document',
        'distance_km',
        'distance_miles',
        'rate_per_km',
        'rate_per_mile',
        'currency',
        'status',
        'assigned_at',
        'completed_at',
    ];
    /**
     * Get all bids for this load.
     */
    public function bids()
    {
        return $this->hasMany(\App\Models\Bid::class, 'load_id');
    }
}
