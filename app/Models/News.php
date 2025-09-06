<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'gallery_images',
        'category',
        'status',
        'is_featured',
        'views',
        'author_id',
        'published_at',
        'meta_title',
        'meta_description',
        'tags',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
        'gallery_images' => 'array',
        'tags' => 'array',
    ];

    // Auto generate slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
        });
    }

    // Relasi
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Scope
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Static methods
    public static function getCategories()
    {
        return [
            'umum' => 'Umum',
            'pengumuman' => 'Pengumuman',
            'kegiatan' => 'Kegiatan',
            'pembangunan' => 'Pembangunan',
            'sosial' => 'Sosial',
            'ekonomi' => 'Ekonomi',
            'kesehatan' => 'Kesehatan',
            'pendidikan' => 'Pendidikan',
            'lingkungan' => 'Lingkungan',
            'budaya' => 'Budaya'
        ];
    }

    public static function getStatuses()
    {
        return [
            'draft' => 'Draft',
            'published' => 'Published',
            'archived' => 'Archived'
        ];
    }
}
