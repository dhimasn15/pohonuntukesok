<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - PohonUntukEsok</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <style>
        :root {
            --primary: #2D4F2B;
            --primary-light: #3a6438;
            --accent: #FFAB00;
            --accent-light: #ffc046;
        }
        .primary { color: var(--primary); }
        .bg-primary { background-color: var(--primary); }
        .bg-primary-light { background-color: var(--primary-light); }
        .accent { color: var(--accent); }
        .bg-accent { background-color: var(--accent); }
        
        /* Card hover effects */
        .card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #1a3a1a 0%, #2D4F2B 50%, #3d6b3a 100%);
        }

        .blog-content {
            line-height: 1.8;
            font-size: 1.125rem;
        }

        .blog-content h1 {
            font-size: 2.25rem;
            font-weight: bold;
            color: var(--primary);
            margin-bottom: 1.5rem;
            line-height: 1.3;
        }

        .blog-content h2 {
            font-size: 1.875rem;
            font-weight: bold;
            color: var(--primary);
            margin: 2.5rem 0 1.25rem 0;
            line-height: 1.4;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 0.5rem;
        }

        .blog-content h3 {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary);
            margin: 2rem 0 1rem 0;
        }

        .blog-content p {
            margin-bottom: 1.5rem;
            color: #4b5563;
        }

        .blog-content ul, .blog-content ol {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
        }

        .blog-content li {
            margin-bottom: 0.5rem;
            color: #4b5563;
        }

        .blog-content blockquote {
            border-left: 4px solid var(--primary);
            padding: 1.5rem 2rem;
            margin: 2rem 0;
            font-style: italic;
            color: #6b7280;
            background: #f9fafb;
            border-radius: 0 8px 8px 0;
        }

        .blog-content img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            margin: 2.5rem 0;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .blog-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 2.5rem 0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .blog-content table th,
        .blog-content table td {
            padding: 1rem;
            border: 1px solid #e5e7eb;
            text-align: left;
        }

        .blog-content table th {
            background-color: var(--primary);
            color: white;
            font-weight: 600;
        }

        .share-btn {
            transition: all 0.3s ease;
        }

        .share-btn:hover {
            transform: translateY(-2px);
        }

        .tag-modern {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            transition: all 0.3s ease;
        }

        .tag-modern:hover {
            background: linear-gradient(135deg, #2D4F2B 0%, #3d6b3a 100%);
            transform: translateY(-2px);
            color: white;
        }

        .author-badge {
            background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,1) 100%);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(45, 79, 43, 0.1);
        }

        .reading-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            transform-origin: left;
            transform: scaleX(0);
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .breadcrumb-item {
            transition: all 0.3s ease;
        }

        .breadcrumb-item:hover {
            color: var(--primary);
        }

        .featured-image-container {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.3);
        }

        .featured-image-overlay {
            background: linear-gradient(180deg, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.7) 100%);
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-green-50">
    @include('layouts.navigation')
    @include('components.auth-modal')

    <!-- Reading Progress Bar -->
    <div class="reading-progress" id="readingProgress"></div>

    <!-- Breadcrumb -->
    <div class="bg-white border-b border-gray-200">
        <div class="container mx-auto px-4 py-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-primary transition-colors">
                            <i class="fas fa-home mr-2"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <a href="{{ route('blog.index') }}" class="ml-1 text-sm font-medium text-gray-500 hover:text-primary transition-colors md:ml-2">
                                Blog
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <a href="{{ route('blog.category', $post->category) }}" class="ml-1 text-sm font-medium text-gray-500 hover:text-primary transition-colors md:ml-2">
                                {{ $post->category }}
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="ml-1 text-sm font-medium text-primary md:ml-2 line-clamp-1 max-w-xs">
                                {{ $post->title }}
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Featured Image Section -->
    @if($post->featured_image)
    <section class="relative">
        <div class="featured-image-container max-w-6xl mx-auto px-4 -mb-16 relative z-10" data-aos="fade-up">
            <div class="relative h-96 md:h-[500px] rounded-2xl overflow-hidden">
                <img src="{{ Storage::url($post->featured_image) }}" 
                     alt="{{ $post->title }}" 
                     class="w-full h-full object-cover">
                <div class="featured-image-overlay absolute inset-0"></div>
                
                <!-- Category Badge -->
                <div class="absolute top-6 left-6">
                    <span class="bg-primary text-white px-4 py-2 rounded-full text-sm font-semibold flex items-center space-x-2">
                        <i class="fas fa-folder"></i>
                        <span>{{ $post->category }}</span>
                    </span>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Main Content -->
    <section class="py-12 @if($post->featured_image) pt-24 @endif">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8 max-w-7xl mx-auto">
                <!-- Article Content -->
                <div class="lg:w-2/3">
                    <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8" data-aos="fade-up">
                        <!-- Article Header -->
                        <div class="mb-8">
                            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-800 mb-6 leading-tight">
                                {{ $post->title }}
                            </h1>
                            
                            <!-- Meta Information -->
                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6 p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center space-x-3">
                                        @if($post->author_avatar)
                                            <img src="{{ Storage::url($post->author_avatar) }}" 
                                                 alt="{{ $post->author_name }}" 
                                                 class="w-10 h-10 rounded-full border-2 border-primary/20">
                                        @else
                                            <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center border-2 border-primary/20">
                                                <i class="fas fa-user text-primary"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $post->author_name }}</p>
                                            <p class="text-sm text-gray-500">Penulis</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-6 text-sm text-gray-600">
                                    <div class="flex items-center space-x-2">
                                        <i class="far fa-calendar text-primary"></i>
                                        <span>{{ $post->published_at->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <i class="far fa-clock text-primary"></i>
                                        <span>{{ $post->reading_time }} menit</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <i class="far fa-eye text-primary"></i>
                                        <span>{{ number_format($post->view_count) }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Tags -->
                            @if($post->tags && count($post->tags) > 0)
                            <div class="flex flex-wrap gap-2 mb-6">
                                @foreach($post->tags as $tag)
                                <span class="tag-modern px-3 py-1.5 rounded-full text-sm font-semibold text-primary">
                                    <i class="fas fa-hashtag mr-1"></i>{{ $tag }}
                                </span>
                                @endforeach
                            </div>
                            @endif
                        </div>

                        <!-- Blog Content -->
                        <article class="blog-content">
                            {!! $post->content !!}
                        </article>

                        <!-- Share Section -->
                        <div class="mt-12 pt-8 border-t border-gray-200">
                            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                                <div class="text-center sm:text-left">
                                    <p class="text-lg font-semibold text-gray-800 mb-2">Bagikan Artikel Ini</p>
                                    <p class="text-sm text-gray-600">Bantu sebarkan pengetahuan tentang lingkungan</p>
                                </div>
                                <div class="flex space-x-3">
                                    <a href="#" class="share-btn w-12 h-12 bg-blue-600 text-white rounded-xl flex items-center justify-center hover:bg-blue-700">
                                        <i class="fab fa-facebook-f text-lg"></i>
                                    </a>
                                    <a href="#" class="share-btn w-12 h-12 bg-sky-500 text-white rounded-xl flex items-center justify-center hover:bg-sky-600">
                                        <i class="fab fa-twitter text-lg"></i>
                                    </a>
                                    <a href="#" class="share-btn w-12 h-12 bg-pink-600 text-white rounded-xl flex items-center justify-center hover:bg-pink-700">
                                        <i class="fab fa-instagram text-lg"></i>
                                    </a>
                                    <a href="#" class="share-btn w-12 h-12 bg-green-600 text-white rounded-xl flex items-center justify-center hover:bg-green-700">
                                        <i class="fab fa-whatsapp text-lg"></i>
                                    </a>
                                    <button onclick="copyToClipboard()" class="share-btn w-12 h-12 bg-gray-700 text-white rounded-xl flex items-center justify-center hover:bg-gray-800">
                                        <i class="fas fa-link text-lg"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Author Bio -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 mt-8" data-aos="fade-up" data-aos-delay="100">
                        <div class="author-badge rounded-xl p-6">
                            <div class="flex items-start space-x-4">
                                @if($post->author_avatar)
                                    <img src="{{ Storage::url($post->author_avatar) }}" 
                                         alt="{{ $post->author_name }}" 
                                         class="w-16 h-16 rounded-full border-2 border-primary/20">
                                @else
                                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center border-2 border-primary/20">
                                        <i class="fas fa-user text-primary text-xl"></i>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">Tentang Penulis</h3>
                                    <p class="text-gray-600 mb-4">
                                        {{ $post->author_name }} adalah seorang penulis yang peduli dengan lingkungan dan berbagi pengetahuan tentang keberlanjutan melalui tulisan-tulisannya.
                                    </p>
                                    <div class="flex space-x-4">
                                        <a href="#" class="text-gray-500 hover:text-primary transition-colors">
                                            <i class="fab fa-twitter text-lg"></i>
                                        </a>
                                        <a href="#" class="text-gray-500 hover:text-primary transition-colors">
                                            <i class="fab fa-linkedin text-lg"></i>
                                        </a>
                                        <a href="#" class="text-gray-500 hover:text-primary transition-colors">
                                            <i class="fas fa-globe text-lg"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Related Posts -->
                    @if($relatedPosts->count() > 0)
                    <div class="bg-white rounded-2xl shadow-lg p-6 mt-8" data-aos="fade-up" data-aos-delay="200">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-seedling text-primary mr-3"></i>
                            Artikel Terkait
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($relatedPosts as $relatedPost)
                            <a href="{{ route('blog.show', $relatedPost->slug) }}" class="card-hover bg-gray-50 rounded-xl p-4 block group">
                                <div class="flex flex-col space-y-3">
                                    @if($relatedPost->featured_image)
                                        <div class="relative h-40 rounded-lg overflow-hidden">
                                            <img src="{{ Storage::url($relatedPost->featured_image) }}" 
                                                 alt="{{ $relatedPost->title }}" 
                                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                            <div class="absolute top-2 left-2">
                                                <span class="bg-primary text-white px-2 py-1 rounded text-xs font-semibold">
                                                    {{ $relatedPost->category }}
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="h-40 bg-primary/10 rounded-lg flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                                            <i class="fas fa-seedling text-primary text-3xl"></i>
                                        </div>
                                    @endif
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-800 group-hover:text-primary transition-colors line-clamp-2 mb-2">
                                            {{ $relatedPost->title }}
                                        </h4>
                                        <p class="text-sm text-gray-500 line-clamp-2 mb-2">
                                            {{ $relatedPost->excerpt }}
                                        </p>
                                        <div class="flex items-center justify-between text-xs text-gray-500">
                                            <span>{{ $relatedPost->published_at->format('d M Y') }}</span>
                                            <span>{{ $relatedPost->reading_time }} min</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:w-1/3">
                    <div class="space-y-8 sticky top-24">
                        <!-- Popular Posts -->
                        <div class="bg-white rounded-2xl shadow-lg p-6" data-aos="fade-up">
                            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-fire text-orange-500 mr-3"></i>
                                Artikel Populer
                            </h3>
                            <div class="space-y-4">
                                @php
                                    $popularPosts = \App\Models\BlogPost::published()
                                        ->orderBy('view_count', 'desc')
                                        ->take(5)
                                        ->get();
                                @endphp
                                @foreach($popularPosts as $popularPost)
                                <a href="{{ route('blog.show', $popularPost->slug) }}" class="flex items-start space-x-3 group cursor-pointer p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                    @if($popularPost->featured_image)
                                        <img src="{{ Storage::url($popularPost->featured_image) }}" 
                                             alt="{{ $popularPost->title }}" 
                                             class="w-16 h-16 rounded-lg object-cover group-hover:scale-105 transition-transform flex-shrink-0">
                                    @else
                                        <div class="w-16 h-16 bg-primary/10 rounded-lg flex items-center justify-center group-hover:scale-105 transition-transform flex-shrink-0">
                                            <i class="fas fa-seedling text-primary"></i>
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-medium text-gray-800 group-hover:text-primary transition-colors line-clamp-2 mb-1">
                                            {{ $popularPost->title }}
                                        </h4>
                                        <p class="text-xs text-gray-500">{{ $popularPost->published_at->format('d M Y') }}</p>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Newsletter -->
                        <div class="bg-gradient-to-br from-primary to-green-700 rounded-2xl shadow-xl p-6 text-white" data-aos="fade-up" data-aos-delay="100">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-envelope-open-text text-2xl"></i>
                                </div>
                                <h3 class="text-xl font-bold mb-3">Newsletter</h3>
                                <p class="text-white/90 text-sm mb-4">Dapatkan artikel terbaru tentang lingkungan langsung di email Anda</p>
                            </div>
                            <div class="space-y-3">
                                <input type="email" 
                                       placeholder="Email Anda" 
                                       class="w-full px-4 py-3 rounded-lg bg-white/10 backdrop-blur-sm border border-white/20 text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/50 text-sm">
                                <button class="w-full px-4 py-3 bg-white text-primary rounded-lg font-semibold hover:bg-gray-100 transition-all flex items-center justify-center">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Berlangganan
                                </button>
                            </div>
                        </div>

                        <!-- Categories -->
                        <div class="bg-white rounded-2xl shadow-lg p-6" data-aos="fade-up" data-aos-delay="200">
                            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-folder-open text-primary mr-3"></i>
                                Kategori
                            </h3>
                            <div class="space-y-2">
                                @php
                                    $categories = \App\Models\BlogPost::published()
                                        ->select('category')
                                        ->distinct()
                                        ->pluck('category');
                                @endphp
                                @foreach($categories as $category)
                                <a href="{{ route('blog.category', $category) }}" class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors group">
                                    <span class="text-gray-700 group-hover:text-primary font-medium">{{ $category }}</span>
                                    <span class="bg-primary/10 text-primary text-xs px-2 py-1 rounded-full">
                                        {{ \App\Models\BlogPost::published()->where('category', $category)->count() }}
                                    </span>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });

        // Reading progress bar
        function updateReadingProgress() {
            const progressBar = document.getElementById('readingProgress');
            const article = document.querySelector('.blog-content');
            if (!article) return;
            
            const articleTop = article.offsetTop;
            const articleHeight = article.offsetHeight;
            const windowHeight = window.innerHeight;
            
            const scrollTop = window.pageYOffset;
            const articleBottom = articleTop + articleHeight;
            const windowBottom = scrollTop + windowHeight;
            
            if (scrollTop >= articleTop && scrollTop <= articleBottom) {
                const progress = (scrollTop - articleTop) / (articleHeight - windowHeight);
                progressBar.style.transform = `scaleX(${Math.min(progress, 1)})`;
            } else if (scrollTop < articleTop) {
                progressBar.style.transform = 'scaleX(0)';
            } else {
                progressBar.style.transform = 'scaleX(1)';
            }
        }

        window.addEventListener('scroll', updateReadingProgress);
        window.addEventListener('resize', updateReadingProgress);

        // Copy to clipboard function
        function copyToClipboard() {
            const url = window.location.href;
            navigator.clipboard.writeText(url).then(() => {
                // Show success message
                const button = event.currentTarget;
                const originalHTML = button.innerHTML;
                button.innerHTML = '<i class="fas fa-check"></i>';
                button.classList.remove('bg-gray-700', 'hover:bg-gray-800');
                button.classList.add('bg-green-600', 'hover:bg-green-700');
                
                setTimeout(() => {
                    button.innerHTML = originalHTML;
                    button.classList.remove('bg-green-600', 'hover:bg-green-700');
                    button.classList.add('bg-gray-700', 'hover:bg-gray-800');
                }, 2000);
            }).catch(() => {
                alert('Gagal menyalin link');
            });
        }

        // Share functionality
        function shareArticle(platform) {
            const url = window.location.href;
            const title = document.title;
            
            let shareUrl = '';
            
            switch(platform) {
                case 'facebook':
                    shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
                    break;
                case 'twitter':
                    shareUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(title)}&url=${encodeURIComponent(url)}`;
                    break;
                case 'whatsapp':
                    shareUrl = `https://wa.me/?text=${encodeURIComponent(title + ' ' + url)}`;
                    break;
                case 'linkedin':
                    shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(url)}`;
                    break;
            }
            
            if (shareUrl) {
                window.open(shareUrl, '_blank', 'width=600,height=400');
            }
        }

        // Attach share functionality to buttons
        document.querySelectorAll('.share-btn').forEach(button => {
            if (button.querySelector('.fa-link')) return; // Skip copy button
            
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const platform = this.querySelector('i').className.split(' ')[1].replace('fa-', '');
                shareArticle(platform);
            });
        });
    </script>
</body>
</html>