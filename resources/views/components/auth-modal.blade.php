<div id="authModal" class="auth-modal fixed inset-0 z-[9999] hidden">
    <div class="auth-modal-overlay absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
    
    <div class="auth-modal-container relative min-h-screen flex items-center justify-center p-4">
        <div class="auth-modal-content bg-white rounded-2xl shadow-2xl w-full max-w-md max-h-[90vh] overflow-hidden transform transition-all duration-300 scale-95 opacity-0 flex flex-col">
            <!-- Header dengan Close Button -->
            <div class="flex-shrink-0 flex items-center justify-between p-6 border-b border-gray-100">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center">
                        <i class="fas fa-tree text-white text-lg"></i>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900" id="auth-modal-title">Masuk ke Akun</h2>
                </div>
                <button onclick="closeAuthModal()" class="w-8 h-8 rounded-full hover:bg-gray-100 flex items-center justify-center transition-colors">
                    <i class="fas fa-times text-gray-500"></i>
                </button>
            </div>

            <!-- Scrollable Content Area -->
            <div class="flex-1 overflow-y-auto">
                <div class="p-6">
                    <!-- Login Form -->
                    <div id="loginForm" class="auth-form space-y-6">
                        <!-- Google Sign In Button -->
                        <div class="text-center">
                            <a href="{{ route('google.login') }}" 
                               class="google-signin-btn flex items-center justify-center w-full bg-white border-2 border-gray-300 rounded-xl px-6 py-4 text-base font-semibold text-gray-700 hover:border-gray-400 hover:shadow-md transition-all duration-200 group">
                                <div class="google-logo-container mr-4">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                    </svg>
                                </div>
                                <span class="group-hover:scale-105 transition-transform">Lanjutkan dengan Google</span>
                            </a>
                        </div>

                        <!-- Divider -->
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-3 bg-white text-gray-500 font-medium">Atau masuk dengan email</span>
                            </div>
                        </div>

                        <!-- Email Login Form -->
                        <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
                            @csrf
                            <div class="space-y-2">
                                <label for="loginEmail" class="block text-sm font-semibold text-gray-700">Alamat Email</label>
                                <div class="relative">
                                    <input type="email" id="loginEmail" name="email" required 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 placeholder-gray-400"
                                           placeholder="nama@email.com"
                                           value="{{ old('email') }}">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i class="fas fa-envelope text-gray-400"></i>
                                    </div>
                                </div>
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                            
                            <div class="space-y-2">
                                <label for="loginPassword" class="block text-sm font-semibold text-gray-700">Password</label>
                                <div class="relative">
                                    <input type="password" id="loginPassword" name="password" required 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 placeholder-gray-400"
                                           placeholder="Masukkan password">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                </div>
                                @error('password')
                                    <p class="text-red-500 text-sm mt-1 flex items-center">
                                        <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <button type="submit" class="w-full bg-primary text-white py-4 rounded-xl font-semibold hover:bg-green-700 transition-all duration-200 transform hover:scale-[1.02] shadow-lg hover:shadow-xl flex items-center justify-center space-x-2">
                                <i class="fas fa-sign-in-alt"></i>
                                <span>Masuk ke Akun</span>
                            </button>
                        </form>

                        <!-- Footer Login -->
                        <div class="text-center pt-4">
                            <p class="text-gray-600">
                                Belum punya akun? 
                                <button onclick="switchToRegister()" class="text-primary font-semibold hover:text-green-700 transition-colors ml-1">
                                    Daftar di sini
                                </button>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Register Form -->
                    <div id="registerForm" class="auth-form space-y-6 hidden">
                        <!-- Google Sign Up Button -->
                        <div class="text-center">
                            <a href="{{ route('google.login') }}" 
                               class="google-signin-btn flex items-center justify-center w-full bg-white border-2 border-gray-300 rounded-xl px-6 py-4 text-base font-semibold text-gray-700 hover:border-gray-400 hover:shadow-md transition-all duration-200 group">
                                <div class="google-logo-container mr-4">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                    </svg>
                                </div>
                                <span class="group-hover:scale-105 transition-transform">Daftar dengan Google</span>
                            </a>
                        </div>

                        <!-- Divider -->
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-3 bg-white text-gray-500 font-medium">Atau daftar dengan email</span>
                            </div>
                        </div>

                        <!-- Email Register Form -->
<form method="POST" action="{{ route('register.post') }}" class="space-y-5">
    @csrf
    <div class="space-y-2">
        <label for="registerName" class="block text-sm font-semibold text-gray-700">Nama Lengkap</label>
        <div class="relative">
            <input type="text" id="registerName" name="name" required 
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 placeholder-gray-400"
                   placeholder="Masukkan nama lengkap"
                   value="{{ old('name') }}">
            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                <i class="fas fa-user text-gray-400"></i>
            </div>
        </div>
        @error('name')
            <p class="text-red-500 text-sm mt-1 flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
            </p>
        @enderror
    </div>

    <div class="space-y-2">
        <label for="registerEmail" class="block text-sm font-semibold text-gray-700">Alamat Email</label>
        <div class="relative">
            <input type="email" id="registerEmail" name="email" required 
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 placeholder-gray-400"
                   placeholder="nama@email.com"
                   value="{{ old('email') }}">
            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                <i class="fas fa-envelope text-gray-400"></i>
            </div>
        </div>
        @error('email')
            <p class="text-red-500 text-sm mt-1 flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
            </p>
        @enderror
    </div>

    <div class="space-y-2">
        <label for="registerPassword" class="block text-sm font-semibold text-gray-700">Password</label>
        <div class="relative">
            <input type="password" id="registerPassword" name="password" required 
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 placeholder-gray-400"
                   placeholder="Buat password (min. 8 karakter)">
            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                <i class="fas fa-lock text-gray-400"></i>
            </div>
        </div>
        @error('password')
            <p class="text-red-500 text-sm mt-1 flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
            </p>
        @enderror
    </div>

    <div class="space-y-2">
        <label for="registerPasswordConfirmation" class="block text-sm font-semibold text-gray-700">Konfirmasi Password</label>
        <div class="relative">
            <input type="password" id="registerPasswordConfirmation" name="password_confirmation" required 
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 placeholder-gray-400"
                   placeholder="Ulangi password">
            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                <i class="fas fa-lock text-gray-400"></i>
            </div>
        </div>
    </div>

    <button type="submit" class="w-full bg-primary text-white py-4 rounded-xl font-semibold hover:bg-green-700 transition-all duration-200 transform hover:scale-[1.02] shadow-lg hover:shadow-xl flex items-center justify-center space-x-2">
        <i class="fas fa-user-plus"></i>
        <span>Buat Akun Baru</span>
    </button>
</form>     

                        <!-- Footer Register -->
                        <div class="text-center pt-4 pb-2">
                            <p class="text-gray-600">
                                Sudah punya akun? 
                                <button onclick="switchToLogin()" class="text-primary font-semibold hover:text-green-700 transition-colors ml-1">
                                    Masuk di sini
                                </button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Auth Modal Styles */
.auth-modal {
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.auth-modal-content {
    animation: modalSlideIn 0.3s ease-out forwards;
}

@keyframes modalSlideIn {
    to {
        transform: scale(1);
        opacity: 1;
    }
}

/* Scrollbar Styling for Modal */
.auth-modal-content::-webkit-scrollbar {
    width: 6px;
}

.auth-modal-content::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.auth-modal-content::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

.auth-modal-content::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Google Button Styles */
.google-signin-btn {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.google-signin-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.google-logo-container {
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.google-signin-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(66, 133, 244, 0.1), transparent);
    transition: left 0.5s;
}

.google-signin-btn:hover::before {
    left: 100%;
}

/* Form Input Styles */
.auth-form input:focus {
    box-shadow: 0 0 0 3px rgba(45, 79, 43, 0.1);
}

.auth-form input::placeholder {
    color: #9CA3AF;
    font-weight: 400;
}

/* Button Styles */
.auth-form button[type="submit"] {
    position: relative;
    overflow: hidden;
}

.auth-form button[type="submit"]::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.auth-form button[type="submit"]:hover::after {
    left: 100%;
}

/* Error States */
.auth-form input:invalid:not(:focus):not(:placeholder-shown) {
    border-color: #EF4444;
}

.auth-form input:valid:not(:focus):not(:placeholder-shown) {
    border-color: #10B981;
}

/* Responsive Design for Mobile */
@media (max-width: 640px) {
    .auth-modal-container {
        padding: 0.5rem;
        align-items: flex-start;
        padding-top: 1rem;
    }
    
    .auth-modal-content {
        max-height: 95vh;
        margin-top: 1rem;
    }
    
    .auth-modal-content .p-6 {
        padding: 1rem;
    }
    
    .google-signin-btn {
        padding: 0.75rem 1rem;
    }
    
    .auth-form input {
        padding: 0.75rem 1rem;
    }
    
    .auth-form button[type="submit"] {
        padding: 0.75rem 1rem;
    }
}

/* Extra Small Devices */
@media (max-width: 400px) {
    .auth-modal-content {
        max-height: 98vh;
        border-radius: 1rem;
    }
    
    .auth-modal-content .p-6 {
        padding: 0.75rem;
    }
    
    .auth-form .space-y-5 {
        gap: 1rem;
    }
    
    .google-signin-btn span {
        font-size: 0.9rem;
    }
}

/* Backdrop Animation */
.auth-modal-overlay {
    animation: fadeIn 0.3s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Form Transition */
.auth-form {
    transition: opacity 0.3s ease-in-out;
}

.auth-form.hidden {
    display: none;
}

/* Focus States for Accessibility */
.google-signin-btn:focus {
    outline: 2px solid #2D4F2B;
    outline-offset: 2px;
}

.auth-form input:focus {
    outline: none;
}

/* Ensure modal is always properly sized */
.auth-modal-container {
    min-height: 100vh;
}

.auth-modal-content {
    min-height: auto;
}

/* Prevent body scroll when modal is open */
body.modal-open {
    overflow: hidden;
}
</style>

<script>
// Enhanced Auth Modal Functions with Scroll Management
function openAuthModal(type = 'login') {
    const modal = document.getElementById('authModal');
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const modalTitle = document.getElementById('auth-modal-title');
    const modalContent = modal.querySelector('.auth-modal-content');
    const scrollableContent = modal.querySelector('.overflow-y-auto');
    
    if (modal) {
        modal.classList.remove('hidden');
        document.body.classList.add('modal-open');
        
        // Reset animation
        modalContent.style.transform = 'scale(0.95)';
        modalContent.style.opacity = '0';
        
        // Reset scroll position
        if (scrollableContent) {
            scrollableContent.scrollTop = 0;
        }
        
        // Force reflow
        void modalContent.offsetWidth;
        
        // Start animation
        setTimeout(() => {
            modalContent.style.transform = 'scale(1)';
            modalContent.style.opacity = '1';
        }, 10);
        
        if (type === 'login') {
            if (loginForm) {
                loginForm.classList.remove('hidden');
                modalTitle.textContent = 'Masuk ke Akun';
            }
            if (registerForm) registerForm.classList.add('hidden');
        } else {
            if (registerForm) {
                registerForm.classList.remove('hidden');
                modalTitle.textContent = 'Daftar Akun Baru';
                
                // Ensure register form is properly visible
                setTimeout(() => {
                    const firstInput = registerForm.querySelector('input');
                    if (firstInput) {
                        firstInput.focus();
                    }
                }, 100);
            }
            if (loginForm) loginForm.classList.add('hidden');
        }
        
        // Close mobile menu if open
        if (typeof closeMobileMenu === 'function') {
            closeMobileMenu();
        }
    }
}

function closeAuthModal() {
    const modal = document.getElementById('authModal');
    const modalContent = modal.querySelector('.auth-modal-content');
    
    if (modal) {
        // Animate out
        modalContent.style.transform = 'scale(0.95)';
        modalContent.style.opacity = '0';
        
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.classList.remove('modal-open');
        }, 200);
    }
}

function switchToRegister() {
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const modalTitle = document.getElementById('auth-modal-title');
    const scrollableContent = document.querySelector('.auth-modal-content .overflow-y-auto');
    
    if (loginForm && registerForm) {
        loginForm.classList.add('hidden');
        registerForm.classList.remove('hidden');
        modalTitle.textContent = 'Daftar Akun Baru';
        
        // Reset scroll position when switching forms
        if (scrollableContent) {
            scrollableContent.scrollTop = 0;
        }
        
        // Focus on first input
        setTimeout(() => {
            const firstInput = registerForm.querySelector('input');
            if (firstInput) {
                firstInput.focus();
            }
        }, 50);
    }
}

function switchToLogin() {
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const modalTitle = document.getElementById('auth-modal-title');
    const scrollableContent = document.querySelector('.auth-modal-content .overflow-y-auto');
    
    if (loginForm && registerForm) {
        registerForm.classList.add('hidden');
        loginForm.classList.remove('hidden');
        modalTitle.textContent = 'Masuk ke Akun';
        
        // Reset scroll position when switching forms
        if (scrollableContent) {
            scrollableContent.scrollTop = 0;
        }
        
        // Focus on first input
        setTimeout(() => {
            const firstInput = loginForm.querySelector('input');
            if (firstInput) {
                firstInput.focus();
            }
        }, 50);
    }
}

// Close modal when clicking outside
document.addEventListener('click', function(event) {
    const modal = document.getElementById('authModal');
    const modalContent = modal.querySelector('.auth-modal-content');
    
    if (event.target === modal || event.target.classList.contains('auth-modal-overlay')) {
        closeAuthModal();
    }
});

// Close modal on escape key
document.addEventListener('keydown', function(event) {
    const modal = document.getElementById('authModal');
    
    if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
        closeAuthModal();
    }
});

// Prevent modal from closing when clicking inside content
document.addEventListener('click', function(event) {
    const modal = document.getElementById('authModal');
    const modalContent = modal.querySelector('.auth-modal-content');
    
    if (modalContent.contains(event.target)) {
        event.stopPropagation();
    }
});

// Enhanced input interactions
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.auth-form input');
    
    inputs.forEach(input => {
        // Add focus effects
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
        
        // Add real-time validation feedback
        input.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                this.classList.add('has-value');
            } else {
                this.classList.remove('has-value');
            }
        });
    });
});

// Handle window resize for better mobile experience
window.addEventListener('resize', function() {
    const modal = document.getElementById('authModal');
    if (!modal.classList.contains('hidden')) {
        // Ensure modal stays properly sized on resize
        const modalContent = modal.querySelector('.auth-modal-content');
        modalContent.style.maxHeight = '90vh';
    }
});
</script>