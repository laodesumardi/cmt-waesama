<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_number',
        'complainant_name',
        'complainant_email',
        'complainant_phone',
        'complainant_address',
        'subject',
        'description',
        'category',
        'priority',
        'attachments',
        'status',
        'response',
        'assigned_to',
        'responded_at',
        'user_id',
    ];

    protected $casts = [
        'attachments' => 'array',
        'responded_at' => 'datetime',
    ];

    // Auto generate ticket number
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($complaint) {
            if (empty($complaint->ticket_number)) {
                $complaint->ticket_number = 'TKT-' . date('Ymd') . '-' . Str::upper(Str::random(6));
            }
        });
    }

    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Scope
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }

    public function scopeAssigned($query)
    {
        return $query->whereNotNull('assigned_to');
    }

    public function scopeUnassigned($query)
    {
        return $query->whereNull('assigned_to');
    }

    // Accessor
    public function getStatusBadgeAttribute()
    {
        $statuses = [
            'open' => ['class' => 'bg-red-100 text-red-800', 'text' => 'Terbuka'],
            'in_progress' => ['class' => 'bg-yellow-100 text-yellow-800', 'text' => 'Sedang Diproses'],
            'resolved' => ['class' => 'bg-green-100 text-green-800', 'text' => 'Selesai'],
            'closed' => ['class' => 'bg-gray-100 text-gray-800', 'text' => 'Ditutup'],
        ];

        $status = $statuses[$this->status] ?? ['class' => 'bg-gray-100 text-gray-800', 'text' => ucfirst($this->status)];
        
        return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ' . $status['class'] . '">' . $status['text'] . '</span>';
    }

    public function getPriorityBadgeAttribute()
    {
        $priorities = [
            'low' => ['class' => 'bg-blue-100 text-blue-800', 'text' => 'Rendah'],
            'medium' => ['class' => 'bg-yellow-100 text-yellow-800', 'text' => 'Sedang'],
            'high' => ['class' => 'bg-red-100 text-red-800', 'text' => 'Tinggi'],
            'urgent' => ['class' => 'bg-purple-100 text-purple-800', 'text' => 'Mendesak'],
        ];

        $priority = $priorities[$this->priority] ?? ['class' => 'bg-gray-100 text-gray-800', 'text' => ucfirst($this->priority)];
        
        return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ' . $priority['class'] . '">' . $priority['text'] . '</span>';
    }
}
