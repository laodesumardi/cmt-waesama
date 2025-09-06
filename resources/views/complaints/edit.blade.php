@extends('layouts.app')

@section('title', 'Detail Pengajuan')

@section('content')

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Edit Pengaduan</h3>
                        <p class="mt-1 text-sm text-gray-600">Perbarui informasi pengaduan Anda</p>
                    </div>

                    <form method="POST" action="{{ route('complaints.update', $complaint) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Subject -->
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700">Subjek Pengaduan <span class="text-red-500">*</span></label>
                            <input type="text" name="subject" id="subject" value="{{ old('subject', $complaint->subject) }}" required maxlength="255" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('subject') border-red-300 @enderror" placeholder="Ringkasan singkat pengaduan Anda">
                            @error('subject')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700">Kategori <span class="text-red-500">*</span></label>
                            <select name="category" id="category" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('category') border-red-300 @enderror">
                                <option value="">Pilih Kategori</option>
                                @foreach(App\Http\Controllers\ComplaintController::getCategories() as $key => $value)
                                    <option value="{{ $key }}" {{ old('category', $complaint->category) == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Priority -->
                        <div>
                            <label for="priority" class="block text-sm font-medium text-gray-700">Prioritas <span class="text-red-500">*</span></label>
                            <select name="priority" id="priority" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('priority') border-red-300 @enderror">
                                <option value="">Pilih Prioritas</option>
                                @foreach(App\Http\Controllers\ComplaintController::getPriorities() as $key => $value)
                                    <option value="{{ $key }}" {{ old('priority', $complaint->priority) == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('priority')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Pengaduan <span class="text-red-500">*</span></label>
                            <textarea name="description" id="description" rows="6" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('description') border-red-300 @enderror" placeholder="Jelaskan detail pengaduan Anda dengan lengkap...">{{ old('description', $complaint->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Berikan informasi yang detail agar kami dapat memproses pengaduan Anda dengan baik.</p>
                        </div>

                        <!-- Location -->
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700">Lokasi Kejadian</label>
                            <input type="text" name="location" id="location" value="{{ old('location', $complaint->location) }}" maxlength="255" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('location') border-red-300 @enderror" placeholder="Alamat atau lokasi spesifik (opsional)">
                            @error('location')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Existing Attachments -->
                        @if($complaint->attachments && count($complaint->attachments) > 0)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">Lampiran Saat Ini</label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    @foreach($complaint->attachments as $index => $attachment)
                                        <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg bg-gray-50">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0">
                                                    @if(in_array(pathinfo($attachment['path'], PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                        <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                                        </svg>
                                                    @elseif(in_array(pathinfo($attachment['path'], PATHINFO_EXTENSION), ['pdf']))
                                                        <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                                        </svg>
                                                    @else
                                                        <svg class="w-6 h-6 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                                        </svg>
                                                    @endif
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-sm font-medium text-gray-900">{{ $attachment['name'] ?? basename($attachment['path']) }}</p>
                                                    <p class="text-xs text-gray-500">{{ strtoupper(pathinfo($attachment['path'], PATHINFO_EXTENSION)) }}</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <a href="{{ Storage::url($attachment['path']) }}" target="_blank" class="text-blue-600 hover:text-blue-900">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                </a>
                                                <button type="button" onclick="removeAttachment({{ $index }})" class="text-red-600 hover:text-red-900">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- New Attachments -->
                        <div>
                            <label for="attachments" class="block text-sm font-medium text-gray-700">Tambah Lampiran Baru</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition-colors">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="attachments" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Upload file</span>
                                            <input id="attachments" name="attachments[]" type="file" class="sr-only" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                        </label>
                                        <p class="pl-1">atau drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, PDF, DOC hingga 10MB (maksimal 5 file)</p>
                                </div>
                            </div>
                            @error('attachments')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @error('attachments.*')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <!-- File Preview -->
                            <div id="file-preview" class="mt-3 hidden">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">File baru yang dipilih:</h4>
                                <div id="file-list" class="space-y-2"></div>
                            </div>
                        </div>

                        <!-- Contact Info -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Informasi Kontak</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="contact_phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                                    <input type="tel" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', $complaint->contact_phone) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('contact_phone') border-red-300 @enderror" placeholder="08xxxxxxxxxx">
                                    @error('contact_phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="contact_email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', $complaint->contact_email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('contact_email') border-red-300 @enderror" placeholder="email@example.com">
                                    @error('contact_email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Hidden inputs for removed attachments -->
                        <div id="removed-attachments"></div>

                        <!-- Submit Buttons -->
                        <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                            <a href="{{ route('complaints.show', $complaint) }}" class="inline-flex items-center px-6 py-3 bg-gray-500 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-gray-600 focus:bg-gray-600 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-300 shadow-md hover:shadow-lg">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-[#14213d] border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-[#0f1a2e] focus:bg-[#0f1a2e] active:bg-[#0a1423] focus:outline-none focus:ring-2 focus:ring-[#14213d] focus:ring-offset-2 transition-all duration-300 shadow-md hover:shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                                Perbarui Pengaduan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Box -->
            <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800">Catatan Penting</h3>
                        <div class="mt-2 text-sm text-yellow-700">
                            <ul class="list-disc list-inside space-y-1">
                                <li>Pengaduan hanya dapat diedit jika statusnya masih "Terbuka" atau "Sedang Diproses"</li>
                                <li>Perubahan akan dinotifikasi kepada petugas yang menangani</li>
                                <li>Lampiran yang dihapus tidak dapat dikembalikan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let removedAttachments = [];

        // File upload preview
        document.getElementById('attachments').addEventListener('change', function(e) {
            const files = e.target.files;
            const preview = document.getElementById('file-preview');
            const fileList = document.getElementById('file-list');

            if (files.length > 0) {
                preview.classList.remove('hidden');
                fileList.innerHTML = '';

                Array.from(files).forEach((file, index) => {
                    const fileItem = document.createElement('div');
                    fileItem.className = 'flex items-center justify-between p-2 bg-white border border-gray-200 rounded';

                    const fileInfo = document.createElement('div');
                    fileInfo.className = 'flex items-center';

                    const fileIcon = document.createElement('svg');
                    fileIcon.className = 'w-4 h-4 mr-2 text-gray-400';
                    fileIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>';

                    const fileName = document.createElement('span');
                    fileName.className = 'text-sm text-gray-700';
                    fileName.textContent = file.name;

                    const fileSize = document.createElement('span');
                    fileSize.className = 'text-xs text-gray-500 ml-2';
                    fileSize.textContent = `(${(file.size / 1024 / 1024).toFixed(2)} MB)`;

                    fileInfo.appendChild(fileIcon);
                    fileInfo.appendChild(fileName);
                    fileInfo.appendChild(fileSize);

                    fileItem.appendChild(fileInfo);
                    fileList.appendChild(fileItem);
                });
            } else {
                preview.classList.add('hidden');
            }
        });

        // Remove existing attachment
        function removeAttachment(index) {
            if (confirm('Apakah Anda yakin ingin menghapus lampiran ini?')) {
                // Add to removed list
                removedAttachments.push(index);

                // Hide the attachment element
                event.target.closest('.flex').style.display = 'none';

                // Add hidden input
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'remove_attachments[]';
                hiddenInput.value = index;
                document.getElementById('removed-attachments').appendChild(hiddenInput);
            }
        }
    </script>
@endsection