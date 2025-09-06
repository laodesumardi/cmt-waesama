<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'document_type',
        'purpose',
        'applicant_name',
        'applicant_nik',
        'applicant_phone',
        'applicant_address',
        'additional_data',
        'status',
        'notes',
        'processed_by',
        'processed_at',
        'completed_at',
        'rejection_reason'
    ];

    protected $casts = [
        'additional_data' => 'array',
        'processed_at' => 'datetime',
        'completed_at' => 'datetime'
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETED = 'completed';
    const STATUS_REJECTED = 'rejected';

    const DOCUMENT_TYPES = [
        'ktp' => 'Kartu Tanda Penduduk (KTP)',
        'kk' => 'Kartu Keluarga (KK)',
        'akta_lahir' => 'Akta Kelahiran',
        'akta_mati' => 'Akta Kematian',
        'surat_pindah' => 'Surat Pindah',
        'surat_domisili' => 'Surat Keterangan Domisili',
        'surat_usaha' => 'Surat Keterangan Usaha',
        'surat_tidak_mampu' => 'Surat Keterangan Tidak Mampu',
        'surat_belum_menikah' => 'Surat Keterangan Belum Menikah',
        'surat_penghasilan' => 'Surat Keterangan Penghasilan'
    ];

    public static function getDocumentTypes()
    {
        return self::DOCUMENT_TYPES;
    }

    /**
     * Get the user that owns the document request.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the staff who processed the request.
     */
    public function processor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    /**
     * Get the status badge color.
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => 'yellow',
            self::STATUS_PROCESSING => 'blue',
            self::STATUS_COMPLETED => 'green',
            self::STATUS_REJECTED => 'red',
            default => 'gray'
        };
    }

    /**
     * Get the status label.
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            self::STATUS_PENDING => 'Menunggu',
            self::STATUS_PROCESSING => 'Diproses',
            self::STATUS_COMPLETED => 'Selesai',
            self::STATUS_REJECTED => 'Ditolak',
            default => 'Tidak Diketahui'
        };
    }

    /**
     * Get the document type label.
     */
    public function getDocumentTypeLabelAttribute(): string
    {
        return self::DOCUMENT_TYPES[$this->document_type] ?? $this->document_type;
    }

    /**
     * Scope for filtering by status.
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope for filtering by document type.
     */
    public function scopeByDocumentType($query, $type)
    {
        return $query->where('document_type', $type);
    }

    /**
     * Scope for user's requests.
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}