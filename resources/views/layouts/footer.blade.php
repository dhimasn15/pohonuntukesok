<!-- Footer -->
<footer class="bg-gray-900 text-white pt-16 pb-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            <!-- About -->
            <div data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center text-2xl font-bold mb-4">
                    <i class="fas fa-tree mr-2"></i>
                    <span>PohonUntukEsok</span>
                </div>
                <p class="text-gray-400 mb-4">
                    Platform donasi pohon untuk menghijaukan Indonesia. Bersama kita bisa menciptakan perubahan
                    untuk masa depan yang lebih baik.
                </p>
                <div class="flex space-x-4">
                    <a href="#"
                        class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors hover-zoom">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors hover-zoom">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors hover-zoom">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors hover-zoom">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div data-aos="fade-up" data-aos-delay="200">
                <h3 class="text-lg font-bold mb-4">Tautan Cepat</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-accent transition-colors"><i
                                class="fas fa-chevron-right text-xs mr-2"></i> Beranda</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-accent transition-colors"><i
                                class="fas fa-chevron-right text-xs mr-2"></i> Tentang Kami</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-accent transition-colors"><i
                                class="fas fa-chevron-right text-xs mr-2"></i> Kampanye</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-accent transition-colors"><i
                                class="fas fa-chevron-right text-xs mr-2"></i> Blog</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-accent transition-colors"><i
                                class="fas fa-chevron-right text-xs mr-2"></i> FAQ</a></li>
                </ul>
            </div>

            <!-- Programs -->
            <div data-aos="fade-up" data-aos-delay="300">
                <h3 class="text-lg font-bold mb-4">Bergabung Kengan Kami</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('petani.daftar')}}" class="text-gray-400 hover:text-accent transition-colors"><i
                                class="fas fa-chevron-right text-xs mr-2"></i> Daftar Sebagai Petani</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-accent transition-colors"><i
                                class="fas fa-chevron-right text-xs mr-2"></i> Daftar Relawan</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-accent transition-colors"><i
                                class="fas fa-chevron-right text-xs mr-2"></i> Daftarkan Lokasi Penanaman</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div data-aos="fade-up" data-aos-delay="400">
                <h3 class="text-lg font-bold mb-4">Hubungi Kami</h3>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt text-accent mt-1 mr-3"></i>
                        <span class="text-gray-400">Jl. Hijau Lestari No. 42, Jakarta Selatan, Indonesia</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone-alt text-accent mr-3"></i>
                        <span class="text-gray-400">+62 21 1234 5678</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope text-accent mr-3"></i>
                        <span class="text-gray-400">info@pohonuntukesok.org</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="pt-8 border-t border-gray-800">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">
                    &copy; {{ date('Y') }} PohonUntukEsok. All rights reserved.
                </p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-accent text-sm transition-colors">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-accent text-sm transition-colors">Terms of Service</a>
                    <a href="#" class="text-gray-400 hover:text-accent text-sm transition-colors">Sitemap</a>
                </div>
            </div>
        </div>
    </div>
</footer>