<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'type',
        'address',
        'postal_code',
        'head_name',
        'head_phone',
        'head_email',
        'profile',
        'demographics',
        'programs',
        'budget',
        'map_coordinates',
        'area_size',
        'population',
        // New fields for staff management
        'district',
        'regency',
        'province',
        'area',
    ];

    protected $casts = [
        'demographics' => 'array',
        'programs' => 'array',
        'budget' => 'decimal:2',
        'area_size' => 'decimal:2',
        'area' => 'decimal:2',
        'population' => 'integer',
    ];

    // Scope
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByCode($query, $code)
    {
        return $query->where('code', $code);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('code', 'like', '%' . $search . '%')
              ->orWhere('head_name', 'like', '%' . $search . '%');
        });
    }

    // Accessor
    public function getFormattedBudgetAttribute()
    {
        return $this->budget ? 'Rp ' . number_format($this->budget, 0, ',', '.') : '-';
    }

    public function getFormattedAreaSizeAttribute()
    {
        return $this->area_size ? number_format($this->area_size, 2, ',', '.') . ' km²' : '-';
    }

    public function getFormattedPopulationAttribute()
    {
        return $this->population ? number_format($this->population, 0, ',', '.') . ' jiwa' : '-';
    }

    public function getTypeDisplayAttribute()
    {
        $types = [
            'desa' => 'Desa',
            'kelurahan' => 'Kelurahan',
        ];

        return $types[$this->type] ?? $this->type;
    }
}
