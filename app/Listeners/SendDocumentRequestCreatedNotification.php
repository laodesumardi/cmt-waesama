<?php

namespace App\Listeners;

use App\Events\DocumentRequestCreated;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendDocumentRequestCreatedNotification
{
    // Removed ShouldQueue to make listener synchronous

    protected $notificationService;

    /**
     * Create the event listener.
     */
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the event.
     */
    public function handle(DocumentRequestCreated $event): void
    {
        $documentRequest = $event->documentRequest;
        
        // Kirim notifikasi ke admin dan staff menggunakan metode baru
        $this->notificationService->sendDocumentRequestNotification($documentRequest);

        // Kirim konfirmasi ke user yang mengajukan (jika user terdaftar)
        if ($documentRequest->user_id) {
            $this->notificationService->send($documentRequest->user, 'document_request_submitted', [
                'title' => 'Pengajuan Dokumen Diterima',
                'message' => "Pengajuan {$documentRequest->document_type_label} Anda telah diterima dan akan diproses dalam 1-3 hari kerja",
                'url' => route('documents.show', $documentRequest->id),
                'icon' => 'fas fa-check-circle',
                'document_request_id' => $documentRequest->id,
                'document_type' => $documentRequest->document_type,
                'estimated_completion' => '1-3 hari kerja',
            ], [
                'priority' => 'medium',
                'broadcast' => true,
                'email' => true,
            ]);
        }
    }
}