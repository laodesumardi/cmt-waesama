<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VillageInfo extends Model
{
    protected $fillable = [
        'title',
        'type',
        'description',
        'image_path',
        'is_featured',
        'created_by',
        // Legacy fields
        'name',
        'vision',
        'mission',
        'address',
        'phone',
        'email',
        'area',
        'population'
    ];

    protected $casts = [
        'population' => 'integer',
        'is_featured' => 'boolean'
    ];

    /**
     * Get the user who created this village info.
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
