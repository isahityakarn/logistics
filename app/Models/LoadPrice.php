<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoadBid extends Model
{
    protected $table = 'load_bid';
    
    protected $fillable = [
        'logisticjob_id',
        'company_id',
        'price',
        'status'
    ];

    protected $casts = [
        'price' => 'decimal:2'
    ];

    public function logisticsJob(): BelongsTo
    {
        return $this->belongsTo(LogisticsJob::class, 'logisticjob_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(User::class, 'company_id');
    }
}
