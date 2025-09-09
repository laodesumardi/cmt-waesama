<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class Transparency extends Model
{
    use HasFactory;

    protected $table = 'transparency';

    protected $fillable = [
        'title',
        'description',
        'category',
        'type',
        'files',
        'data',
        'period_start',
        'period_end',
        'amount',
        'status',
        'is_featured',
        'views',
        'downloads',
        'created_by',
        'updated_by',
        'uploaded_by',
        'published_at',
    ];

    protected $casts = [
        'files' => 'array',
        'data' => 'array',
        'amount' => 'decimal:2',
        'period_start' => 'date',
        'period_end' => 'date',
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'views' => 'integer',
        'downloads' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->validateModel();
        });
    }

    public function validateModel()
    {
        $rules = [
            'title' => 'required|string|max:255',
            'category' => 'required|in:budget,procurement,project,regulation,report,other',
            'type' => 'required|in:document,data,announcement',
            'status' => 'required|in:draft,published',
            'period_start' => 'nullable|date',
            'period_end' => 'nullable|date|after_or_equal:period_start',
            'amount' => 'nullable|numeric|min:0',
            'is_featured' => 'boolean',
        ];

        $validator = Validator::make($this->attributes, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    // Relasi
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Scope
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByPeriod($query, $start, $end)
    {
        return $query->where(function($q) use ($start, $end) {
            $q->whereBetween('period_start', [$start, $end])
              ->orWhereBetween('period_end', [$start, $end])
              ->orWhere(function($q2) use ($start, $end) {
                  $q2->where('period_start', '<=', $start)
                     ->where('period_end', '>=', $end);
              });
        });
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('title', 'like', '%' . $search . '%')
              ->orWhere('description', 'like', '%' . $search . '%');
        });
    }

    // Accessor
    public function getFormattedAmountAttribute()
    {
        return $this->amount ? 'Rp ' . number_format($this->amount, 0, ',', '.') : '-';
    }

    public function getCategoryDisplayAttribute()
    {
        $categories = [
            'budget' => 'Anggaran',
            'procurement' => 'Pengadaan',
            'project' => 'Proyek',
            'regulation' => 'Peraturan',
            'report' => 'Laporan',
            'other' => 'Lainnya',
        ];

        return $categories[$this->category] ?? $this->category;
    }

    public function getTypeDisplayAttribute()
    {
        $types = [
            'document' => 'Dokumen',
            'data' => 'Data',
            'announcement' => 'Pengumuman',
        ];

        return $types[$this->type] ?? $this->type;
    }

    public function getStatusBadgeAttribute()
    {
        $statuses = [
            'published' => ['class' => 'bg-green-100 text-green-800', 'text' => 'Dipublikasikan'],
            'draft' => ['class' => 'bg-yellow-100 text-yellow-800', 'text' => 'Draft'],
            'archived' => ['class' => 'bg-gray-100 text-gray-800', 'text' => 'Diarsipkan'],
        ];

        $status = $statuses[$this->status] ?? ['class' => 'bg-gray-100 text-gray-800', 'text' => ucfirst($this->status)];
        
        return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ' . $status['class'] . '">' . $status['text'] . '</span>';
    }

    public function getPeriodDisplayAttribute()
    {
        if ($this->period_start && $this->period_end) {
            return $this->period_start->format('d/m/Y') . ' - ' . $this->period_end->format('d/m/Y');
        } elseif ($this->period_start) {
            return 'Mulai ' . $this->period_start->format('d/m/Y');
        } elseif ($this->period_end) {
            return 'Sampai ' . $this->period_end->format('d/m/Y');
        }
        
        return '-';
    }

    // Methods
    public function incrementViews()
    {
        $this->increment('views');
    }

    public function incrementDownloads()
    {
        $this->increment('downloads');
    }

    public static function getCategories()
    {
        return [
            'budget' => 'Anggaran',
            'procurement' => 'Pengadaan',
            'project' => 'Proyek',
            'regulation' => 'Regulasi',
            'report' => 'Laporan',
            'other' => 'Lainnya',
        ];
    }

    public static function getTypes()
    {
        return [
            'document' => 'Dokumen',
            'data' => 'Data',
            'announcement' => 'Pengumuman',
        ];
    }
}
