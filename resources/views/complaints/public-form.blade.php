<x-guest-public-layout>
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Pengaduan Masyarakat</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Sampaikan keluhan, saran, atau laporan Anda kepada kami. Setiap pengaduan akan ditindaklanjuti dengan serius.
                </p>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                            @if(session('ticket_number'))
                                <p class="text-sm text-green-700 mt-1">
                                    Simpan nomor tiket ini untuk melacak status pengaduan: 
                                    <span class="font-mono font-bold">{{ session('ticket_number') }}</span>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan pada form:</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Form -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <form action="{{ route('services.complaints.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                    @csrf

                    <!-- Data Pengadu -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Data Pengadu</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="complainant_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="complainant_name" name="complainant_name" 
                                       value="{{ old('complainant_name') }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#14213d] focus:border-[#14213d]">
                            </div>
                            <div>
                                <label for="complainant_email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email
                                </label>
                                <input type="email" id="complainant_email" name="complainant_email" 
                                       value="{{ old('complainant_email') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#14213d] focus:border-[#14213d]">
                            </div>
                            <div>
                                <label for="complainant_phone" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nomor Telepon <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" id="complainant_phone" name="complainant_phone" 
                                       value="{{ old('complainant_phone') }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#14213d] focus:border-[#14213d]">
                            </div>
                            <div>
                                <label for="complainant_address" class="block text-sm font-medium text-gray-700 mb-2">
                                    Alamat <span class="text-red-500">*</span>
                                </label>
                                <textarea id="complainant_address" name="complainant_address" rows="3" required
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#14213d] focus:border-[#14213d]">{{ old('complainant_address') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Pengaduan -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Pengaduan</h3>
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                                        Kategori <span class="text-red-500">*</span>
                                    </label>
                                    <select id="category" name="category" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#14213d] focus:border-[#14213d]">
                                        <option value="">Pilih Kategori</option>
                                        @foreach(App\Http\Controllers\ComplaintController::getCategories() as $key => $value)
                                            <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                                        Subjek Pengaduan <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="subject" name="subject" 
                                           value="{{ old('subject') }}" required
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#14213d] focus:border-[#14213d]">
                                </div>
                            </div>
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                    Deskripsi Pengaduan <span class="text-red-500">*</span>
                                </label>
                                <textarea id="description" name="description" rows="6" required
                                          placeholder="Jelaskan detail pengaduan Anda..."
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#14213d] focus:border-[#14213d]">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Lampiran -->
                    <div class="pb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Lampiran (Opsional)</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="attachments" class="block text-sm font-medium text-gray-700 mb-2">
                                    Upload File
                                </label>
                                <input type="file" id="attachments" name="attachments[]" multiple
                                       accept=".jpg,.jpeg,.png,.pdf,.doc,.docx"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <p class="text-sm text-gray-500 mt-1">
                                    Format yang didukung: JPG, PNG, PDF, DOC, DOCX. Maksimal 5MB per file.
                                </p>
                            </div>
                            <div id="file-preview" class="hidden">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">File yang dipilih:</h4>
                                <div id="file-list" class="space-y-2"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('home') }}" 
                           class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#14213d]">
                            Batal
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-[#14213d] text-white rounded-md hover:bg-[#0f1a2e] focus:outline-none focus:ring-2 focus:ring-[#14213d]">
                            Kirim Pengaduan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Info Box -->
            <div class="mt-8 bg-gray-50 border border-gray-200 rounded-lg p-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-[#14213d]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-[#14213d]">Informasi Penting</h3>
                        <div class="mt-2 text-sm text-gray-700">
                            <ul class="list-disc list-inside space-y-1">
                                <li>Setiap pengaduan akan mendapat nomor tiket untuk tracking</li>
                                <li>Pengaduan akan ditindaklanjuti dalam 1x24 jam</li>
                                <li>Anda dapat melacak status pengaduan melalui menu "Lacak Pengaduan"</li>
                                <li>Pastikan data yang diisi sudah benar dan lengkap</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // File preview functionality
        document.getElementById('attachments').addEventListener('change', function(e) {
            const files = e.target.files;
            const preview = document.getElementById('file-preview');
            const fileList = document.getElementById('file-list');
            
            if (files.length > 0) {
                preview.classList.remove('hidden');
                fileList.innerHTML = '';
                
                Array.from(files).forEach((file, index) => {
                    const fileItem = document.createElement('div');
                    fileItem.className = 'flex items-center justify-between p-2 bg-gray-50 rounded border';
                    
                    const fileInfo = document.createElement('div');
                    fileInfo.className = 'flex items-center';
                    
                    const fileIcon = document.createElement('div');
                    fileIcon.className = 'w-8 h-8 bg-blue-100 rounded flex items-center justify-center mr-3';
                    fileIcon.innerHTML = '<svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/></svg>';
                    
                    const fileName = document.createElement('div');
                    fileName.innerHTML = `
                        <div class="text-sm font-medium text-gray-900">${file.name}</div>
                        <div class="text-xs text-gray-500">${(file.size / 1024 / 1024).toFixed(2)} MB</div>
                    `;
                    
                    fileInfo.appendChild(fileIcon);
                    fileInfo.appendChild(fileName);
                    fileItem.appendChild(fileInfo);
                    
                    fileList.appendChild(fileItem);
                });
            } else {
                preview.classList.add('hidden');
            }
        });
    </script>
</x-guest-public-layout>