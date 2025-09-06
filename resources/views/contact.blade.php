<x-guest-public-layout>
    <x-slot name="title">Kontak</x-slot>

    <!-- Header Section -->
    <section class="bg-gradient-to-r from-[#14213d] to-[#0f1a2e] text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Hubungi Kami</h1>
                <p class="text-xl text-gray-200">Kami siap melayani dan membantu kebutuhan masyarakat</p>
            </div>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Information -->
                <div>
                    <h2 class="text-3xl font-bold text-[#14213d] mb-8">Informasi Kontak</h2>
                    
                    <div class="space-y-6">
                        <!-- Address -->
                        <div class="flex items-start">
                            <div class="bg-gray-100 rounded-full p-3 mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-[#14213d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-[#14213d] mb-2">Alamat Kantor</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    @if($villageInfo && $villageInfo->address)
                                        {{ $villageInfo->address }}
                                    @else
                                        Jl. Raya Kecamatan No. 123<br>
                                        Kecamatan, Kabupaten<br>
                                        Provinsi 12345
                                    @endif
                                </p>
                            </div>
                        </div>
                        
                        <!-- Phone -->
                        <div class="flex items-start">
                            <div class="bg-gray-100 rounded-full p-3 mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-[#14213d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-[#14213d] mb-2">Telepon</h3>
                                <p class="text-gray-600">
                                    @if($villageInfo && $villageInfo->phone)
                                        {{ $villageInfo->phone }}
                                    @else
                                        (021) 1234-5678
                                    @endif
                                </p>
                                <p class="text-sm text-gray-500 mt-1">Senin - Jumat, 08:00 - 16:00 WIB</p>
                            </div>
                        </div>
                        
                        <!-- Email -->
                        <div class="flex items-start">
                            <div class="bg-gray-100 rounded-full p-3 mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-[#14213d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-[#14213d] mb-2">Email</h3>
                                <p class="text-gray-600">
                                    @if($villageInfo && $villageInfo->email)
                                        {{ $villageInfo->email }}
                                    @else
                                        info@kecamatan.go.id
                                    @endif
                                </p>
                                <p class="text-sm text-gray-500 mt-1">Respon dalam 1x24 jam</p>
                            </div>
                        </div>
                        
                        <!-- WhatsApp -->
                        <div class="flex items-start">
                            <div class="bg-green-100 rounded-full p-3 mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-[#14213d] mb-2">WhatsApp</h3>
                                <p class="text-gray-600">+62 812-3456-7890</p>
                                <p class="text-sm text-gray-500 mt-1">Layanan cepat untuk informasi</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Office Hours -->
                    <div class="mt-8 p-6 bg-gray-50 rounded-lg">
                        <h3 class="text-lg font-semibold text-[#14213d] mb-4">Jam Pelayanan</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Senin - Kamis</span>
                                <span class="font-medium text-[#14213d]">08:00 - 16:00 WIB</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Jumat</span>
                                <span class="font-medium text-[#14213d]">08:00 - 11:30 WIB</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Sabtu - Minggu</span>
                                <span class="font-medium text-red-600">Tutup</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Form -->
                <div>
                    <h2 class="text-3xl font-bold text-[#14213d] mb-8">Kirim Pesan</h2>
                    
                    @if(session('success'))
                        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <form class="space-y-6" method="POST" action="{{ route('contact.send') }}">
                        @csrf
                        
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#14213d] focus:border-transparent transition-colors duration-150 @error('name') border-red-500 @enderror"
                                   placeholder="Masukkan nama lengkap Anda">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#14213d] focus:border-transparent transition-colors duration-150 @error('email') border-red-500 @enderror"
                                   placeholder="Masukkan alamat email Anda">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#14213d] focus:border-transparent transition-colors duration-150 @error('phone') border-red-500 @enderror"
                                   placeholder="Masukkan nomor telepon Anda">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Subject -->
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subjek *</label>
                            <select id="subject" name="subject" required 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#14213d] focus:border-transparent transition-colors duration-150 @error('subject') border-red-500 @enderror">
                                <option value="">Pilih subjek pesan</option>
                                <option value="informasi" {{ old('subject') == 'informasi' ? 'selected' : '' }}>Permintaan Informasi</option>
                                <option value="pelayanan" {{ old('subject') == 'pelayanan' ? 'selected' : '' }}>Layanan Administrasi</option>
                                <option value="pengaduan" {{ old('subject') == 'pengaduan' ? 'selected' : '' }}>Pengaduan</option>
                                <option value="saran" {{ old('subject') == 'saran' ? 'selected' : '' }}>Saran dan Masukan</option>
                                <option value="lainnya" {{ old('subject') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('subject')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Pesan *</label>
                            <textarea id="message" name="message" rows="6" required 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#14213d] focus:border-transparent transition-colors duration-150 resize-none @error('message') border-red-500 @enderror"
                                      placeholder="Tuliskan pesan Anda di sini...">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Submit Button -->
                        <div>
                            <button type="submit" 
                                    class="w-full bg-[#14213d] hover:bg-[#0f1a2e] text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-150 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Kirim Pesan
                            </button>
                        </div>
                        
                        <p class="text-sm text-gray-500 text-center">
                            * Wajib diisi. Pesan Anda akan direspon dalam 1x24 jam pada hari kerja.
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-[#14213d] mb-4">Lokasi Kantor</h2>
                <p class="text-xl text-gray-600">Temukan kami di peta</p>
            </div>
            
            <!-- Map Placeholder -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="h-96 bg-gray-200 flex items-center justify-center">
                    <div class="text-center">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Peta Lokasi</h3>
                        <p class="text-gray-500">Integrasi dengan Google Maps akan ditambahkan</p>
                        <a href="https://maps.google.com" target="_blank" 
                           class="inline-block mt-4 bg-[#14213d] hover:bg-[#0f1a2e] text-white px-6 py-2 rounded-lg font-semibold transition-colors duration-150">
                            Buka di Google Maps
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Contact -->
    <section class="py-16 bg-[#14213d] text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Butuh Bantuan Segera?</h2>
            <p class="text-xl text-gray-200 mb-8">Hubungi kami melalui saluran komunikasi yang tersedia</p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="tel:{{ $villageInfo->phone ?? '(021) 1234-5678' }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors duration-150 flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    Telepon Sekarang
                </a>
                
                <a href="https://wa.me/6281234567890" target="_blank" 
                   class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors duration-150 flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                    </svg>
                    WhatsApp
                </a>
            </div>
        </div>
    </section>
</x-guest-public-layout>