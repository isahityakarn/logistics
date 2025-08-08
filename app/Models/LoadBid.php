<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoadBid extends Model
{
    protected $table = 'load_bid';
    
    protected $fillable = [
        'logisticjob_id',
        'driver_id',
        'price',
        'status'
    ];

    protected $casts = [
        'price' => 'decimal:2'
    ];

    public function logisticsJob(): BelongsTo
    {
        return $this->belongsTo(LogisticsLoad::class, 'logisticjob_id');
    }

    public function logisticsLoad(): BelongsTo
    {
        return $this->belongsTo(LogisticsLoad::class, 'logisticjob_id');
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
