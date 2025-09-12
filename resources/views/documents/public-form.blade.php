<x-guest-public-layout>
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Layanan Administrasi Online</h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Ajukan berbagai dokumen administrasi secara online. Proses lebih cepat, mudah, dan transparan.
                </p>
            </div>

            <!-- Services Info -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Mudah & Cepat</h3>
                    <p class="text-gray-600">Ajukan dokumen kapan saja, dimana saja tanpa perlu datang ke kantor</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Tracking Real-time</h3>
                    <p class="text-gray-600">Pantau status pengajuan Anda secara real-time</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Aman & Terpercaya</h3>
                    <p class="text-gray-600">Data Anda aman dan proses transparan</p>
                </div>
            </div>

            <!-- Document Request Form -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Form Pengajuan Dokumen</h2>
                    <p class="text-gray-600">Silakan isi form di bawah ini dengan lengkap dan benar</p>
                </div>

                @if(session('success'))
                    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('documents.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Document Type -->
                    <div>
                        <label for="document_type" class="block text-sm font-medium text-gray-700 mb-2">Jenis Dokumen *</label>
                        <select id="document_type" name="document_type" required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#14213d] focus:border-transparent @error('document_type') border-red-500 @enderror">
                            <option value="">Pilih jenis dokumen</option>
                            @foreach($documentTypes as $key => $label)
                                <option value="{{ $key }}" {{ old('document_type') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('document_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Purpose -->
                    <div>
                        <label for="purpose" class="block text-sm font-medium text-gray-700 mb-2">Keperluan *</label>
                        <textarea id="purpose" name="purpose" rows="3" required 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#14213d] focus:border-transparent resize-none @error('purpose') border-red-500 @enderror"
                                  placeholder="Jelaskan keperluan dokumen ini...">{{ old('purpose') }}</textarea>
                        @error('purpose')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Applicant Information -->
                    <div class="border-t pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Pemohon</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label for="applicant_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                                <input type="text" id="applicant_name" name="applicant_name" value="{{ old('applicant_name') }}" required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#14213d] focus:border-transparent @error('applicant_name') border-red-500 @enderror"
                                       placeholder="Masukkan nama lengkap sesuai KTP">
                                @error('applicant_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- NIK -->
                            <div>
                                <label for="applicant_nik" class="block text-sm font-medium text-gray-700 mb-2">NIK *</label>
                                <input type="text" id="applicant_nik" name="applicant_nik" value="{{ old('applicant_nik') }}" required 
                                       maxlength="16" pattern="[0-9]{16}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#14213d] focus:border-transparent @error('applicant_nik') border-red-500 @enderror"
                                       placeholder="Masukkan 16 digit NIK">
                                @error('applicant_nik')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div>
                                <label for="applicant_phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon *</label>
                                <input type="tel" id="applicant_phone" name="applicant_phone" value="{{ old('applicant_phone') }}" required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#14213d] focus:border-transparent @error('applicant_phone') border-red-500 @enderror"
                                       placeholder="Contoh: 08123456789">
                                @error('applicant_phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Birth Place -->
                            <div>
                                <label for="applicant_birth_place" class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir *</label>
                                <input type="text" id="applicant_birth_place" name="applicant_birth_place" value="{{ old('applicant_birth_place') }}" required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#14213d] focus:border-transparent @error('applicant_birth_place') border-red-500 @enderror"
                                       placeholder="Masukkan tempat lahir">
                                @error('applicant_birth_place')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Birth Date -->
                            <div>
                                <label for="applicant_birth_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir *</label>
                                <input type="date" id="applicant_birth_date" name="applicant_birth_date" value="{{ old('applicant_birth_date') }}" required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#14213d] focus:border-transparent @error('applicant_birth_date') border-red-500 @enderror">
                                @error('applicant_birth_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Gender -->
                            <div>
                                <label for="applicant_gender" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin *</label>
                                <select id="applicant_gender" name="applicant_gender" required 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#14213d] focus:border-transparent @error('applicant_gender') border-red-500 @enderror">
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="Laki-laki" {{ old('applicant_gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('applicant_gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('applicant_gender')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Religion -->
                            <div>
                                <label for="applicant_religion" class="block text-sm font-medium text-gray-700 mb-2">Agama *</label>
                                <select id="applicant_religion" name="applicant_religion" required 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#14213d] focus:border-transparent @error('applicant_religion') border-red-500 @enderror">
                                    <option value="">Pilih agama</option>
                                    <option value="Islam" {{ old('applicant_religion') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('applicant_religion') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ old('applicant_religion') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('applicant_religion') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('applicant_religion') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ old('applicant_religion') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select>
                                @error('applicant_religion')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Marital Status -->
                            <div>
                                <label for="applicant_marital_status" class="block text-sm font-medium text-gray-700 mb-2">Status Perkawinan *</label>
                                <select id="applicant_marital_status" name="applicant_marital_status" required 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#14213d] focus:border-transparent @error('applicant_marital_status') border-red-500 @enderror">
                                    <option value="">Pilih status perkawinan</option>
                                    <option value="Belum Kawin" {{ old('applicant_marital_status') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                    <option value="Kawin" {{ old('applicant_marital_status') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                    <option value="Cerai Hidup" {{ old('applicant_marital_status') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                    <option value="Cerai Mati" {{ old('applicant_marital_status') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                </select>
                                @error('applicant_marital_status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Occupation -->
                            <div>
                                <label for="applicant_occupation" class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan *</label>
                                <input type="text" id="applicant_occupation" name="applicant_occupation" value="{{ old('applicant_occupation') }}" required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#14213d] focus:border-transparent @error('applicant_occupation') border-red-500 @enderror"
                                       placeholder="Masukkan pekerjaan">
                                @error('applicant_occupation')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nationality -->
                            <div>
                                <label for="applicant_nationality" class="block text-sm font-medium text-gray-700 mb-2">Kewarganegaraan *</label>
                                <select id="applicant_nationality" name="applicant_nationality" required 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#14213d] focus:border-transparent @error('applicant_nationality') border-red-500 @enderror">
                                    <option value="">Pilih kewarganegaraan</option>
                                    <option value="WNI" {{ old('applicant_nationality') == 'WNI' ? 'selected' : '' }}>Warga Negara Indonesia (WNI)</option>
                                    <option value="WNA" {{ old('applicant_nationality') == 'WNA' ? 'selected' : '' }}>Warga Negara Asing (WNA)</option>
                                </select>
                                @error('applicant_nationality')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="applicant_email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" id="applicant_email" name="applicant_email" value="{{ old('applicant_email') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#14213d] focus:border-transparent @error('applicant_email') border-red-500 @enderror"
                                       placeholder="Masukkan alamat email (opsional)">
                                @error('applicant_email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="mt-6">
                            <label for="applicant_address" class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap *</label>
                            <textarea id="applicant_address" name="applicant_address" rows="3" required 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#14213d] focus:border-transparent resize-none @error('applicant_address') border-red-500 @enderror"
                                      placeholder="Masukkan alamat lengkap sesuai KTP">{{ old('applicant_address') }}</textarea>
                            @error('applicant_address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="border-t pt-6">
                        <div class="flex items-start space-x-3">
                            <input type="checkbox" id="terms" name="terms" required 
                                   class="mt-1 h-4 w-4 text-[#14213d] focus:ring-[#14213d] border-gray-300 rounded">
                            <label for="terms" class="text-sm text-gray-700">
                                Saya menyatakan bahwa data yang saya berikan adalah benar dan dapat dipertanggungjawabkan. 
                                Saya memahami bahwa pengajuan dokumen akan diproses dalam 1-3 hari kerja.
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <button type="submit" 
                                class="flex-1 bg-[#14213d] text-white py-3 px-6 rounded-lg hover:bg-[#0f1a2e] transition duration-300 font-medium">
                            Ajukan Dokumen
                        </button>
                        <a href="{{ route('services.track') }}" 
                           class="flex-1 bg-gray-100 text-gray-700 py-3 px-6 rounded-lg hover:bg-gray-200 transition duration-300 font-medium text-center">
                            Lacak Status Pengajuan
                        </a>
                    </div>
                </form>
            </div>

            <!-- Information Section -->
            <div class="mt-12 bg-gray-50 rounded-lg p-8">
                <h3 class="text-xl font-semibold text-[#14213d] mb-4">Informasi Penting</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">
                    <div>
                        <h4 class="font-semibold mb-2">Waktu Proses:</h4>
                        <ul class="space-y-1 text-sm">
                            <li>• KTP, KK: 1-2 hari kerja</li>
                            <li>• Akta Kelahiran/Kematian: 2-3 hari kerja</li>
                            <li>• Surat Keterangan: 1 hari kerja</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-2">Jam Pelayanan:</h4>
                        <ul class="space-y-1 text-sm">
                            <li>• Senin - Kamis: 08:00 - 15:00</li>
                            <li>• Jumat: 08:00 - 11:30</li>
                            <li>• Sabtu - Minggu: Tutup</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // NIK validation
        document.getElementById('applicant_nik').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0, 16);
        });

        // Phone validation
        document.getElementById('applicant_phone').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9+]/g, '');
        });
    </script>
</x-guest-public-layout>