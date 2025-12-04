<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Buat Kampanye Baru - PohonUntukEsok</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo-tittle.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/logo-tittle.png') }}">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AOS Animation Library -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- GSAP for advanced animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2D4F2B',
                        secondary: '#81C784',
                        accent: '#FFAB00',
                        lightbg: '#FFF1CA',
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 3s ease-in-out infinite',
                        'fade-in': 'fadeIn 1s ease-in',
                        'bounce-slow': 'bounce 3s infinite',
                        'pulse-slow': 'pulse 3s infinite',
                        'wiggle': 'wiggle 1s ease-in-out infinite',
                        'slide-in': 'slideIn 1s ease-out',
                        'scale': 'scale 0.5s ease-in-out',
                        'leaf-fall': 'leafFall 10s linear infinite',
                        'ripple': 'ripple 2s linear infinite',
                        'shine': 'shine 3s linear infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        wiggle: {
                            '0%, 100%': { transform: 'rotate(-3deg)' },
                            '50%': { transform: 'rotate(3deg)' },
                        },
                        slideIn: {
                            '0%': { transform: 'translateX(-100%)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' },
                        },
                        scale: {
                            '0%': { transform: 'scale(0.8)', opacity: '0' },
                            '100%': { transform: 'scale(1)', opacity: '1' },
                        },
                        leafFall: {
                            '0%': { transform: 'translateY(-100px) rotate(0deg)', opacity: '0' },
                            '10%': { opacity: '1' },
                            '90%': { opacity: '0.8' },
                            '100%': { transform: 'translateY(100vh) rotate(360deg)', opacity: '0' },
                        },
                        ripple: {
                            '0%': { transform: 'scale(0.8)', opacity: '1' },
                            '100%': { transform: 'scale(2.5)', opacity: '0' },
                        },
                        shine: {
                            '0%': { transform: 'translateX(-100%) skewX(-15deg)' },
                            '100%': { transform: 'translateX(200%) skewX(-15deg)' },
                        }
                    }
                }
            }
        }
    </script>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Hero Gradient */
        .hero-gradient {
            background: linear-gradient(135deg, #1a3a1a 0%, #2D4F2B 50%, #3d6b3a 100%);
        }

        /* Card Modern */
        .card-modern {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .card-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.5s;
        }

        .card-modern:hover::before {
            left: 100%;
        }

        .card-modern:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(45, 79, 43, 0.25);
        }

        /* Floating Shapes */
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
            z-index: 2;
        }

        .shape {
            position: absolute;
            opacity: 0.3;
            animation: floatShape 20s infinite ease-in-out;
            z-index: 2;
        }

        @keyframes floatShape {
            0%, 100% { 
                transform: translateY(0) rotate(0deg) scale(1);
            }
            25% { 
                transform: translateY(-40px) rotate(90deg) scale(1.1);
            }
            50% { 
                transform: translateY(-80px) rotate(180deg) scale(1);
            }
            75% { 
                transform: translateY(-40px) rotate(270deg) scale(0.9);
            }
        }

        .shape-1 { top: 20%; left: 10%; animation-delay: 0s; font-size: 3rem; }
        .shape-2 { top: 60%; left: 30%; animation-delay: -5s; font-size: 2.5rem; }
        .shape-3 { top: 40%; left: 50%; animation-delay: -10s; font-size: 4rem; }
        .shape-4 { top: 80%; left: 70%; animation-delay: -15s; font-size: 2rem; }
        .shape-5 { top: 30%; left: 90%; animation-delay: -20s; font-size: 3.5rem; }

        /* Organic shapes */
        .organic-shape {
            position: absolute;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            background: rgba(129, 199, 132, 0.1);
            animation: morphing 15s ease-in-out infinite;
        }

        @keyframes morphing {
            0% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
            25% { border-radius: 58% 42% 75% 25% / 76% 46% 54% 24%; }
            50% { border-radius: 50% 50% 33% 67% / 55% 27% 73% 45%; }
            75% { border-radius: 33% 67% 58% 42% / 63% 68% 32% 37%; }
            100% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
        }

        /* Enhanced glass effect */
        .enhanced-glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        /* Mobile Menu Styles */
        #mobile-menu {
            transform: translateY(-100%);
            transition: all 0.3s ease-in-out;
            opacity: 0;
            pointer-events: none;
            height: 100vh;
            overflow-y: auto;
        }

        #mobile-menu.active {
            transform: translateY(0);
            opacity: 1;
            pointer-events: auto;
        }

        /* Mobile Dropdown Menu */
        #mobile-dropdown-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
            opacity: 0;
        }

        #mobile-dropdown-menu.show {
            max-height: 300px;
            opacity: 1;
        }

        /* Burger Button Animation */
        #burger-button span {
            transition: all 0.3s ease-in-out;
        }

        #burger-button.active span:first-child {
            transform: translateY(8px) rotate(45deg);
        }

        #burger-button.active span:nth-child(2) {
            opacity: 0;
        }

        #burger-button.active span:last-child {
            transform: translateY(-8px) rotate(-45deg);
        }

        /* Form styling */
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #2D4F2B;
        }
        
        .form-input {
            width: 100%;
            padding: 0.85rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.625rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background-color: #ffffff;
            font-size: 0.95rem;
            font-family: inherit;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        
        .form-input:hover {
            border-color: #d1d5db;
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.08);
        }
        
        .form-input:focus {
            outline: none;
            border-color: #81C784;
            box-shadow: 0 0 0 4px rgba(129, 199, 132, 0.15), 0 2px 8px 0 rgba(129, 199, 132, 0.2);
            transform: translateY(-1px);
        }
        
        /* Enhanced Dropdown Styling */
        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%23666' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.85rem center;
            background-size: 1.25rem;
            padding-right: 2.75rem;
            cursor: pointer;
            position: relative;
        }
        
        .form-select:focus {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%232D4F2B' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        }
        
        .form-select:disabled {
            background-color: #f3f4f6;
            border-color: #e5e7eb;
            color: #9ca3af;
            cursor: not-allowed;
            opacity: 0.7;
        }
        
        .form-select:disabled:hover {
            border-color: #e5e7eb;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        
        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        .file-upload {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }
        
        .file-upload-btn {
            display: block;
            padding: 1rem;
            background-color: #f9fafb;
            border: 2px dashed #d1d5db;
            border-radius: 0.75rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .file-upload-btn:hover {
            border-color: #81C784;
            background-color: #f0f9f0;
            transform: translateY(-2px);
        }
        
        .file-upload input[type="file"] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
        
        .preview-image {
            max-width: 100%;
            max-height: 200px;
            margin-top: 1rem;
            border-radius: 0.75rem;
            display: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        /* Step Indicator */
        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin: 2rem auto 3rem;
            position: relative;
            padding: 0 2rem;
            max-width: 600px;
        }
        
        .step-container {
            position: relative;
            flex: 1;
            text-align: center;
        }
        
        .step-container:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 20px;
            left: calc(50% + 25px);
            right: calc(-50% + 25px);
            height: 3px;
            background: linear-gradient(90deg, #81C784, #e5e7eb);
            z-index: 1;
            transition: all 0.3s ease;
        }
        
        .step-container.completed:not(:last-child)::after {
            background: linear-gradient(90deg, #81C784, #2D4F2B);
        }
        
        .step {
            position: relative;
            z-index: 2;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: white;
            border: 3px solid #e5e7eb;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #6b7280;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .step.active {
            background: linear-gradient(135deg, #2D4F2B, #3d6b3a);
            border-color: #2D4F2B;
            color: white;
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(45, 79, 43, 0.3);
        }
        
        .step.completed {
            background: linear-gradient(135deg, #81C784, #4CAF50);
            border-color: #81C784;
            color: white;
        }
        
        .step-label {
            position: absolute;
            width: 100%;
            left: 0;
            top: calc(100% + 12px);
            font-size: 0.875rem;
            font-weight: 500;
            color: #6b7280;
            text-align: center;
            transition: all 0.3s ease;
            padding: 0 0.5rem;
        }
        
        .step.active .step-label {
            color: #2D4F2B;
            font-weight: 600;
            transform: scale(1.05);
        }
        
        .step.completed .step-label {
            color: #81C784;
        }
        
        .step-content {
            display: none;
            animation: fadeIn 0.5s ease;
        }
        
        .step-content.active {
            display: block;
        }
        
        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
            gap: 1rem;
        }
        
        .btn {
            padding: 0.875rem 1.75rem;
            border-radius: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            font-size: 0.95rem;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #2D4F2B, #3d6b3a);
            color: white;
            box-shadow: 0 4px 15px rgba(45, 79, 43, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(45, 79, 43, 0.4);
        }
        
        .btn-secondary {
            background: white;
            color: #374151;
            border: 2px solid #e5e7eb;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        
        .btn-secondary:hover {
            background: #f9fafb;
            border-color: #2D4F2B;
            transform: translateY(-2px);
        }
        
        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
        }
        
        .form-help {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 0.5rem;
        }
        
        .required::after {
            content: '*';
            color: #ef4444;
            margin-left: 0.25rem;
        }
        
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: none;
        }
        
        .form-input.error {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }
        
        .form-input.error + .error-message {
            display: block;
        }

        /* Enhanced Loading State */
        .form-select.loading {
            border-color: #3b82f6;
            background-color: #f0f9ff;
            opacity: 0.85;
            position: relative;
        }
        
        .form-select.loading::after {
            content: '';
            position: absolute;
            right: 1rem;
            top: 50%;
            width: 16px;
            height: 16px;
            margin-top: -8px;
            border: 2px solid #3b82f6;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 0.8s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Enhanced Error State */
        .form-select.error {
            border-color: #ef4444;
            background-color: #fef2f2;
            color: #dc2626;
        }
        
        .form-select.error:focus {
            border-color: #ef4444;
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.15);
        }

        /* Category Badge */
        .category-badge {
            background: linear-gradient(135deg, #2D4F2B 0%, #3d6b3a 100%);
            box-shadow: 0 4px 15px rgba(45, 79, 43, 0.3);
        }

        /* Hover Effects */
        .hover-zoom {
            transition: transform 0.5s ease;
        }
        
        .hover-zoom:hover {
            transform: scale(1.05);
        }

        /* Shimmer effect for buttons */
        .shimmer-btn {
            position: relative;
            overflow: hidden;
        }
        
        .shimmer-btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transform: translateX(-100%);
        }
        
        .shimmer-btn:hover::after {
            animation: shine 1.5s infinite;
        }

        /* Ripple effect for buttons */
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

        /* Error styling */
        .field-error {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .form-input.error {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        /* Tombol styling */
        #submit-btn {
            display: none;
        }

        #submit-btn[style*="inline-flex"] {
            display: inline-flex !important;
        }

        #next-btn[style*="none"] {
            display: none !important;
        }

        /* Style untuk dropdown loading dan error states */
        select.loading {
            background-color: #f9fafb;
            border-color: #d1d5db;
            color: #6b7280;
        }

        select.error {
            border-color: #ef4444;
            background-color: #fef2f2;
        }

        /* Style untuk dropdown bertingkat */
        .location-dropdowns {
            border: 2px solid #e5e7eb;
            border-radius: 0.875rem;
            padding: 1.25rem;
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
            
        }
        
        .location-dropdowns:hover {
            border-color: #d1d5db;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .location-dropdowns > div {
            margin-bottom: 1.125rem;
        }

        .location-dropdowns > div:last-child {
            margin-bottom: 0;
        }
        
        .location-dropdowns label {
            display: block;
            font-size: 0.95rem;
            font-weight: 500;
            margin-bottom: 0.6rem;
            color: #374151;
            letter-spacing: 0.3px;
        }
        
        .location-dropdowns label::after {
            content: '*';
            color: #ef4444;
            margin-left: 0.25rem;
        }

        /* Loading animation */
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        /* Enhanced Dropdown Styles */
        .dropdown-container {
            position: relative;
            margin-bottom: 1.25rem;
            
        }
        
        .dropdown-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #2D4F2B;
            
        }
        
        .dropdown-wrapper {
            position: relative;
        }
        
        .dropdown-indicator {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            transition: transform 0.3s ease;
            color: #6b7280;
             
        }
        
        .form-select:focus + .dropdown-indicator {
            color: #2D4F2B;
            transform: translateY(-50%) rotate(180deg);
            
        }
        
        .dropdown-status {
            position: absolute;
            right: 2.5rem;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            
        }
        
        .dropdown-status.loading {
            animation: spin 1s linear infinite;
            color: #3b82f6;
        }
        
        .dropdown-status.error {
            color: #ef4444;
        }
        
        .dropdown-status.success {
            color: #10b981;
        }
        
        /* Dropdown Options Enhancement */
        .form-select option {
            padding: 0.75rem;
            font-size: 0.95rem;
        }
        
        .form-select option:first-child {
            color: #9ca3af;
        }
        
        .form-select option:not(:first-child) {
            color: #374151;
        }
        
        /* Mobile Responsive Design */
        @media (max-width: 768px) {
            .location-dropdowns {
                padding: 1rem;
                border-radius: 0.75rem;
                margin: -0.5rem;
                margin-bottom: 1rem;
            }
            
            .form-input,
            .form-select {
                padding: 0.75rem 0.875rem;
                font-size: 16px; /* Prevents zoom on iOS */
            }
            
            .form-select {
                background-position: right 0.75rem center;
                padding-right: 2.5rem;
            }
            
            .form-input:focus,
            .form-select:focus {
                transform: none; /* Disable transform on mobile */
            }
            
            .location-dropdowns > div {
                margin-bottom: 1rem;
            }
            
            .location-dropdowns label {
                font-size: 0.9rem;
            }
            
            .dropdown-indicator {
                right: 0.75rem;
            }
            
            .dropdown-status {
                right: 2.25rem;
            }
        }
        
        @media (max-width: 480px) {
            .location-dropdowns {
                padding: 0.875rem;
            }
            
            .form-input,
            .form-select {
                padding: 0.7rem 0.75rem;
                border-radius: 0.5rem;
            }
            
            .location-dropdowns > div {
                margin-bottom: 0.875rem;
            }
        }

        .loading {
            animation: pulse 2s infinite;
        }

        @media (max-width: 768px) {
            .step-indicator {
                padding: 0 1rem;
                margin: 1rem auto 2.5rem;
            }
            
            .step {
                width: 36px;
                height: 36px;
                font-size: 0.875rem;
            }
            
            .step-container:not(:last-child)::after {
                top: 18px;
                left: calc(50% + 18px);
                right: calc(-50% + 18px);
            }
            
            .step-label {
                font-size: 0.75rem;
                line-height: 1.2;
                top: calc(100% + 8px);
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }
        }

        .fa-chevron-down{
            display:none;
        }

    
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-green-50 min-h-screen">
    <!-- Navigation -->
    <!-- Include Navigation -->
    @include('layouts.navigation')
    
    <!-- Include Auth Modal -->
    @include('components.auth-modal')

    <!-- Main Content -->
    <main class="overflow-x-hidden">
        <!-- Hero Section -->
        <section class="relative pt-32 pb-20 hero-gradient overflow-hidden">
            <!-- Floating Shapes -->
            <div class="floating-shapes">
                <i class="shape shape-1 fas fa-leaf text-white"></i>
                <i class="shape shape-2 fas fa-seedling text-white"></i>
                <i class="shape shape-3 fas fa-tree text-white"></i>
                <i class="shape shape-4 fas fa-leaf text-white"></i>
                <i class="shape shape-5 fas fa-seedling text-white"></i>
            </div>

            <!-- Organic Shapes Background -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="organic-shape w-96 h-96 opacity-20 -top-48 -left-24"></div>
                <div class="organic-shape w-[600px] h-[600px] opacity-10 -bottom-48 -right-24" style="animation-delay: -7s;"></div>
                <div class="organic-shape w-72 h-72 opacity-15 top-1/3 left-1/4" style="animation-delay: -3s;"></div>
            </div>
            
            <!-- Hero Content -->
            <div class="relative container mx-auto px-4 z-10">
                <div class="text-center max-w-4xl mx-auto" data-aos="fade-up">
                    <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md px-6 py-3 rounded-full mb-8">
                        <i class="fas fa-plus-circle text-accent"></i>
                        <span class="text-white font-semibold">Mulai Kampanye Baru</span>
                    </div>
                    
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                        Buat Kampanye
                        <span class="block text-accent">Penanaman Pohon</span>
                    </h1>
                    
                    <p class="text-xl text-white/90 mb-8 leading-relaxed">
                        Mulai perjalanan hijau Anda dan ajak komunitas untuk bersama-sama menciptakan perubahan lingkungan yang berkelanjutan
                    </p>
                </div>
            </div>

            <!-- Wave Divider -->
            <div class="absolute bottom-0 left-0 right-0">
                <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="url(#paint0_linear)" fill-opacity="0.2"/>
                    <path d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="#f9fafb"/>
                    <defs>
                        <linearGradient id="paint0_linear" x1="720" y1="30" x2="720" y2="120" gradientUnits="userSpaceOnUse">
                            <stop stop-color="white" stop-opacity="0.3"/>
                            <stop offset="1" stop-color="white" stop-opacity="0"/>
                        </linearGradient>
                    </defs>
                </svg>
            </div>
        </section>

        <!-- Campaign Creation Form -->
        <section class="py-20">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    @if($errors->any())
                        <div class="mb-8 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="mb-8 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Form Container -->
                    <div class="card-modern bg-white rounded-3xl shadow-xl overflow-hidden">
                        <!-- Step Indicator -->
                        <div class="p-8 border-b border-gray-100">
                            <div class="step-indicator">
                                <!-- Step 1 -->
                                <div class="step-container">
                                    <div class="step active" data-step="1">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <span class="step-label">Informasi Dasar</span>
                                </div>
                                
                                <!-- Step 2 -->
                                <div class="step-container">
                                    <div class="step" data-step="2">
                                        <i class="fas fa-seedling"></i>
                                    </div>
                                    <span class="step-label">Detail Kampanye</span>
                                </div>
                                
                                <!-- Step 3 -->
                                <div class="step-container">
                                    <div class="step" data-step="3">
                                        <i class="fas fa-bullseye"></i>
                                    </div>
                                    <span class="step-label">Target & Timeline</span>
                                </div>
                                
                                <!-- Step 4 -->
                                <div class="step-container">
                                    <div class="step" data-step="4">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <span class="step-label">Pratinjau</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Form Content -->
                        <div class="p-8">
                            <form id="campaign-form" action="{{ route('campaign.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                                @csrf
                                
                                <!-- Step 1: Basic Information -->
                                <div class="step-content active" data-step="1">
                                    <h2 class="text-3xl font-bold text-primary mb-8">Informasi Dasar Kampanye</h2>
                                    
                                    <div class="space-y-6">
                                        <div class="form-group">
                                            <label for="campaign-title" class="form-label required">Judul Kampanye</label>
                                            <input type="text" id="campaign-title" name="title" class="form-input" placeholder="Contoh: Penanaman 1000 Pohon Mangrove di Bali" required value="{{ old('title') }}">
                                            <div class="error-message">Judul kampanye harus diisi</div>
                                            <div class="form-help">Buat judul yang menarik dan jelas untuk kampanye Anda</div>
                                        </div>
                                        
                                        <!-- Enhanced Category Dropdown -->
                                        <div class="dropdown-container">
                                            <label for="campaign-category" class="required">Kategori</label>
                                            <div class="dropdown-wrapper">
                                                <select id="campaign-category" name="category" class="form-input form-select" required>
                                                    <option value="">Pilih Kategori Kampanye</option>
                                                    <option value="reboisasi" {{ old('category') == 'reboisasi' ? 'selected' : '' }}>Reboisasi</option>
                                                    <option value="mangrove" {{ old('category') == 'mangrove' ? 'selected' : '' }}>Penanaman Mangrove</option>
                                                    <option value="perkotaan" {{ old('category') == 'perkotaan' ? 'selected' : '' }}>Hijaukan Perkotaan</option>
                                                </select>
                                                <div class="dropdown-indicator">
                                                    <i class="fas fa-chevron-down"></i>
                                                </div>
                                            </div>
                                            <div class="error-message">Pilih kategori kampanye</div>
                                        </div>
                                        
                                        <!-- Enhanced Location Dropdowns -->
                                        <div class="form-group">
                                            <label class="form-label required">Lokasi Penanaman</label>
                                            <div class="location-dropdowns">
                                                <!-- Provinsi -->
                                                <div class="dropdown-container">
                                                    <label for="provinsi-select" class="dropdown-label">Provinsi</label>
                                                    <div class="dropdown-wrapper">
                                                        <select id="provinsi-select" name="province_id" class="form-input form-select" required>
                                                            <option value="">Pilih Provinsi</option>
                                                        </select>
                                                        <div class="dropdown-indicator">
                                                            <i class="drop fas fa-chevron-down"></i>
                                                        </div>
                                                        <div class="dropdown-status" id="province-status"></div>
                                                    </div>
                                                    <div class="error-message">Pilih provinsi</div>
                                                </div>
                                                
                                                <!-- Kabupaten/Kota -->
                                                <div class="dropdown-container">
                                                    <label for="kabupaten-select" class="dropdown-label">Kabupaten/Kota</label>
                                                    <div class="dropdown-wrapper">
                                                        <select id="kabupaten-select" name="regency_id" class="form-input form-select" required disabled>
                                                            <option value="">Pilih Kabupaten/Kota</option>
                                                        </select>
                                                        <div class="dropdown-indicator">
                                                            <i class="fas fa-chevron-down"></i>
                                                        </div>
                                                        <div class="dropdown-status" id="regency-status"></div>
                                                    </div>
                                                    <div class="error-message">Pilih kabupaten/kota</div>
                                                </div>
                                                
                                                <!-- Kecamatan -->
                                                <div class="dropdown-container">
                                                    <label for="kecamatan-select" class="dropdown-label">Kecamatan</label>
                                                    <div class="dropdown-wrapper">
                                                        <select id="kecamatan-select" name="district_id" class="form-input form-select" required disabled>
                                                            <option value="">Pilih Kecamatan</option>
                                                        </select>
                                                        <div class="dropdown-indicator">
                                                            <i class="fas fa-chevron-down"></i>
                                                        </div>
                                                        <div class="dropdown-status" id="district-status"></div>
                                                    </div>
                                                    <div class="error-message">Pilih kecamatan</div>
                                                </div>
                                                
                                                <!-- Kelurahan -->
                                                <div class="dropdown-container">
                                                    <label for="kelurahan-select" class="dropdown-label">Kelurahan</label>
                                                    <div class="dropdown-wrapper">
                                                        <select id="kelurahan-select" name="village_id" class="form-input form-select" required disabled>
                                                            <option value="">Pilih Kelurahan</option>
                                                        </select>
                                                        <div class="dropdown-indicator">
                                                            <i class="fas fa-chevron-down"></i>
                                                        </div>
                                                        <div class="dropdown-status" id="village-status"></div>
                                                    </div>
                                                    <div class="error-message">Pilih kelurahan</div>
                                                </div>
                                            </div>
                                            
                                            <!-- Input tersembunyi untuk menyimpan data lengkap -->
                                            <input type="hidden" id="full-location" name="location">
                                            <input type="hidden" id="province-id" name="province_id">
                                            <input type="hidden" id="regency-id" name="regency_id">
                                            <input type="hidden" id="district-id" name="district_id">
                                            <input type="hidden" id="village-id" name="village_id">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="campaign-image" class="form-label required">Gambar Kampanye</label>
                                            <div class="file-upload">
                                                <div class="file-upload-btn">
                                                    <i class="fas fa-cloud-upload-alt text-2xl mb-2 text-gray-400"></i>
                                                    <p class="font-semibold text-gray-600">Klik untuk mengunggah gambar</p>
                                                    <p class="text-sm text-gray-500">Format: JPG, PNG (Maks. 5MB)</p>
                                                    <input type="file" id="campaign-image" name="image" accept="image/*" required>
                                                </div>
                                            </div>
                                            <img id="image-preview" class="preview-image" alt="Pratinjau Gambar">
                                            <div class="error-message">Gambar kampanye harus diunggah</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Step 2: Campaign Details -->
                                <div class="step-content" data-step="2">
                                    <h2 class="text-3xl font-bold text-primary mb-8">Detail Kampanye</h2>
                                    
                                    <div class="space-y-6">
                                        <div class="form-group">
                                            <label for="campaign-description" class="form-label required">Deskripsi Kampanye</label>
                                            <textarea id="campaign-description" name="description" class="form-input form-textarea" placeholder="Jelaskan secara detail tentang kampanye Anda, tujuan, dan manfaatnya bagi lingkungan..." required>{{ old('description') }}</textarea>
                                            <div class="error-message">Deskripsi kampanye harus diisi</div>
                                            <div class="form-help">Minimal 200 karakter. Jelaskan dengan jelas dan menarik</div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="campaign-benefits" class="form-label">Manfaat Kampanye</label>
                                            <textarea id="campaign-benefits" name="benefits" class="form-input form-textarea" placeholder="Jelaskan manfaat yang akan didapat dari kampanye ini, seperti mengurangi erosi, menyediakan oksigen, dll...">{{ old('benefits') }}</textarea>
                                            <div class="form-help">Sebutkan manfaat lingkungan dan sosial dari kampanye ini</div>
                                        </div>
                                        
                                        <!-- Enhanced Tree Type Dropdown -->
                                        <div class="dropdown-container">
                                            <label for="tree-type" class="dropdown-label required">Jenis Pohon</label>
                                            <div class="dropdown-wrapper">
                                                <select id="tree-type" name="tree_type" class="form-input form-select" required>
                                                    <option value="">Pilih Jenis Pohon dari Petani</option>
                                                    @foreach($farmerPlants as $plant)
                                                        <option value="{{ $plant->jenis_tanaman }}" {{ old('tree_type') == $plant->jenis_tanaman ? 'selected' : '' }}>
                                                            {{ $plant->jenis_tanaman }} ({{ $plant->stok }} stok dari {{ $plant->nama_lengkap }})
                                                        </option>
                                                    @endforeach
                                                    @if(count($farmerPlants) === 0)
                                                        <option value="" disabled>Tidak ada pohon tersedia dari petani</option>
                                                    @endif
                                                </select>
                                                <div class="dropdown-indicator">
                                                    <i class="fas fa-chevron-down"></i>
                                                </div>
                                            </div>
                                            <div class="error-message">Jenis pohon harus dipilih dari daftar petani terdaftar</div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="form-label required">Metode Penanaman</label>
                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-3">
                                                <label class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-green-500 transition-colors planting-method-option">
                                                    <input type="radio" name="planting_method" value="donatur_ikut" class="hidden" {{ old('planting_method', 'donatur_ikut') == 'donatur_ikut' ? 'checked' : '' }}>
                                                    <i class="fas fa-hands-helping text-3xl text-gray-400 mb-2"></i>
                                                    <span class="font-semibold text-center">Donatur Bisa Ikut</span>
                                                    <span class="text-sm text-gray-500 text-center mt-1">Donatur dapat berpartisipasi langsung</span>
                                                </label>
                                                <label class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-green-500 transition-colors planting-method-option">
                                                    <input type="radio" name="planting_method" value="donatur_tidak_ikut" class="hidden" {{ old('planting_method') == 'donatur_tidak_ikut' ? 'checked' : '' }}>
                                                    <i class="fas fa-user-tie text-3xl text-gray-400 mb-2"></i>
                                                    <span class="font-semibold text-center">Donatur Tidak Ikut</span>
                                                    <span class="text-sm text-gray-500 text-center mt-1">Dilakukan oleh tim profesional</span>
                                                </label>
                                                <label class="flex flex-col items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-green-500 transition-colors planting-method-option">
                                                    <input type="radio" name="planting_method" value="komunitas" class="hidden" {{ old('planting_method') == 'komunitas' ? 'checked' : '' }}>
                                                    <i class="fas fa-users text-3xl text-gray-400 mb-2"></i>
                                                    <span class="font-semibold text-center">Komunitas</span>
                                                    <span class="text-sm text-gray-500 text-center mt-1">Melibatkan komunitas lokal</span>
                                                </label>
                                            </div>
                                            <div class="error-message">Pilih metode penanaman</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Step 3: Target & Timeline -->
                                <div class="step-content" data-step="3">
                                    <h2 class="text-3xl font-bold text-primary mb-8">Target & Timeline</h2>
                                    
                                    <div class="space-y-6">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <!-- Enhanced Target Trees Dropdown -->
                                            <div class="dropdown-container">
                                                <label for="target-trees" class="dropdown-label required">Target Jumlah Pohon</label>
                                                <div class="dropdown-wrapper">
                                                    <select id="target-trees" name="target_trees" class="form-input form-select" required>
                                                        <option value="">Pilih Target Pohon</option>
                                                        <option value="30" {{ old('target_trees') == '30' ? 'selected' : '' }}>30 Pohon</option>
                                                        <option value="60" {{ old('target_trees') == '60' ? 'selected' : '' }}>60 Pohon</option>
                                                        <option value="120" {{ old('target_trees') == '120' ? 'selected' : '' }}>120 Pohon</option>
                                                        <option value="250" {{ old('target_trees') == '250' ? 'selected' : '' }}>250 Pohon</option>
                                                        <option value="500" {{ old('target_trees') == '500' ? 'selected' : '' }}>500 Pohon</option>
                                                        <option value="1000" {{ old('target_trees') == '1000' ? 'selected' : '' }}>1000 Pohon</option>
                                                    </select>
                                                    <div class="dropdown-indicator">
                                                        <i class="fas fa-chevron-down"></i>
                                                    </div>
                                                </div>
                                                <div class="error-message">Target pohon harus dipilih</div>
                                            </div>
                                            
                                            <!-- Enhanced Tree Price Dropdown -->
                                            <div class="dropdown-container">
                                                <label for="tree-price" class="dropdown-label required">Biaya per Pohon (Rp)</label>
                                                <div class="dropdown-wrapper">
                                                    <select id="tree-price" name="tree_price" class="form-input form-select" required>
                                                        <option value="">Pilih Biaya per Pohon</option>
                                                        <option value="10000" {{ old('tree_price') == '10000' ? 'selected' : '' }}>Rp 10.000</option>
                                                        <option value="15000" {{ old('tree_price') == '15000' ? 'selected' : '' }}>Rp 15.000</option>
                                                        <option value="20000" {{ old('tree_price') == '20000' ? 'selected' : '' }}>Rp 20.000</option>
                                                        <option value="25000" {{ old('tree_price') == '25000' ? 'selected' : '' }}>Rp 25.000</option>
                                                        <option value="30000" {{ old('tree_price') == '30000' ? 'selected' : '' }}>Rp 30.000</option>
                                                        <option value="50000" {{ old('tree_price') == '50000' ? 'selected' : '' }}>Rp 50.000</option>
                                                    </select>
                                                    <div class="dropdown-indicator">
                                                        <i class="fas fa-chevron-down"></i>
                                                    </div>
                                                </div>
                                                <div class="error-message">Biaya per pohon harus dipilih</div>
                                                <div class="form-help">Termasuk biaya bibit, penanaman, dan perawatan</div>
                                            </div>
                                        </div>
                                        
                                        <!-- Enhanced Campaign Duration Dropdown -->
                                        <div class="dropdown-container">
                                            <label for="campaign-duration" class="dropdown-label required">Durasi Kampanye (hari)</label>
                                            <div class="dropdown-wrapper">
                                                <select id="campaign-duration" name="campaign_duration" class="form-input form-select" required>
                                                    <option value="">Pilih Durasi Kampanye</option>
                                                    <option value="7" {{ old('campaign_duration') == '7' ? 'selected' : '' }}>7 Hari</option>
                                                    <option value="14" {{ old('campaign_duration') == '14' ? 'selected' : '' }}>14 Hari</option>
                                                    <option value="30" {{ old('campaign_duration') == '30' ? 'selected' : '' }}>30 Hari</option>
                                                    <option value="60" {{ old('campaign_duration') == '60' ? 'selected' : '' }}>60 Hari</option>
                                                    <option value="90" {{ old('campaign_duration') == '90' ? 'selected' : '' }}>90 Hari</option>
                                                    <option value="180" {{ old('campaign_duration') == '180' ? 'selected' : '' }}>180 Hari</option>
                                                </select>
                                                <div class="dropdown-indicator">
                                                    <i class="fas fa-chevron-down"></i>
                                                </div>
                                            </div>
                                            <div class="error-message">Durasi kampanye harus dipilih</div>
                                            <div class="form-help">Kampanye dapat berlangsung 7 hari hingga 6 bulan</div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="planting-date" class="form-label required">Perkiraan Tanggal Penanaman</label>
                                            <input type="date" id="planting-date" name="planting_date" class="form-input" required value="{{ old('planting_date') }}">
                                            <div class="error-message">Tanggal penanaman harus diisi</div>
                                            <div class="form-help">Penanaman akan dilakukan setelah kampanye berakhir</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Step 4: Preview -->
                                <div class="step-content" data-step="4">
                                    <h2 class="text-3xl font-bold text-primary mb-8">Pratinjau Kampanye</h2>
                                    
                                    <div class="bg-gray-50 rounded-2xl p-6 mb-6">
                                        <div id="preview-content">
                                            <div class="text-center py-8 text-gray-500">
                                                <i class="fas fa-spinner fa-spin text-4xl mb-4"></i>
                                                <p>Memuat pratinjau...</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="flex items-start p-4 bg-gray-50 rounded-xl hover:bg-green-50 transition-colors">
                                            <input type="checkbox" id="terms-agreement" class="mr-3 mt-1" required>
                                            <span>Saya menyetujui <a href="#" class="text-secondary hover:underline font-semibold">Syarat dan Ketentuan</a> serta <a href="#" class="text-secondary hover:underline font-semibold">Kebijakan Privasi</a> PohonUntukEsok</span>
                                        </label>
                                        <div class="error-message">Anda harus menyetujui syarat dan ketentuan</div>
                                    </div>
                                </div>
                                
                                <!-- Form Actions -->
                                <div class="form-actions">
                                    <button type="button" id="prev-btn" class="btn btn-secondary" disabled>
                                        <i class="fas fa-arrow-left mr-2"></i> Sebelumnya
                                    </button>
                                    <button type="button" id="next-btn" class="btn btn-primary shimmer-btn">
                                        Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                                    </button>
                                    <button type="submit" id="submit-btn" class="btn btn-primary shimmer-btn">
                                        <i class="fas fa-paper-plane mr-2"></i> Kirim Kampanye
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 bg-gradient-to-br from-primary to-green-700 text-white">
            <div class="container mx-auto px-4 text-center">
                <div class="max-w-2xl mx-auto">
                    <h2 class="text-4xl font-bold mb-6">Butuh Bantuan?</h2>
                    <p class="text-xl mb-8 opacity-90">
                        Tim kami siap membantu Anda dalam membuat kampanye yang sukses dan berdampak bagi lingkungan.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="#" class="px-8 py-4 bg-white text-primary font-bold rounded-xl hover:bg-gray-100 transition-all hover-zoom shimmer-btn">
                            <i class="fas fa-envelope mr-2"></i> Hubungi Kami
                        </a>
                        <a href="#" class="px-8 py-4 border-2 border-white rounded-xl hover:bg-white hover:text-primary transition-all hover-zoom">
                            <i class="fas fa-question-circle mr-2"></i> Panduan Kampanye
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

<script>
    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true,
        offset: 100,
    });

    // Mobile Menu Toggle
    const burgerButton = document.getElementById('burger-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileDropdownBtn = document.getElementById('mobile-dropdown-btn');
    const mobileDropdownMenu = document.getElementById('mobile-dropdown-menu');

    if (burgerButton && mobileMenu) {
        burgerButton.addEventListener('click', () => {
            burgerButton.classList.toggle('active');
            mobileMenu.classList.toggle('active');
        });
    }

    if (mobileDropdownBtn && mobileDropdownMenu) {
        mobileDropdownBtn.addEventListener('click', () => {
            mobileDropdownMenu.classList.toggle('show');
            const icon = mobileDropdownBtn.querySelector('i.fa-chevron-down');
            if (icon) icon.classList.toggle('rotate-180');
        });
    }

    // Close mobile menu when clicking on a link
    document.querySelectorAll('#mobile-menu a').forEach(link => {
        link.addEventListener('click', () => {
            if (burgerButton) burgerButton.classList.remove('active');
            if (mobileMenu) mobileMenu.classList.remove('active');
            if (mobileDropdownMenu) mobileDropdownMenu.classList.remove('show');
            const icon = mobileDropdownBtn?.querySelector('i.fa-chevron-down');
            if (icon) icon.classList.remove('rotate-180');
        });
    });

    // Location Selection Handler
    document.addEventListener('DOMContentLoaded', function() {
        // Element references
        const provinceSelect = document.getElementById('provinsi-select');
        const regencySelect = document.getElementById('kabupaten-select');
        const districtSelect = document.getElementById('kecamatan-select');
        const villageSelect = document.getElementById('kelurahan-select');
        const fullLocationInput = document.getElementById('full-location');

        // Status indicators
        const provinceStatus = document.getElementById('province-status');
        const regencyStatus = document.getElementById('regency-status');
        const districtStatus = document.getElementById('district-status');
        const villageStatus = document.getElementById('village-status');

        // Load provinces on page load
        loadProvinces();

        // Event listeners untuk dropdown berjenjang
        if (provinceSelect) {
            provinceSelect.addEventListener('change', function() {
                const provinceId = this.value;
                if (provinceId) {
                    loadRegencies(provinceId);
                    resetDropdown(regencySelect);
                    resetDropdown(districtSelect);
                    resetDropdown(villageSelect);
                } else {
                    resetDropdown(regencySelect, true);
                    resetDropdown(districtSelect, true);
                    resetDropdown(villageSelect, true);
                }
                updateFullLocation();
            });
        }

        if (regencySelect) {
            regencySelect.addEventListener('change', function() {
                const regencyId = this.value;
                if (regencyId) {
                    loadDistricts(regencyId);
                    resetDropdown(districtSelect);
                    resetDropdown(villageSelect);
                } else {
                    resetDropdown(districtSelect, true);
                    resetDropdown(villageSelect, true);
                }
                updateFullLocation();
            });
        }

        if (districtSelect) {
            districtSelect.addEventListener('change', function() {
                const districtId = this.value;
                if (districtId) {
                    loadVillages(districtId);
                    resetDropdown(villageSelect);
                } else {
                    resetDropdown(villageSelect, true);
                }
                updateFullLocation();
            });
        }

        if (villageSelect) {
            villageSelect.addEventListener('change', function() {
                updateFullLocation();
            });
        }

        // Fungsi untuk memuat data provinsi
        async function loadProvinces() {
            try {
                showLoading(provinceSelect, provinceStatus, 'Memuat provinsi...');
                const response = await fetch('{{ url("/api/provinces") }}');
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const provinces = await response.json();
                
                // Clear existing options
                while (provinceSelect.options.length > 1) {
                    provinceSelect.remove(1);
                }
                
                // Add new options
                if (Array.isArray(provinces) && provinces.length > 0) {
                    provinces.forEach(province => {
                        const option = document.createElement('option');
                        option.value = province.id;
                        option.textContent = province.name;
                        provinceSelect.appendChild(option);
                    });
                    
                    provinceSelect.classList.remove('loading', 'error');
                    showSuccess(provinceStatus, 'Data provinsi dimuat');
                    
                    // Auto-select old value if exists
                    const oldProvinceId = "{{ old('province_id') }}";
                    if (oldProvinceId) {
                        provinceSelect.value = oldProvinceId;
                        provinceSelect.dispatchEvent(new Event('change'));
                    }
                } else {
                    showError(provinceSelect, provinceStatus, 'Data provinsi tidak ditemukan');
                }
            } catch (error) {
                console.error('Error loading provinces:', error);
                showError(provinceSelect, provinceStatus, 'Gagal memuat data provinsi');
            }
        }

        // Fungsi untuk memuat data kabupaten/kota
        async function loadRegencies(provinceId) {
            try {
                showLoading(regencySelect, regencyStatus, 'Memuat kabupaten/kota...');
                const response = await fetch(`{{ url('/api/regencies') }}/${provinceId}`);
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const regencies = await response.json();
                
                // Clear existing options
                while (regencySelect.options.length > 1) {
                    regencySelect.remove(1);
                }
                
                // Add new options
                if (Array.isArray(regencies) && regencies.length > 0) {
                    regencies.forEach(regency => {
                        const option = document.createElement('option');
                        option.value = regency.id;
                        option.textContent = regency.name;
                        regencySelect.appendChild(option);
                    });
                    
                    regencySelect.disabled = false;
                    regencySelect.classList.remove('loading', 'error');
                    showSuccess(regencyStatus, 'Data kabupaten/kota dimuat');
                    
                    // Auto-select old value if exists
                    const oldRegencyId = "{{ old('regency_id') }}";
                    if (oldRegencyId) {
                        regencySelect.value = oldRegencyId;
                        regencySelect.dispatchEvent(new Event('change'));
                    }
                } else {
                    showError(regencySelect, regencyStatus, 'Data kabupaten/kota tidak ditemukan');
                }
            } catch (error) {
                console.error('Error loading regencies:', error);
                showError(regencySelect, regencyStatus, 'Gagal memuat data kabupaten/kota');
            }
        }

        // Fungsi untuk memuat data kecamatan
        async function loadDistricts(regencyId) {
            try {
                showLoading(districtSelect, districtStatus, 'Memuat kecamatan...');
                const response = await fetch(`{{ url('/api/districts') }}/${regencyId}`);
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const districts = await response.json();
                
                // Clear existing options
                while (districtSelect.options.length > 1) {
                    districtSelect.remove(1);
                }
                
                // Add new options
                if (Array.isArray(districts) && districts.length > 0) {
                    districts.forEach(district => {
                        const option = document.createElement('option');
                        option.value = district.id;
                        option.textContent = district.name;
                        districtSelect.appendChild(option);
                    });
                    
                    districtSelect.disabled = false;
                    districtSelect.classList.remove('loading', 'error');
                    showSuccess(districtStatus, 'Data kecamatan dimuat');
                    
                    // Auto-select old value if exists
                    const oldDistrictId = "{{ old('district_id') }}";
                    if (oldDistrictId) {
                        districtSelect.value = oldDistrictId;
                        districtSelect.dispatchEvent(new Event('change'));
                    }
                } else {
                    showError(districtSelect, districtStatus, 'Data kecamatan tidak ditemukan');
                }
            } catch (error) {
                console.error('Error loading districts:', error);
                showError(districtSelect, districtStatus, 'Gagal memuat data kecamatan');
            }
        }

        // Fungsi untuk memuat data kelurahan
        async function loadVillages(districtId) {
            try {
                showLoading(villageSelect, villageStatus, 'Memuat kelurahan...');
                
                // Fetch villages data from backend
                const response = await fetch(`{{ url('/api/villages') }}?district_id=${districtId}`);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const villages = await response.json();
                
                // Clear existing options
                while (villageSelect.options.length > 1) {
                    villageSelect.remove(1);
                }
                
                // Add new options
                if (Array.isArray(villages) && villages.length > 0) {
                    villages.forEach(village => {
                        const option = document.createElement('option');
                        option.value = village.id;
                        option.textContent = village.name;
                        villageSelect.appendChild(option);
                    });
                    
                    villageSelect.disabled = false;
                    villageSelect.classList.remove('loading', 'error');
                    showSuccess(villageStatus, 'Data kelurahan dimuat');
                    
                    // Auto-select old value if exists
                    const oldVillageId = "{{ old('village_id') }}";
                    if (oldVillageId) {
                        villageSelect.value = oldVillageId;
                    }
                } else {
                    showError(villageSelect, villageStatus, 'Data kelurahan tidak ditemukan');
                }
            } catch (error) {
                console.error('Error loading villages:', error);
                showError(villageSelect, villageStatus, 'Gagal memuat data kelurahan');
            }
        }

        // Fungsi untuk reset dropdown
        function resetDropdown(selectElement, disable = false) {
            if (!selectElement) return;
            while (selectElement.options.length > 1) {
                selectElement.remove(1);
            }
            selectElement.value = '';
            if (disable) {
                selectElement.disabled = true;
            }
            selectElement.classList.remove('loading', 'error');
        }

        // Fungsi untuk menampilkan loading state
        function showLoading(selectElement, statusElement, message) {
            if (!selectElement || !statusElement) return;
            while (selectElement.options.length > 1) {
                selectElement.remove(1);
            }
            const option = document.createElement('option');
            option.value = '';
            option.textContent = message;
            option.disabled = true;
            selectElement.appendChild(option);
            selectElement.classList.add('loading');
            
            statusElement.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            statusElement.classList.add('loading');
            statusElement.classList.remove('error', 'success');
        }

        // Fungsi untuk menampilkan error state
        function showError(selectElement, statusElement, message) {
            if (!selectElement || !statusElement) return;
            while (selectElement.options.length > 1) {
                selectElement.remove(1);
            }
            const option = document.createElement('option');
            option.value = '';
            option.textContent = message;
            option.disabled = true;
            selectElement.appendChild(option);
            selectElement.classList.add('error');
            
            statusElement.innerHTML = '<i class="fas fa-exclamation-circle"></i>';
            statusElement.classList.add('error');
            statusElement.classList.remove('loading', 'success');
        }

        // Fungsi untuk menampilkan success state
        function showSuccess(statusElement, message) {
            if (!statusElement) return;
            statusElement.innerHTML = '<i class="fas fa-check-circle"></i>';
            statusElement.classList.add('success');
            statusElement.classList.remove('loading', 'error');
            
            // Remove success indicator after 2 seconds
            setTimeout(() => {
                statusElement.innerHTML = '';
                statusElement.classList.remove('success');
            }, 2000);
        }

        // Fungsi untuk update lokasi lengkap
        function updateFullLocation() {
            if (!fullLocationInput) return;
            
            const provinceText = provinceSelect?.options[provinceSelect?.selectedIndex]?.textContent || '';
            const regencyText = regencySelect?.options[regencySelect?.selectedIndex]?.textContent || '';
            const districtText = districtSelect?.options[districtSelect?.selectedIndex]?.textContent || '';
            const villageText = villageSelect?.options[villageSelect?.selectedIndex]?.textContent || '';
            
            const locationParts = [];
            if (villageText) locationParts.push(villageText);
            if (districtText) locationParts.push(`Kec. ${districtText}`);
            if (regencyText) locationParts.push(regencyText);
            if (provinceText) locationParts.push(`Prov. ${provinceText}`);
            
            fullLocationInput.value = locationParts.join(', ');
            
            // Update hidden location IDs
            document.getElementById('province-id').value = provinceSelect?.value || '';
            document.getElementById('regency-id').value = regencySelect?.value || '';
            document.getElementById('district-id').value = districtSelect?.value || '';
            document.getElementById('village-id').value = villageSelect?.value || '';
        }

        // Validasi khusus untuk lokasi
        function validateLocationStep() {
            const province = provinceSelect?.value;
            const regency = regencySelect?.value;
            const district = districtSelect?.value;
            const village = villageSelect?.value;
            
            let isValid = true;
            
            // Reset error states
            [provinceSelect, regencySelect, districtSelect, villageSelect].forEach(select => {
                if (select) {
                    select.classList.remove('error');
                    const errorDiv = select.parentNode.querySelector('.field-error');
                    if (errorDiv) errorDiv.remove();
                }
            });
            
            // Validasi setiap level
            if (!province) {
                showFieldError(provinceSelect, 'Pilih provinsi');
                isValid = false;
            }
            if (!regency) {
                showFieldError(regencySelect, 'Pilih kabupaten/kota');
                isValid = false;
            }
            if (!district) {
                showFieldError(districtSelect, 'Pilih kecamatan');
                isValid = false;
            }
            if (!village) {
                showFieldError(villageSelect, 'Pilih kelurahan');
                isValid = false;
            }
            
            return isValid;
        }

        // Campaign Form Functionality
        const form = document.getElementById('campaign-form');
        const steps = document.querySelectorAll('.step');
        const stepContents = document.querySelectorAll('.step-content');
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        const submitBtn = document.getElementById('submit-btn');
        let currentStep = 1;

        console.log('Form initialized - current step:', currentStep);

        // Image Preview
        const campaignImage = document.getElementById('campaign-image');
        const imagePreview = document.getElementById('image-preview');
        
        if (campaignImage && imagePreview) {
            campaignImage.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                }
            });
        }

        // Planting Method Selection
        document.querySelectorAll('.planting-method-option').forEach(option => {
            option.addEventListener('click', function() {
                // Remove selected style from all options
                document.querySelectorAll('.planting-method-option').forEach(opt => {
                    opt.style.borderColor = '#e5e7eb';
                    opt.style.backgroundColor = 'white';
                });
                
                // Add selected style to clicked option
                this.style.borderColor = '#2D4F2B';
                this.style.backgroundColor = '#f0f9f0';
                
                // Check the radio button
                const radio = this.querySelector('input[type="radio"]');
                radio.checked = true;
            });
        });

        // Update Steps
        function updateSteps() {
            const stepContainers = document.querySelectorAll('.step-container');
            
            stepContainers.forEach((container, index) => {
                const step = container.querySelector('.step');
                const stepLabel = container.querySelector('.step-label');
                
                if (index + 1 < currentStep) {
                    step.classList.add('completed');
                    step.classList.remove('active');
                    if (stepLabel) {
                        stepLabel.classList.add('completed');
                        stepLabel.classList.remove('active');
                    }
                } else if (index + 1 === currentStep) {
                    step.classList.add('active');
                    step.classList.remove('completed');
                    if (stepLabel) {
                        stepLabel.classList.add('active');
                        stepLabel.classList.remove('completed');
                    }
                } else {
                    step.classList.remove('active', 'completed');
                    if (stepLabel) {
                        stepLabel.classList.remove('active', 'completed');
                    }
                }
            });

            stepContents.forEach(content => {
                if (parseInt(content.dataset.step) === currentStep) {
                    content.classList.add('active');
                    // Remove required attributes from hidden steps to prevent HTML5 validation
                    content.querySelectorAll('[required]').forEach(field => {
                        field.setAttribute('data-required', 'true');
                        field.removeAttribute('required');
                    });
                } else {
                    content.classList.remove('active');
                    // Add back required attributes when step is hidden
                    content.querySelectorAll('[data-required="true"]').forEach(field => {
                        field.setAttribute('required', 'true');
                    });
                }
            });

            // Update buttons
            if (prevBtn) prevBtn.disabled = currentStep === 1;
            
            const totalSteps = stepContainers.length;
            if (currentStep === totalSteps) {
                if (nextBtn) nextBtn.style.display = 'none';
                if (submitBtn) submitBtn.style.display = 'inline-flex';
                generatePreview();
            } else {
                if (nextBtn) nextBtn.style.display = 'inline-flex';
                if (submitBtn) submitBtn.style.display = 'none';
            }
        }

        // Navigation
        if (nextBtn) {
            nextBtn.addEventListener('click', function() {
                if (validateStep(currentStep)) {
                    currentStep++;
                    updateSteps();
                }
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', function() {
                currentStep--;
                updateSteps();
            });
        }

        // Manual validation (disable HTML5 validation)
        function validateStep(step) {
            let isValid = true;
            const currentStepContent = document.querySelector(`.step-content[data-step="${step}"]`);
            
            if (!currentStepContent) return false;
            
            // Validasi khusus untuk step 1 (lokasi)
            if (step === 1) {
                isValid = validateLocationStep();
                if (!isValid) {
                    alert('Mohon lengkapi semua data lokasi sebelum melanjutkan.');
                    return false;
                }
            }
            
            // Temporarily add required attributes for validation
            currentStepContent.querySelectorAll('[data-required="true"]').forEach(field => {
                field.setAttribute('required', 'true');
            });

            const requiredFields = currentStepContent.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                field.classList.remove('error');
                
                if (field.type === 'file') {
                    if (field.files.length === 0) {
                        isValid = false;
                        field.classList.add('error');
                        showFieldError(field, 'File gambar harus diupload');
                    }
                } else if (field.type === 'select-one') {
                    if (!field.value) {
                        isValid = false;
                        field.classList.add('error');
                        showFieldError(field, 'Pilihan ini harus dipilih');
                    }
                } else if (field.type === 'date') {
                    if (!field.value) {
                        isValid = false;
                        field.classList.add('error');
                        showFieldError(field, 'Tanggal harus diisi');
                    }
                } else if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('error');
                    showFieldError(field, 'Field ini harus diisi');
                }
            });

            // Remove required attributes after validation to prevent HTML5 validation
            currentStepContent.querySelectorAll('[required]').forEach(field => {
                field.removeAttribute('required');
            });

            if (!isValid) {
                alert('Mohon lengkapi semua field yang diperlukan sebelum melanjutkan.');
                // Scroll to first error
                const firstError = currentStepContent.querySelector('.error');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
            
            return isValid;
        }

        function showFieldError(field, message) {
            if (!field) return;
            // Remove existing error message
            const existingError = field.parentNode.querySelector('.field-error');
            if (existingError) {
                existingError.remove();
            }
            
            // Add error message
            const errorDiv = document.createElement('div');
            errorDiv.className = 'field-error text-red-500 text-sm mt-1';
            errorDiv.textContent = message;
            field.parentNode.appendChild(errorDiv);
        }

        // Generate Preview
        function generatePreview() {
            const previewContent = document.getElementById('preview-content');
            if (!previewContent) return;
            
            // Get form values
            const title = document.getElementById('campaign-title')?.value || '';
            const category = document.getElementById('campaign-category')?.value || '';
            const fullLocation = document.getElementById('full-location')?.value || '';
            const description = document.getElementById('campaign-description')?.value || '';
            const treeType = document.getElementById('tree-type')?.value || '';
            const targetTrees = document.getElementById('target-trees')?.value || '0';
            const treePrice = document.getElementById('tree-price')?.value || '0';
            const duration = document.getElementById('campaign-duration')?.value || '0';
            const plantingDate = document.getElementById('planting-date')?.value || '';
            const plantingMethod = document.querySelector('input[name="planting_method"]:checked')?.value || '';
            
            // Format date
            let formattedDate = 'Belum ditentukan';
            if (plantingDate) {
                try {
                    formattedDate = new Date(plantingDate).toLocaleDateString('id-ID', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                } catch (e) {
                    formattedDate = plantingDate;
                }
            }
            
            // Calculate total funding
            const totalFunding = (parseInt(targetTrees) * parseInt(treePrice) || 0).toLocaleString('id-ID');
            
            // Get planting method text
            const plantingMethodText = {
                'donatur_ikut': 'Donatur Bisa Ikut',
                'donatur_tidak_ikut': 'Donatur Tidak Ikut',
                'komunitas': 'Komunitas'
            }[plantingMethod] || 'Belum dipilih';
            
            // Generate preview HTML
            previewContent.innerHTML = `
                <div class="bg-white rounded-2xl overflow-hidden shadow-lg">
                    ${imagePreview && imagePreview.style.display !== 'none' ? 
                        `<img src="${imagePreview.src}" alt="${title}" class="w-full h-48 object-cover">` : 
                        '<div class="w-full h-48 bg-gradient-to-br from-green-50 to-emerald-100 flex items-center justify-center"><i class="fas fa-tree text-6xl text-green-300"></i></div>'
                    }
                    <div class="p-6">
                        <span class="inline-block category-badge text-white text-xs px-3 py-1 rounded-full mb-3">${getCategoryName(category)}</span>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">${title || 'Judul Kampanye'}</h3>
                        <p class="text-gray-600 mb-4 leading-relaxed">${description ? description.substring(0, 150) + '...' : 'Deskripsi kampanye'}</p>
                        <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-map-marker-alt text-green-600 mr-2"></i>
                                <span>${fullLocation || 'Lokasi penanaman'}</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-tree text-green-600 mr-2"></i>
                                <span>${treeType || 'Jenis Pohon'}</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-bullseye text-green-600 mr-2"></i>
                                <span>${targetTrees} pohon</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-clock text-green-600 mr-2"></i>
                                <span>${duration} hari</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-users text-green-600 mr-2"></i>
                                <span>${plantingMethodText}</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-money-bill text-green-600 mr-2"></i>
                                <span>Rp ${parseInt(treePrice).toLocaleString('id-ID')}/pohon</span>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-xl font-bold text-green-700">Rp ${totalFunding}</span>
                                <span class="text-sm text-gray-500">Total dana dibutuhkan</span>
                            </div>
                            <div class="text-sm text-gray-500">
                                <i class="fas fa-calendar-alt mr-1"></i> Perkiraan penanaman: ${formattedDate}
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        // Helper function to get category name
        function getCategoryName(categoryValue) {
            const categories = {
                'reboisasi': 'Reboisasi Hutan',
                'mangrove': 'Penanaman Mangrove',
                'perkotaan': 'Hijaukan Perkotaan',
                'edukasi': 'Edukasi Lingkungan',
                'lainnya': 'Lainnya'
            };
            return categories[categoryValue] || 'Lainnya';
        }

        // Form Submission Handler
        if (form && submitBtn) {
            // Disable HTML5 validation on form
            form.setAttribute('novalidate', 'true');

            submitBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                console.log('Submit button clicked - validating all steps...');

                // Validate terms agreement
                const termsAgreement = document.getElementById('terms-agreement');
                if (!termsAgreement || !termsAgreement.checked) {
                    alert('Anda harus menyetujui syarat dan ketentuan sebelum mengirim kampanye.');
                    termsAgreement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    return false;
                }

                // Validate all steps manually
                let allValid = true;
                const stepsToValidate = [1, 2, 3]; // Step 4 is preview only

                stepsToValidate.forEach(step => {
                    if (!validateStep(step)) {
                        allValid = false;
                        // Switch to the first invalid step
                        if (allValid === false && currentStep !== step) {
                            currentStep = step;
                            updateSteps();
                        }
                    }
                });

                if (!allValid) {
                    alert('Mohon lengkapi semua field yang diperlukan di semua step sebelum mengirim kampanye.');
                    return false;
                }

                console.log('All validation passed - submitting form...');
                
                // Show loading state
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengirim...';
                submitBtn.disabled = true;

                // Submit form programmatically
                setTimeout(() => {
                    form.submit();
                }, 1000);
            });
        }

        // Initialize steps
        updateSteps();
    });

    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const nav = document.getElementById('main-nav');
        if (nav) {
            if (window.scrollY > 50) {
                nav.classList.add('shadow-lg');
                nav.style.backgroundColor = 'rgba(45, 79, 43, 0.95)';
            } else {
                nav.classList.remove('shadow-lg');
                nav.style.backgroundColor = '';
            }
        }
    });

    // Ripple effect for buttons
    document.querySelectorAll('.ripple-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Initialize GSAP
    gsap.registerPlugin(ScrollTrigger);
</script> 
</body>
</html>
