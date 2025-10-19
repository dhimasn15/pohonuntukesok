<!-- Navigation -->
<nav class="fixed w-full bg-primary text-white shadow-md z-50 transition-all duration-300" id="main-nav">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <a href="{{route('home')}}" class="flex items-center text-2xl font-bold hover-target">
            <i class="fas fa-tree mr-2"></i>
            <span>PohonUntukEsok</span>
        </a>
        
        <!-- Burger Button -->
        <button id="burger-button" class="lg:hidden flex flex-col justify-center items-center w-10 h-10 relative z-50" aria-label="Toggle Menu">
            <span class="block w-7 h-1 bg-white rounded transition-all duration-300 mb-1 burger-line"></span>
            <span class="block w-7 h-1 bg-white rounded transition-all duration-300 mb-1 burger-line"></span>
            <span class="block w-7 h-1 bg-white rounded transition-all duration-300 burger-line"></span>
        </button>
        
        <!-- Desktop Menu -->
        <div class="hidden lg:flex items-center space-x-8">
            <a href="{{route('home')}}" class="hover:text-accent transition-colors flex items-center group">
                <i class="fas fa-home mr-2"></i> Beranda
            </a>
            <div class="relative group">
                <button class="hover:text-accent transition-colors flex items-center">
                    <i class="fas fa-seedling mr-2"></i> Mulai Dari Kamu
                    <i class="fas fa-chevron-down ml-1 text-xs transition-transform duration-300 group-hover:rotate-180"></i>
                </button>
                <div class="dropdown-menu absolute left-0 mt-2 w-56 bg-white rounded-md shadow-lg py-2 z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                    <a href="{{route('buat')}}" class="block px-4 py-2 text-gray-800 hover:bg-green-50 hover:text-primary transition-colors">
                        <i class="fas fa-plus-circle text-primary mr-2"></i>Buat Kampanye
                    </a>
                    <div class="border-t my-1"></div>
                    <a href="{{route('donasi')}}" class="block px-4 py-2 text-gray-800 hover:bg-green-50 hover:text-primary transition-colors">
                        <i class="fas fa-hand-holding-heart text-primary mr-2"></i>Donasi Pohon
                    </a>
                    <div class="border-t my-1"></div>
                    <a href="{{route ('kampanye')}}" class="block px-4 py-2 text-gray-800 hover:bg-green-50 hover:text-primary transition-colors">
                        <i class="fas fa-list-ul text-primary mr-2"></i>Daftar Kampanye
                    </a>
                </div>
            </div>
            <a href="{{ route('about')}}" class="hover:text-accent transition-colors flex items-center group">
                <i class="fas fa-info-circle mr-2"></i> Tentang Kami
            </a>
            <a href="{{ route('blog')}}" class="hover:text-accent transition-colors flex items-center group">
                <i class="fas fa-newspaper mr-2"></i> Blog
            </a>
            
            <!-- Authentication Section -->
            @auth
                <div class="flex items-center space-x-4 ml-8">
                    <div class="flex items-center space-x-2">
                        @php
                            // Generate avatar URL dengan fallback yang lebih baik
                            $avatarUrl = Auth::user()->avatar;
                            
                            // Jika avatar kosong atau null, buat avatar dari initial
                            if (empty($avatarUrl) || $avatarUrl === 'null' || $avatarUrl === '') {
                                $initial = strtoupper(substr(Auth::user()->name, 0, 1));
                                $avatarUrl = "https://ui-avatars.com/api/?name=" . urlencode(Auth::user()->name) . "&background=2D4F2B&color=ffffff&size=64&bold=true";
                            }
                        @endphp
                        
                        <img src="{{ $avatarUrl }}" 
                             alt="{{ Auth::user()->name }}" 
                             class="w-8 h-8 rounded-full object-cover border-2 border-white/50 hover:border-accent transition-colors"
                             onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2D4F2B&color=ffffff&size=64&bold=true'">
                        <span class="text-white">{{ Auth::user()->name }}</span>
                    </div>
                    <button onclick="showLogoutConfirmation()" class="px-4 py-2 border border-white rounded-lg hover:bg-white hover:text-primary transition-colors">
                        <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                    </button>
                </div>
            @else
                <div class="flex space-x-4 ml-8">
                    <button onclick="openAuthModal('login')" class="px-4 py-2 border border-white rounded-lg hover:bg-white hover:text-primary transition-colors ripple-btn">
                        <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                    </button>
                    <button onclick="openAuthModal('register')" class="px-4 py-2 bg-white text-primary font-bold rounded-lg hover:bg-gray-100 transition-colors shimmer-btn">
                        <i class="fas fa-user-plus mr-2"></i> Daftar
                    </button>
                </div>
            @endauth
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="fixed inset-0 bg-primary bg-opacity-95 z-40 transition-all duration-300 transform -translate-y-full">
        <div class="container mx-auto px-4 h-full overflow-y-auto pt-24 pb-8">
            <div class="flex flex-col items-center space-y-6 text-xl font-semibold text-white">
                
                <a href="{{route('home')}}" class="w-full text-center py-3 hover:text-accent transition-colors border-b border-white/20" onclick="closeMobileMenu()">
                    <i class="fas fa-home mr-3"></i> Beranda
                </a>
                
                <div class="w-full border-b border-white/20 pb-4">
                    <button id="mobile-dropdown-btn" class="w-full text-center py-3 flex items-center justify-center hover:text-accent transition-colors">
                        <i class="fas fa-seedling mr-3"></i> 
                        Mulai Dari Kamu 
                        <i class="fas fa-chevron-down ml-2 transition-transform duration-300" id="mobile-chevron"></i>
                    </button>
                    <div id="mobile-dropdown-menu" class="w-full flex flex-col items-center space-y-3 mt-3 max-h-0 overflow-hidden transition-all duration-300">
                        <a href="{{route('buat')}}" class="py-2 hover:text-accent transition-colors w-full text-center bg-white/10 rounded-lg mx-2" onclick="closeMobileMenu()">
                            <i class="fas fa-plus-circle mr-3"></i>Buat Kampanye
                        </a>
                        <a href="{{route('donasi')}}" class="py-2 hover:text-accent transition-colors w-full text-center bg-white/10 rounded-lg mx-2" onclick="closeMobileMenu()">
                            <i class="fas fa-hand-holding-heart mr-3"></i>Donasi Pohon
                        </a>
                        <a href="{{route ('kampanye')}}" class="py-2 hover:text-accent transition-colors w-full text-center bg-white/10 rounded-lg mx-2" onclick="closeMobileMenu()">
                            <i class="fas fa-list-ul mr-3"></i>Daftar Kampanye
                        </a>
                    </div>
                </div>
                
                <a href="{{ route('about')}}" class="w-full text-center py-3 hover:text-accent transition-colors border-b border-white/20" onclick="closeMobileMenu()">
                    <i class="fas fa-info-circle mr-3"></i> Tentang Kami
                </a>
                
                <a href="{{ route('blog')}}" class="w-full text-center py-3 hover:text-accent transition-color" onclick="closeMobileMenu()">
                    <i class="fas fa-newspaper mr-3"></i> Blog
                </a>
                
                <!-- Mobile Authentication Section -->
                <div class="w-full pt-6 border-t border-white/20">
                    @auth
                        <div class="flex flex-col items-center space-y-4 w-full">
                            <div class="flex items-center space-x-3 bg-white/10 rounded-lg px-4 py-3 w-full">
                                @php
                                    // Generate avatar URL untuk mobile juga
                                    $avatarUrlMobile = Auth::user()->avatar;
                                    if (empty($avatarUrlMobile) || $avatarUrlMobile === 'null' || $avatarUrlMobile === '') {
                                        $avatarUrlMobile = "https://ui-avatars.com/api/?name=" . urlencode(Auth::user()->name) . "&background=2D4F2B&color=ffffff&size=64&bold=true";
                                    }
                                @endphp
                                
                                <img src="{{ $avatarUrlMobile }}" 
                                     alt="{{ Auth::user()->name }}" 
                                     class="w-10 h-10 rounded-full object-cover border-2 border-white/50"
                                     onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2D4F2B&color=ffffff&size=64&bold=true'">
                                <span class="text-white text-lg">{{ Auth::user()->name }}</span>
                            </div>
                            <button onclick="showLogoutConfirmation(); closeMobileMenu();" class="px-6 py-3 border-2 border-white rounded-lg hover:bg-white hover:text-primary transition-colors w-full text-lg font-bold">
                                <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                            </button>
                        </div>
                    @else
                        <div class="flex flex-col gap-4 w-full">
                            <button onclick="openAuthModal('login'); closeMobileMenu();" class="px-6 py-4 border-2 border-white rounded-lg hover:bg-white hover:text-primary transition-colors text-center text-lg font-bold">
                                <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                            </button>
                            <button onclick="openAuthModal('register'); closeMobileMenu();" class="px-6 py-4 bg-white text-primary rounded-lg hover:bg-gray-100 transition-colors text-center text-lg font-bold">
                                <i class="fas fa-user-plus mr-2"></i> Daftar
                            </button>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Logout Confirmation Modal -->
<div id="logoutModal" class="logout-modal fixed inset-0 z-[10000] hidden">
    <div class="logout-modal-overlay absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
    
    <div class="logout-modal-container relative min-h-screen flex items-center justify-center p-4">
        <div class="logout-modal-content bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all duration-300 scale-95 opacity-0">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-100">
                <div class="flex items-center space-x-3">
                    <h2 class="text-xl font-bold text-gray-900">Konfirmasi Keluar</h2>
                </div>
                <button onclick="closeLogoutModal()" class="w-8 h-8 rounded-full hover:bg-gray-100 flex items-center justify-center transition-colors">
                    <i class="fas fa-times text-gray-500"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <div class="text-center">
                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-sign-out-alt text-yellow-600 text-2xl"></i>
                    </div>
                    
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        Yakin ingin keluar?
                    </h3>
                    
                    <p class="text-gray-600 mb-6">
                        Anda akan keluar dari akun {{ Auth::user()->name ?? 'Anda' }}. 
                        Untuk masuk kembali, Anda perlu login untuk mengakses fitur tertentu.</p>

                    <!-- Action Buttons -->
                    <div class="flex space-x-3">
                        <button onclick="closeLogoutModal()" 
                                class="flex-1 px-4 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-all duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Batal
                        </button>
                        <form method="POST" action="{{ route('logout') }}" class="flex-1">
                            @csrf
                            <button type="submit" 
                                    class="w-full px-4 py-3 bg-red-600 text-white rounded-xl font-semibold hover:bg-red-700 transition-all duration-200 transform hover:scale-[1.02]">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Ya, Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Mobile menu functionality
document.addEventListener('DOMContentLoaded', function() {
    const burgerButton = document.getElementById('burger-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileCloseBtn = document.getElementById('mobile-close-btn');
    const mobileDropdownBtn = document.getElementById('mobile-dropdown-btn');
    const mobileDropdownMenu = document.getElementById('mobile-dropdown-menu');
    const mobileChevron = document.getElementById('mobile-chevron');
    
    // Function to open mobile menu
    function openMobileMenu() {
        mobileMenu.classList.remove('transform', '-translate-y-full');
        mobileMenu.classList.add('transform', 'translate-y-0');
        document.body.style.overflow = 'hidden';
    }
    
    // Function to close mobile menu
    function closeMobileMenu() {
        mobileMenu.classList.remove('transform', 'translate-y-0');
        mobileMenu.classList.add('transform', '-translate-y-full');
        document.body.style.overflow = 'auto';
        
        // Reset burger animation
        burgerButton.classList.remove('active');
        const spans = burgerButton.querySelectorAll('.burger-line');
        spans[0].style.transform = 'none';
        spans[1].style.opacity = '1';
        spans[2].style.transform = 'none';
        
        // Close dropdown if open
        closeMobileDropdown();
    }
    
    // Function to toggle mobile dropdown
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
    
    // Toggle mobile menu with burger button
    burgerButton?.addEventListener('click', function(e) {
        e.stopPropagation();
        
        if (mobileMenu.classList.contains('-translate-y-full')) {
            openMobileMenu();
            burgerButton.classList.add('active');
            
            // Burger animation
            const spans = this.querySelectorAll('.burger-line');
            spans[0].style.transform = 'translateY(9px) rotate(45deg)';
            spans[1].style.opacity = '0';
            spans[2].style.transform = 'translateY(-9px) rotate(-45deg)';
        } else {
            closeMobileMenu();
        }
    });
    
    // Close mobile menu with close button
    mobileCloseBtn?.addEventListener('click', function(e) {
        e.stopPropagation();
        closeMobileMenu();
    });
    
    // Toggle dropdown on mobile
    mobileDropdownBtn?.addEventListener('click', function(e) {
        e.stopPropagation();
        toggleMobileDropdown();
    });
    
    // Close mobile menu when clicking on links (with delay for smooth transition)
    document.querySelectorAll('#mobile-menu a').forEach(link => {
        link.addEventListener('click', function(e) {
            if (!this.classList.contains('no-close')) {
                setTimeout(closeMobileMenu, 300);
            }
        });
    });
    
    // Close mobile menu when clicking outside
    document.addEventListener('click', function(e) {
        if (!mobileMenu.contains(e.target) && !burgerButton.contains(e.target)) {
            if (!mobileMenu.classList.contains('-translate-y-full')) {
                closeMobileMenu();
            }
        }
    });
    
    // Close mobile menu on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !mobileMenu.classList.contains('-translate-y-full')) {
            closeMobileMenu();
        }
    });
    
    // Ripple effect for buttons
    const rippleButtons = document.querySelectorAll('.ripple-btn');
    rippleButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            ripple.style.left = `${x}px`;
            ripple.style.top = `${y}px`;
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
});

// Make functions globally available
function closeMobileMenu() {
    const mobileMenu = document.getElementById('mobile-menu');
    const burgerButton = document.getElementById('burger-button');
    
    if (mobileMenu) {
        mobileMenu.classList.remove('transform', 'translate-y-0');
        mobileMenu.classList.add('transform', '-translate-y-full');
        document.body.style.overflow = 'auto';
        
        if (burgerButton) {
            burgerButton.classList.remove('active');
            const spans = burgerButton.querySelectorAll('.burger-line');
            spans[0].style.transform = 'none';
            spans[1].style.opacity = '1';
            spans[2].style.transform = 'none';
        }
    }
}

// Auth Modal Functions
function openAuthModal(type = 'login') {
    const modal = document.getElementById('authModal');
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    
    if (modal) {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
        
        if (type === 'login') {
            if (loginForm) loginForm.classList.remove('hidden');
            if (registerForm) registerForm.classList.add('hidden');
        } else {
            if (loginForm) loginForm.classList.add('hidden');
            if (registerForm) registerForm.classList.remove('hidden');
        }
        
        // Close mobile menu if open
        closeMobileMenu();
    }
}

function closeAuthModal() {
    const modal = document.getElementById('authModal');
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
}

function switchToRegister() {
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    if (loginForm && registerForm) {
        loginForm.classList.add('hidden');
        registerForm.classList.remove('hidden');
    }
}

function switchToLogin() {
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    if (loginForm && registerForm) {
        registerForm.classList.add('hidden');
        loginForm.classList.remove('hidden');
    }
}

// Logout Confirmation Functions
function showLogoutConfirmation() {
    const modal = document.getElementById('logoutModal');
    const modalContent = modal.querySelector('.logout-modal-content');
    
    if (modal) {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        // Reset animation
        modalContent.style.transform = 'scale(0.95)';
        modalContent.style.opacity = '0';
        
        // Force reflow
        void modalContent.offsetWidth;
        
        // Start animation
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
        // Animate out
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
    const authModal = document.getElementById('authModal');
    const logoutModal = document.getElementById('logoutModal');
    
    if (event.target === authModal) {
        closeAuthModal();
    }
    
    if (event.target === logoutModal) {
        closeLogoutModal();
    }
});

// Close modals on escape key
document.addEventListener('keydown', function(event) {
    const authModal = document.getElementById('authModal');
    const logoutModal = document.getElementById('logoutModal');
    
    if (event.key === 'Escape') {
        if (!authModal.classList.contains('hidden')) {
            closeAuthModal();
        }
        if (!logoutModal.classList.contains('hidden')) {
            closeLogoutModal();
        }
    }
});
</script>

<style>
/* Additional styles for mobile menu */
#mobile-menu {
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

#mobile-dropdown-menu {
    transition: max-height 0.3s ease-in-out;
}

.burger-line {
    transition: all 0.3s ease-in-out;
}

/* Smooth transitions */
#mobile-menu,
#mobile-dropdown-menu {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Prevent body scroll when menu is open */
body.menu-open {
    overflow: hidden;
}

/* Ripple effect styles */
.ripple-btn {
    position: relative;
    overflow: hidden;
}

.ripple-btn span.ripple {
    position: absolute;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.4);
    transform: scale(0);
    animation: ripple 0.6s linear;
    pointer-events: none;
}

@keyframes ripple {
    to {
        transform: scale(2.5);
        opacity: 0;
    }
}

/* Logout Modal Styles */
.logout-modal {
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.logout-modal-content {
    animation: modalSlideIn 0.3s ease-out forwards;
}

@keyframes modalSlideIn {
    to {
        transform: scale(1);
        opacity: 1;
    }
}

/* Responsive Design for Logout Modal */
@media (max-width: 640px) {
    .logout-modal-container {
        padding: 1rem;
        align-items: flex-end;
    }
    
    .logout-modal-content {
        margin-bottom: 2rem;
    }
    
    .logout-modal-content .p-6 {
        padding: 1.5rem;
    }
    
    .logout-modal-content .flex.space-x-3 {
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .logout-modal-content .flex.space-x-3 button {
        flex: none;
    }
}

/* Backdrop Animation */
.logout-modal-overlay {
    animation: fadeIn 0.3s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Button hover effects for logout modal */
.logout-modal-content button {
    transition: all 0.2s ease-in-out;
}

.logout-modal-content button:hover {
    transform: translateY(-1px);
}
</style>