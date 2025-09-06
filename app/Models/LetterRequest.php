<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LetterRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_number',
        'letter_type',
        'applicant_name',
        'applicant_nik',
        'applicant_address',
        'applicant_phone',
        'purpose',
        'additional_data',
        'attachments',
        'status',
        'notes',
        'processed_by',
        'processed_at',
        'user_id',
    ];

    protected $casts = [
        'additional_data' => 'array',
        'attachments' => 'array',
        'processed_at' => 'datetime',
    ];

    // Auto generate request number
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($letterRequest) {
            if (empty($letterRequest->request_number)) {
                $letterRequest->request_number = 'REQ-' . date('Ymd') . '-' . Str::upper(Str::random(6));
            }
        });
    }

    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function processor()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    // Scope
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByLetterType($query, $type)
    {
        return $query->where('letter_type', $type);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeProcessed($query)
    {
        return $query->whereIn('status', ['approved', 'rejected', 'completed']);
    }

    // Accessor
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'processing' => 'bg-blue-100 text-blue-800',
            'approved' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800',
            'completed' => 'bg-gray-100 text-gray-800',
        ];

        return $badges[$this->status] ?? 'bg-gray-100 text-gray-800';
    }
}
