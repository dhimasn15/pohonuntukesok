<!-- Navigation -->
<nav class="fixed w-full bg-primary text-white shadow-lg z-50 transition-all duration-300" id="main-nav">
    <div class="container mx-auto px-4 sm:px-6 py-3 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{route('home')}}" class="flex items-center text-2xl font-bold hover-target flex-shrink-0">
            <img src="{{ asset('img/logo.png') }}" alt="PohonUntukEsok" class="w-48 h-auto md:w-32 lg:w-48 object-contain" />
        </a>
        
        <!-- Desktop Menu -->
        <div class="hidden lg:flex items-center space-x-6 xl:space-x-8 flex-1 justify-center">
            <a href="{{route('home')}}" class="hover:text-accent transition-colors flex items-center group px-3 py-2 rounded-lg ">
                <i class="fas fa-home mr-2 text-sm"></i> 
                <span class="text-sm font-medium">Beranda</span>
            </a>
            
            <div class="relative group">
                <button class="hover:text-accent transition-colors flex items-center px-3 py-2 rounded-lg ">
                    <i class="fas fa-seedling mr-2 text-sm"></i> 
                    <span class="text-sm font-medium">Mulai Dari Kamu</span>
                    <i class="fas fa-chevron-down ml-1 text-xs transition-transform duration-300 group-hover:rotate-180"></i>
                </button>
                <div class="dropdown-menu absolute left-0 mt-2 w-56 bg-white rounded-xl shadow-2xl py-3 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 border border-gray-100">
                    <a href="{{route('buat')}}" class="block px-4 py-3 text-gray-800 hover:bg-green-50 hover:text-primary transition-colors text-sm font-medium">
                        <i class="fas fa-plus-circle text-primary mr-3"></i>Buat Kampanye
                    </a>
                    <div class="border-t border-gray-100 my-1"></div>
                    <a href="{{route('donasi')}}" class="block px-4 py-3 text-gray-800 hover:bg-green-50 hover:text-primary transition-colors text-sm font-medium">
                        <i class="fas fa-hand-holding-heart text-primary mr-3"></i>Donasi Pohon
                    </a>
                    <div class="border-t border-gray-100 my-1"></div>
                    <a href="{{route ('kampanye')}}" class="block px-4 py-3 text-gray-800 hover:bg-green-50 hover:text-primary transition-colors text-sm font-medium">
                        <i class="fas fa-list-ul text-primary mr-3"></i>Daftar Kampanye
                    </a>
                </div>
            </div>
            
            <a href="{{ route('about')}}" class="hover:text-accent transition-colors flex items-center group px-3 py-2 rounded-lg ">
                <i class="fas fa-info-circle mr-2 text-sm"></i> 
                <span class="text-sm font-medium">Tentang Kami</span>
            </a>
            
            <a href="{{ route('blog.index')}}" class="hover:text-accent transition-colors flex items-center group px-3 py-2 rounded-lg ">
                <i class="fas fa-newspaper mr-2 text-sm"></i> 
                <span class="text-sm font-medium">Blog</span>
            </a>
        </div>

        <!-- Desktop Auth Section -->
        <div class="hidden lg:flex items-center space-x-4 ml-6 flex-shrink-0">
            @auth
                <!-- Enhanced User Profile -->
                <div class="relative group">
                    <button class="flex items-center space-x-3 p-2 rounded-2xl hover:bg-white/10 transition-all duration-300 group border border-transparent hover:border-white/20">
                        @php
                            $avatarUrl = Auth::user()->avatar;
                            if (empty($avatarUrl) || $avatarUrl === 'null' || $avatarUrl === '') {
                                $avatarUrl = "https://ui-avatars.com/api/?name=" . urlencode(Auth::user()->name) . "&background=4A7C59&color=ffffff&size=64&bold=true";
                            }
                        @endphp
                        
                        <div class="flex items-center space-x-3">
                            <div class="relative">
                                <img src="{{ $avatarUrl }}" 
                                     alt="{{ Auth::user()->name }}" 
                                     class="w-9 h-9 rounded-full object-cover border-2 border-white/60 hover:border-accent transition-all duration-300 shadow-md"
                                     onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4A7C59&color=ffffff&size=64&bold=true'">
                                <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-400 rounded-full border-2 border-white"></div>
                            </div>
                            <div class="text-left hidden xl:block">
                                <p class="font-semibold text-sm leading-tight">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-white/70">Lihat Profil</p>
                            </div>
                            <i class="fas fa-chevron-down text-xs text-white/70 transition-transform duration-300 group-hover:rotate-180 ml-1"></i>
                        </div>
                    </button>

                    <!-- Profile Dropdown Menu -->
                    <div class="absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-2xl z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 border border-gray-100 overflow-hidden">
                        <!-- Header -->
                        <div class="bg-gradient-to-r from-primary to-green-600 p-5 text-white">
                            <div class="flex items-center space-x-3">
                                <img src="{{ $avatarUrl }}" 
                                     alt="{{ Auth::user()->name }}" 
                                     class="w-12 h-12 rounded-xl object-cover border-2 border-white/30"
                                     onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4A7C59&color=ffffff&size=64&bold=true'">
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-black truncate ">{{ Auth::user()->name }}</h3>
                                    <p class=" text-xs text-black truncate">{{ Auth::user()->email }}</p>
                                    <div class="flex items-center mt-1">
                                        <span class="inline-flex items-center text-black px-2 py-1 bg-white/20 rounded-full text-xs">
                                            <i class="fas fa-shield-alt mr-1 text-[10px]"></i>
                                            {{ Auth::user()->role === 'admin' ? 'Administrator' : 'Member' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Menu Items -->
                        <div class="p-3 space-y-1">
                            <a href="{{ route('profil-user') }}" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-green-50 text-gray-700 transition-all duration-200 group">
                                <div class="w-9 h-9 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition-colors">
                                    <i class="fas fa-user text-green-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-sm">Profil Saya</p>
                                    <p class="text-xs text-gray-500">Kelola profil</p>
                                </div>
                            </a>

                            <a href="{{ route('kampanye') }}" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-blue-50 text-gray-700 transition-all duration-200 group">
                                <div class="w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                                    <i class="fas fa-seedling text-blue-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-sm">Kampanye</p>
                                    <p class="text-xs text-gray-500">Jelajahi kampanye</p>
                                </div>
                            </a>

                            @if(Auth::user()->role === 'admin')
                            <a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-red-50 text-gray-700 transition-all duration-200 group">
                                <div class="w-9 h-9 bg-red-100 rounded-lg flex items-center justify-center group-hover:bg-red-200 transition-colors">
                                    <i class="fas fa-crown text-red-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-sm">Admin Panel</p>
                                    <p class="text-xs text-gray-500">Kelola sistem</p>
                                </div>
                            </a>
                            @endif
                        </div>

                        <!-- Footer -->
                        <div class="border-t border-gray-100 p-3 bg-gray-50">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center space-x-3 w-full p-3 rounded-xl hover:bg-red-50 text-red-600 transition-all duration-200 group">
                                    <div class="w-9 h-9 bg-red-100 rounded-lg flex items-center justify-center group-hover:bg-red-200 transition-colors">
                                        <i class="fas fa-sign-out-alt text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-sm">Keluar</p>
                                        <p class="text-xs text-red-500">Logout dari akun</p>
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="flex space-x-3">
                    <button onclick="openAuthModal('login')" class="px-5 py-2.5 border border-white/50 rounded-xl hover:bg-white hover:text-primary transition-all duration-300 font-medium text-sm backdrop-blur-sm">
                        <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                    </button>
                    <button onclick="openAuthModal('register')" class="px-5 py-2.5 bg-white text-primary font-semibold rounded-xl hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <i class="fas fa-user-plus mr-2"></i> Daftar
                    </button>
                </div>
            @endauth
        </div>

        <!-- Mobile Burger Button -->
        <button id="burger-button" class="lg:hidden flex flex-col justify-center items-center w-10 h-10 relative z-50" aria-label="Toggle Menu">
            <span class="block w-6 h-0.5 bg-white rounded transition-all duration-300 mb-1.5 burger-line"></span>
            <span class="block w-6 h-0.5 bg-white rounded transition-all duration-300 mb-1.5 burger-line"></span>
            <span class="block w-6 h-0.5 bg-white rounded transition-all duration-300 burger-line"></span>
        </button>
    </div>
    
    <!-- Enhanced Mobile Menu -->
    <div id="mobile-menu" class="fixed inset-0 bg-primary/95 backdrop-blur-lg z-40 transition-all duration-300 transform -translate-y-full lg:hidden">
        <div class="container mx-auto px-4 h-full overflow-y-auto pt-20 pb-8">
            <!-- Close Button -->
            <div class="absolute top-4 right-4">
                <button id="mobile-close-btn" class="w-10 h-10 flex items-center justify-center text-white hover:text-accent transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <div class="flex flex-col space-y-1">
                <!-- User Profile Card (Jika Login) -->
                @auth
                <div class="bg-white/10 rounded-2xl p-4 mb-4 backdrop-blur-sm border border-white/10">
                    <div class="flex items-center space-x-3">
                        @php
                            $avatarUrlMobile = Auth::user()->avatar;
                            if (empty($avatarUrlMobile) || $avatarUrlMobile === 'null' || $avatarUrlMobile === '') {
                                $avatarUrlMobile = "https://ui-avatars.com/api/?name=" . urlencode(Auth::user()->name) . "&background=4A7C59&color=ffffff&size=64&bold=true";
                            }
                        @endphp
                        
                        <img src="{{ $avatarUrlMobile }}" 
                             alt="{{ Auth::user()->name }}" 
                             class="w-14 h-14 rounded-2xl object-cover border-2 border-white/50 shadow-lg"
                             onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4A7C59&color=ffffff&size=64&bold=true'">
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-white text-lg truncate">{{ Auth::user()->name }}</h3>
                            <p class="text-white/80 text-sm truncate">{{ Auth::user()->email }}</p>
                            <span class="inline-flex items-center px-2 py-1 bg-white/20 rounded-full text-xs mt-1">
                                <i class="fas fa-shield-alt mr-1"></i>
                                {{ Auth::user()->role === 'admin' ? 'Admin' : 'User' }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="grid grid-cols-2 gap-2 mt-4">
                        <a href="{{ route('profil-user') }}" class="flex flex-col items-center p-3 bg-white/10 rounded-xl hover:bg-white/20 transition-colors" onclick="closeMobileMenu()">
                            <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center mb-2">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <span class="text-xs font-semibold text-white">Profil</span>
                        </a>
                        <a href="{{ route('kampanye') }}" class="flex flex-col items-center p-3 bg-white/10 rounded-xl hover:bg-white/20 transition-colors" onclick="closeMobileMenu()">
                            <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mb-2">
                                <i class="fas fa-seedling text-white text-sm"></i>
                            </div>
                            <span class="text-xs font-semibold text-white">Kampanye</span>
                        </a>
                    </div>
                </div>
                @endauth

                <!-- Navigation Links -->
                <a href="{{route('home')}}" class="flex items-center space-x-3 p-4 rounded-xl hover:bg-white/10 transition-colors text-white font-medium" onclick="closeMobileMenu()">
                    <i class="fas fa-home w-5 text-center"></i>
                    <span>Beranda</span>
                </a>

                <div class="border-b border-white/10 pb-2">
                    <button id="mobile-dropdown-btn" class="flex items-center space-x-3 p-4 rounded-xl hover:bg-white/10 transition-colors text-white font-medium w-full text-left">
                        <i class="fas fa-seedling w-5 text-center"></i>
                        <span class="flex-1">Mulai Dari Kamu</span>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-300" id="mobile-chevron"></i>
                    </button>
                    <div id="mobile-dropdown-menu" class="flex flex-col space-y-1 mt-1 max-h-0 overflow-hidden transition-all duration-300">
                        <a href="{{route('buat')}}" class="flex items-center space-x-3 py-3 px-8 rounded-xl hover:bg-white/10 transition-colors text-white/90 text-sm" onclick="closeMobileMenu()">
                            <i class="fas fa-plus-circle text-sm"></i>
                            <span>Buat Kampanye</span>
                        </a>
                        <a href="{{route('donasi')}}" class="flex items-center space-x-3 py-3 px-8 rounded-xl hover:bg-white/10 transition-colors text-white/90 text-sm" onclick="closeMobileMenu()">
                            <i class="fas fa-hand-holding-heart text-sm"></i>
                            <span>Donasi Pohon</span>
                        </a>
                        <a href="{{route ('kampanye')}}" class="flex items-center space-x-3 py-3 px-8 rounded-xl hover:bg-white/10 transition-colors text-white/90 text-sm" onclick="closeMobileMenu()">
                            <i class="fas fa-list-ul text-sm"></i>
                            <span>Daftar Kampanye</span>
                        </a>
                    </div>
                </div>

                <a href="{{ route('about')}}" class="flex items-center space-x-3 p-4 rounded-xl hover:bg-white/10 transition-colors text-white font-medium" onclick="closeMobileMenu()">
                    <i class="fas fa-info-circle w-5 text-center"></i>
                    <span>Tentang Kami</span>
                </a>

                <a href="{{ route('blog.index')}}" class="flex items-center space-x-3 p-4 rounded-xl hover:bg-white/10 transition-colors text-white font-medium" onclick="closeMobileMenu()">
                    <i class="fas fa-newspaper w-5 text-center"></i>
                    <span>Blog</span>
                </a>

                <!-- Mobile Auth Buttons -->
                @guest
                <div class="border-t border-white/10 pt-4 mt-4">
                    <div class="flex flex-col gap-3">
                        <button onclick="openAuthModal('login'); closeMobileMenu();" class="w-full py-3.5 border-2 border-white rounded-xl hover:bg-white hover:text-primary transition-colors text-white font-semibold text-center">
                            <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                        </button>
                        <button onclick="openAuthModal('register'); closeMobileMenu();" class="w-full py-3.5 bg-white text-primary rounded-xl hover:bg-gray-100 transition-colors font-semibold text-center">
                            <i class="fas fa-user-plus mr-2"></i> Daftar
                        </button>
                    </div>
                </div>
                @else
                <div class="border-t border-white/10 pt-4 mt-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center space-x-3 w-full p-4 rounded-xl hover:bg-red-500/20 transition-colors text-white font-medium text-left" onclick="closeMobileMenu()">
                            <i class="fas fa-sign-out-alt w-5 text-center"></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
                @endguest
            </div>
        </div>
    </div>
</nav>

<!-- Logout Confirmation Modal -->
<div id="logoutModal" class="logout-modal fixed inset-0 z-[10000] hidden">
    <div class="logout-modal-overlay absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
    
    <div class="logout-modal-container relative min-h-screen flex items-center justify-center p-4">
        <div class="logout-modal-content bg-white rounded-2xl shadow-2xl w-full max-w-sm transform transition-all duration-300 scale-95 opacity-0">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-100">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-sign-out-alt text-yellow-600"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">Konfirmasi Keluar</h2>
                </div>
                <button onclick="closeLogoutModal()" class="w-8 h-8 rounded-full hover:bg-gray-100 flex items-center justify-center transition-colors">
                    <i class="fas fa-times text-gray-500"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <div class="text-center">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        Yakin ingin keluar?
                    </h3>
                    
                    <p class="text-gray-600 mb-6 text-sm">
                        Anda akan keluar dari akun <span class="font-semibold text-primary">{{ Auth::user()->name ?? 'Anda' }}</span>.
                    </p>

                    <!-- Action Buttons -->
                    <div class="flex space-x-3">
                        <button onclick="closeLogoutModal()" 
                                class="flex-1 px-4 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-all duration-200 text-sm">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Batal
                        </button>
                        <form method="POST" action="{{ route('logout') }}" class="flex-1">
                            @csrf
                            <button type="submit" 
                                    class="w-full px-4 py-3 bg-red-600 text-white rounded-xl font-semibold hover:bg-red-700 transition-all duration-200 text-sm">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Enhanced Mobile Menu Functionality
document.addEventListener('DOMContentLoaded', function() {
    const burgerButton = document.getElementById('burger-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileCloseBtn = document.getElementById('mobile-close-btn');
    const mobileDropdownBtn = document.getElementById('mobile-dropdown-btn');
    const mobileDropdownMenu = document.getElementById('mobile-dropdown-menu');
    const mobileChevron = document.getElementById('mobile-chevron');
    
    // Mobile menu functions
    function openMobileMenu() {
        mobileMenu.classList.remove('transform', '-translate-y-full');
        mobileMenu.classList.add('transform', 'translate-y-0');
        document.body.style.overflow = 'hidden';
        document.documentElement.style.overflow = 'hidden';
    }
    
    function closeMobileMenu() {
        mobileMenu.classList.remove('transform', 'translate-y-0');
        mobileMenu.classList.add('transform', '-translate-y-full');
        document.body.style.overflow = 'auto';
        document.documentElement.style.overflow = 'auto';
        closeMobileDropdown();
    }
    
    function toggleMobileDropdown() {
        const isOpen = mobileDropdownMenu.classList.contains('max-h-96');
        if (isOpen) {
            closeMobileDropdown();
        } else {
            openMobileDropdown();
        }
    }
    
    function openMobileDropdown() {
        mobileDropdownMenu.classList.remove('max-h-0');
        mobileDropdownMenu.classList.add('max-h-96');
        mobileChevron.style.transform = 'rotate(180deg)';
    }
    
    function closeMobileDropdown() {
        mobileDropdownMenu.classList.remove('max-h-96');
        mobileDropdownMenu.classList.add('max-h-0');
        mobileChevron.style.transform = 'rotate(0deg)';
    }
    
    // Event listeners
    burgerButton?.addEventListener('click', function(e) {
        e.stopPropagation();
        if (mobileMenu.classList.contains('-translate-y-full')) {
            openMobileMenu();
        } else {
            closeMobileMenu();
        }
    });
    
    mobileCloseBtn?.addEventListener('click', closeMobileMenu);
    mobileDropdownBtn?.addEventListener('click', toggleMobileDropdown);
    
    // Close mobile menu when clicking on links
    document.querySelectorAll('#mobile-menu a').forEach(link => {
        link.addEventListener('click', closeMobileMenu);
    });
    
    // Close mobile menu when clicking outside
    document.addEventListener('click', function(e) {
        if (!mobileMenu.contains(e.target) && !burgerButton.contains(e.target)) {
            closeMobileMenu();
        }
    });
    
    // Close mobile menu on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeMobileMenu();
        }
    });
});

// Global functions
function closeMobileMenu() {
    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileMenu) {
        mobileMenu.classList.remove('transform', 'translate-y-0');
        mobileMenu.classList.add('transform', '-translate-y-full');
        document.body.style.overflow = 'auto';
        document.documentElement.style.overflow = 'auto';
    }
}

// Logout modal functions
function showLogoutConfirmation() {
    const modal = document.getElementById('logoutModal');
    const modalContent = modal.querySelector('.logout-modal-content');
    
    if (modal) {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        setTimeout(() => {
            modalContent.style.transform = 'scale(1)';
            modalContent.style.opacity = '1';
        }, 10);
    }
}

function closeLogoutModal() {
    const modal = document.getElementById('logoutModal');
    const modalContent = modal.querySelector('.logout-modal-content');
    
    if (modal) {
        modalContent.style.transform = 'scale(0.95)';
        modalContent.style.opacity = '0';
        
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }, 200);
    }
}

// Close modals when clicking outside
document.addEventListener('click', function(event) {
    const logoutModal = document.getElementById('logoutModal');
    if (event.target === logoutModal) {
        closeLogoutModal();
    }
});

// Close modals on escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeLogoutModal();
    }
});
</script>

<style>
/* Enhanced Mobile Menu Styles */
#mobile-menu {
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
}

#mobile-dropdown-menu {
    transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.burger-line {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Smooth scroll for mobile menu */
#mobile-menu {
    scrollbar-width: thin;
    scrollbar-color: rgba(255, 255, 255, 0.3) transparent;
}

#mobile-menu::-webkit-scrollbar {
    width: 4px;
}

#mobile-menu::-webkit-scrollbar-track {
    background: transparent;
}

#mobile-menu::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.3);
    border-radius: 2px;
}

#mobile-menu::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.5);
}

/* Enhanced dropdown animations */
.dropdown-menu {
    transform: translateY(-10px);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.group:hover .dropdown-menu {
    transform: translateY(0);
}

/* Focus states for accessibility */
button:focus-visible,
a:focus-visible {
    outline: 2px solid #4A7C59;
    outline-offset: 2px;
    border-radius: 8px;
}

/* Loading animation */
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

.loading {
    animation: pulse 1.5s infinite;
}

/* Enhanced hover effects */
.hover-lift:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Responsive improvements */
@media (max-width: 1024px) {
    .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }
}

@media (max-width: 640px) {
    .logout-modal-container {
        padding: 1rem;
        align-items: flex-end;
    }
    
    .logout-modal-content {
        margin-bottom: 2rem;
    }
}
</style>