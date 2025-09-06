@extends('layouts.app')

@section('title', 'Detail Data Transparansi')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('staff.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('staff.transparency.index') }}">Data Transparansi</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </nav>
            <h1 class="h3 mb-0 text-gray-800">Detail Data Transparansi</h1>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('transparency.show', $transparency) }}" class="btn btn-info btn-sm" target="_blank">
                <i class="fas fa-external-link-alt"></i> Lihat Publik
            </a>
            <a href="{{ route('staff.transparency.edit', $transparency) }}" class="btn btn-primary btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('staff.transparency.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Main Info Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-info-circle"></i> Informasi Utama
                    </h6>
                </div>
                <div class="card-body">
                    <h4 class="mb-3">{{ $transparency->title }}</h4>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Kategori:</strong>
                            <span class="badge badge-primary">{{ $transparency->category }}</span>
                        </div>
                        <div class="col-md-6">
                            <strong>Tipe:</strong>
                            <span class="badge badge-info">{{ $transparency->type }}</span>
                        </div>
                    </div>

                    @if($transparency->description)
                        <div class="mb-3">
                            <strong>Deskripsi:</strong>
                            <p class="mt-2">{{ $transparency->description }}</p>
                        </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Periode:</strong>
                            <p class="mb-0">
                                {{ $transparency->period_start ? \Carbon\Carbon::parse($transparency->period_start)->format('d M Y') : '-' }}
                                @if($transparency->period_end)
                                    s/d {{ \Carbon\Carbon::parse($transparency->period_end)->format('d M Y') }}
                                @endif
                            </p>
                        </div>
                        @if($transparency->amount)
                            <div class="col-md-6">
                                <strong>Nilai/Jumlah:</strong>
                                <p class="mb-0">{{ $transparency->amount }}</p>
                            </div>
                        @endif
                    </div>

                    @if($transparency->data_json)
                        <div class="mb-3">
                            <strong>Data Terstruktur:</strong>
                            <div class="bg-light p-3 rounded mt-2">
                                <pre class="mb-0">{{ json_encode(json_decode($transparency->data_json), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Files Card -->
            @if($transparency->files)
                @php
                    $files = json_decode($transparency->files, true) ?? [];
                @endphp
                @if(count($files) > 0)
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fas fa-paperclip"></i> File Terlampir ({{ count($files) }})
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($files as $file)
                                    <div class="col-md-6 mb-3">
                                        <div class="border rounded p-3">
                                            <div class="d-flex align-items-center">
                                                <div class="mr-3">
                                                    @php
                                                        $extension = pathinfo($file['original_name'], PATHINFO_EXTENSION);
                                                        $iconClass = match(strtolower($extension)) {
                                                            'pdf' => 'fas fa-file-pdf text-danger',
                                                            'doc', 'docx' => 'fas fa-file-word text-primary',
                                                            'xls', 'xlsx' => 'fas fa-file-excel text-success',
                                                            'jpg', 'jpeg', 'png', 'gif' => 'fas fa-file-image text-warning',
                                                            default => 'fas fa-file text-secondary'
                                                        };
                                                    @endphp
                                                    <i class="{{ $iconClass }} fa-2x"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-1">{{ $file['original_name'] }}</h6>
                                                    <small class="text-muted">{{ number_format($file['size'] / 1024, 1) }} KB</small>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <a href="{{ Storage::url($file['path']) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                                <a href="{{ Storage::url($file['path']) }}" class="btn btn-sm btn-outline-success" download>
                                                    <i class="fas fa-download"></i> Download
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            <!-- Activity Timeline -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-history"></i> Riwayat Aktivitas
                    </h6>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <h6>Data Dibuat</h6>
                                <p>{{ $transparency->created_at->format('d M Y, H:i') }} WIB</p>
                            </div>
                        </div>
                        
                        @if($transparency->updated_at != $transparency->created_at)
                            <div class="timeline-item">
                                <div class="timeline-marker bg-warning"></div>
                                <div class="timeline-content">
                                    <h6>Data Diperbarui</h6>
                                    <p>{{ $transparency->updated_at->format('d M Y, H:i') }} WIB</p>
                                </div>
                            </div>
                        @endif
                        
                        @if($transparency->published_at)
                            <div class="timeline-item">
                                <div class="timeline-marker bg-primary"></div>
                                <div class="timeline-content">
                                    <h6>Data Dipublikasikan</h6>
                                    <p>{{ \Carbon\Carbon::parse($transparency->published_at)->format('d M Y, H:i') }} WIB</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-bar"></i> Statistik
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-6">
                            <div class="border-right">
                                <h4 class="text-primary">{{ number_format($transparency->views ?? 0) }}</h4>
                                <small class="text-muted">Total Views</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="text-success">{{ number_format($transparency->downloads ?? 0) }}</h4>
                            <small class="text-muted">Total Downloads</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Info Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-info"></i> Informasi
                    </h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td><strong>ID:</strong></td>
                            <td>{{ $transparency->id }}</td>
                        </tr>
                        <tr>
                            <td><strong>Slug:</strong></td>
                            <td><code>{{ $transparency->slug }}</code></td>
                        </tr>
                        <tr>
                            <td><strong>Status:</strong></td>
                            <td>
                                @if($transparency->status === 'published')
                                    <span class="badge badge-success">Dipublikasikan</span>
                                @else
                                    <span class="badge badge-warning">Draft</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Unggulan:</strong></td>
                            <td>
                                @if($transparency->is_featured)
                                    <span class="badge badge-warning"><i class="fas fa-star"></i> Ya</span>
                                @else
                                    <span class="badge badge-secondary">Tidak</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Dibuat:</strong></td>
                            <td>{{ $transparency->created_at->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Diupdate:</strong></td>
                            <td>{{ $transparency->updated_at->format('d M Y') }}</td>
                        </tr>
                        @if($transparency->published_at)
                            <tr>
                                <td><strong>Dipublikasi:</strong></td>
                                <td>{{ \Carbon\Carbon::parse($transparency->published_at)->format('d M Y') }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td><strong>Views:</strong></td>
                            <td>{{ number_format($transparency->views ?? 0) }}</td>
                        </tr>
                        <tr>
                            <td><strong>Downloads:</strong></td>
                            <td>{{ number_format($transparency->downloads ?? 0) }}</td>
                        </tr>
                        @if($transparency->files)
                            <tr>
                                <td><strong>File:</strong></td>
                                <td>{{ count(json_decode($transparency->files, true) ?? []) }} file</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow-lg mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-bolt"></i> Aksi Cepat
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        @if($transparency->status === 'draft')
                            <form method="POST" action="{{ route('staff.transparency.update', $transparency) }}" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="published">
                                <button type="submit" class="btn btn-success btn-sm w-100" 
                                        onclick="return confirm('Publikasikan data ini?')">
                                    <i class="fas fa-eye"></i> Publikasikan
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('staff.transparency.update', $transparency) }}" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="draft">
                                <button type="submit" class="btn btn-warning btn-sm w-100" 
                                        onclick="return confirm('Ubah ke draft? Data tidak akan tampil di publik.')">
                                    <i class="fas fa-eye-slash"></i> Jadikan Draft
                                </button>
                            </form>
                        @endif
                        
                        <form method="POST" action="{{ route('staff.transparency.update', $transparency) }}" class="d-inline">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="is_featured" value="{{ $transparency->is_featured ? '0' : '1' }}">
                            <button type="submit" class="btn btn-{{ $transparency->is_featured ? 'outline-warning' : 'warning' }} btn-sm w-100">
                                <i class="fas fa-star"></i> 
                                {{ $transparency->is_featured ? 'Hapus dari Unggulan' : 'Jadikan Unggulan' }}
                            </button>
                        </form>
                        
                        <a href="{{ route('staff.transparency.edit', $transparency) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Edit Data
                        </a>
                        
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">
                            <i class="fas fa-trash"></i> Hapus Data
                        </button>
                    </div>
                </div>
            </div>

            <!-- Share Card -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-share-alt"></i> Bagikan
                    </h6>
                </div>
                <div class="card-body">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="shareUrl" 
                               value="{{ route('transparency.show', $transparency) }}" readonly>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" onclick="copyUrl()">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                    <small class="text-muted">URL publik untuk data transparansi ini</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data transparansi ini?</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Peringatan:</strong> Tindakan ini tidak dapat dibatalkan. Semua file terkait juga akan dihapus.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form method="POST" action="{{ route('staff.transparency.destroy', $transparency) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-item:not(:last-child)::before {
    content: '';
    position: absolute;
    left: -22px;
    top: 20px;
    height: calc(100% + 10px);
    width: 2px;
    background-color: #e3e6f0;
}

.timeline-marker {
    position: absolute;
    left: -26px;
    top: 4px;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    border: 2px solid #fff;
    box-shadow: 0 0 0 2px #e3e6f0;
}

.timeline-content h6 {
    color: #5a5c69;
    font-size: 0.9rem;
}

.timeline-content p {
    color: #6e707e;
    font-size: 0.85rem;
}
</style>
@endpush

@push('scripts')
<script>
function copyUrl() {
    const urlInput = document.getElementById('shareUrl');
    urlInput.select();
    urlInput.setSelectionRange(0, 99999);
    document.execCommand('copy');
    
    // Show feedback
    const button = event.target.closest('button');
    const originalHtml = button.innerHTML;
    button.innerHTML = '<i class="fas fa-check"></i>';
    button.classList.add('btn-success');
    button.classList.remove('btn-outline-secondary');
    
    setTimeout(() => {
        button.innerHTML = originalHtml;
        button.classList.remove('btn-success');
        button.classList.add('btn-outline-secondary');
    }, 2000);
}
</script>
@endpush