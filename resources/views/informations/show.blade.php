<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/icon.png') }}" type="image/x-icon">

    <!-- Primary Meta Tags -->
    <title>{{ $information->title }} - SatriaNet</title>
    <meta name="title" content="{{ $information->title }} - SatriaNet">
    <meta name="description" content="{{ $information->sub_title ?? Str::limit(strip_tags($information->content), 150) }}">
    <meta name="keywords" content="{{ $information->meta_keywords }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $information->title }} - SatriaNet">
    <meta property="og:description" content="{{ $information->sub_title ?? Str::limit(strip_tags($information->content), 150) }}">
    <meta property="og:image" content="{{ $information->image ? asset('storage/' . $information->image) : asset('assets/images/icon.png') }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $information->title }} - SatriaNet">
    <meta name="twitter:description" content="{{ $information->sub_title ?? Str::limit(strip_tags($information->content), 150) }}">
    <meta name="twitter:image" content="{{ $information->image ? asset('storage/' . $information->image) : asset('assets/images/icon.png') }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="description" content="{{ strip_tags($information->content) }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e40af',
                        secondary: '#7c3aed',
                        accent: '#f59e0b'
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'fade-in': 'fadeIn 0.8s ease-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'bounce-gentle': 'bounceGentle 2s ease-in-out infinite',
                        'pulse-glow': 'pulseGlow 2s ease-in-out infinite'
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes bounceGentle {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes pulseGlow {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
            }

            50% {
                box-shadow: 0 0 30px rgba(59, 130, 246, 0.8);
            }
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .share-button {
            transition: all 0.3s ease;
        }

        .share-button:hover {
            transform: scale(1.1);
        }

        .sticky-share {
            position: sticky;
            top: 120px;
        }

        .prose {
            max-width: none;
        }

        .prose h1,
        .prose h2,
        .prose h3,
        .prose h4,
        .prose h5,
        .prose h6 {
            color: #1f2937;
            font-weight: 700;
            margin-top: 1.5em;
            margin-bottom: 0.5em;
        }

        .prose p {
            margin-bottom: 1em;
            line-height: 1.7;
            color: #374151;
        }

        .prose ul,
        .prose ol {
            margin: 1em 0;
            padding-left: 1.5em;
        }

        .prose li {
            margin-bottom: 0.5em;
            color: #374151;
        }

        .prose img {
            border-radius: 12px;
            margin: 1.5em 0;
        }

        .prose blockquote {
            border-left: 4px solid #3b82f6;
            padding-left: 1em;
            margin: 1.5em 0;
            background: #f8fafc;
            padding: 1em;
            border-radius: 8px;
        }

        .social-float {
            animation: float 3s ease-in-out infinite;
        }

        .pulse-bg {
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                background-color: rgba(59, 130, 246, 0.1);
            }

            50% {
                background-color: rgba(59, 130, 246, 0.2);
            }
        }
    </style>
</head>

<body class="font-sans bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="/">
                            <img src="{{ asset('assets/images/main_logo.png') }}"
                                alt="SatriaNet Logo"
                                class="h-10 sm:h-12 w-auto">
                        </a>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') . '#tentang-kami' }}" class="nav-link text-gray-700 hover:text-primary transition-colors duration-200">Tentang Kami</a>
                    <a href="{{ route('home') . '#informasi-dan-promo' }}" class="nav-link text-gray-700 hover:text-primary transition-colors duration-200">Informasi & Promo</a>
                    <a href="{{ route('home') . '#paket-dan-harga' }}" class="nav-link text-gray-700 hover:text-primary transition-colors duration-200">Paket & Harga</a>
                    <a href="{{ route('home') . '#coverage' }}" class="nav-link text-gray-700 hover:text-primary transition-colors duration-200">Coverage Area</a>
                    <a href="{{ route('home') . '#kerja-sama' }}" class="nav-link text-gray-700 hover:text-primary transition-colors duration-200">Kerja Sama</a>
                    <a href="{{ route('informations.show', 'informasi-pembayaran-satrianet') }}" class="nav-link text-gray-700 hover:text-primary transition-colors duration-200">Cara Bayar</a>
                    <a href="https://wa.me/6282138304415" target="_blank" rel="noopener noreferrer">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300">
                            Hubungi Kami
                        </button>
                    </a>
                </div>
                <div class="md:hidden flex items-center">
                    <button class="mobile-menu-button p-2">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile menu -->
        <div class="mobile-menu hidden md:hidden bg-white shadow-lg">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') . '#tentang-kami' }}" class="nav-link block px-3 py-2 text-gray-700 hover:text-primary">Tentang Kami</a>
                <a href="{{ route('home') . '#informasi-dan-promo' }}" class="nav-link block px-3 py-2 text-gray-700 hover:text-primary">Informasi & Promo</a>
                <a href="{{ route('home') . '##paket-dan-harga' }}" class="nav-link block px-3 py-2 text-gray-700 hover:text-primary">Paket & Harga</a>
                <a href="{{ route('home') . '#coverage' }}"" class=" nav-link block px-3 py-2 text-gray-700 hover:text-primary">Coverage Area</a>
                <a href="{{ route('home') . '#kerja-sama' }}" class="nav-link block px-3 py-2 text-gray-700 hover:text-primary">Kerja Sama</a>
                <a href="{{ route('informations.show', 'informasi-pembayaran-satrianet') }}" class="nav-link block px-3 py-2 text-gray-700 hover:text-primary transition-colors duration-200">Cara Bayar</a>
                <a href="https://wa.me/6282138304415" target="_blank" rel="noopener noreferrer" class="block px-3 py-2">
                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-full font-semibold transition-all duration-300">
                        Hubungi Kami
                    </button>
                </a>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <section class="pt-24 pb-8 bg-gradient-to-r from-blue-50 to-purple-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center space-x-2 text-sm">
                <a href="/" class="text-blue-600 hover:text-blue-800 transition-colors">Home</a>
                <i class="fas fa-chevron-right text-gray-400"></i>
                <a href="/#packages" class="text-blue-600 hover:text-blue-800 transition-colors">Informasi & Promo</a>
                <i class="fas fa-chevron-right text-gray-400"></i>
                <span class="text-gray-500">{{ $information->title }}</span>
            </nav>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-8">
                <!-- Main Content Area -->
                <div class="lg:col-span-8">
                    <!-- Article Header -->
                    <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-3xl p-8 text-white mb-8 animate-slide-up">
                        <div class="mb-4">
                            @php
                            $start = $information->start_date;
                            $end = $information->end_date;
                            $isPromo = Str::contains(strtolower($information->category->title ?? ''), 'promo');
                            @endphp

                            @if ($start || $end)
                            <span class="bg-yellow-400 text-black text-sm px-4 py-2 rounded-full font-bold flex items-center gap-2 w-fit">
                                <i class="fas fa-calendar-alt"></i>
                                {{ $start ? $start->locale('id')->format('d M Y') : '–' }} -
                                {{ $end ? $end->locale('id')->format('d M Y') : '–' }}
                            </span>
                            @else
                            <span class="bg-yellow-400 text-black text-sm px-4 py-2 rounded-full font-bold flex items-center gap-2 w-fit">
                                @if ($isPromo)
                                <i class="fas fa-infinity"></i>
                                PROMO TANPA BATAS WAKTU
                                @else
                                <i class="fas fa-info-circle"></i>
                                INFORMASI
                                @endif
                            </span>
                            @endif
                        </div>

                        <h1 class="text-4xl font-bold mb-4 leading-tight">{{ $information->title }}</h1>

                        @if ($information->sub_title)
                        <h2 class="text-xl opacity-90 mb-6">{{ $information->sub_title }}</h2>
                        @endif

                        <!-- Share Buttons -->
                        <div class="flex items-center gap-4 mb-6">
                            <span class="text-sm opacity-80">Bagikan:</span>
                            <div class="flex gap-3">
                                <button onclick="shareToWhatsApp()" class="share-button bg-green-500 hover:bg-green-600 text-white w-10 h-10 rounded-full flex items-center justify-center">
                                    <i class="fab fa-whatsapp"></i>
                                </button>
                                <button onclick="shareToFacebook()" class="share-button bg-blue-600 hover:bg-blue-700 text-white w-10 h-10 rounded-full flex items-center justify-center">
                                    <i class="fab fa-facebook-f"></i>
                                </button>
                                <button onclick="shareToInstagram()" class="share-button bg-pink-500 hover:bg-pink-600 text-white w-10 h-10 rounded-full flex items-center justify-center">
                                    <i class="fab fa-instagram"></i>
                                </button>
                                <button onclick="shareToTwitter()" class="share-button bg-blue-400 hover:bg-blue-500 text-white w-10 h-10 rounded-full flex items-center justify-center">
                                    <i class="fab fa-twitter"></i>
                                </button>
                                <button onclick="copyToClipboard()" class="share-button bg-gray-600 hover:bg-gray-700 text-white w-10 h-10 rounded-full flex items-center justify-center">
                                    <i class="fas fa-link"></i>
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 text-sm opacity-80">
                            <span><i class="fas fa-clock mr-2"></i>{{ $information->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    @if ($information->image)
                    <div class="mb-8 animate-slide-up" style="animation-delay: 0.2s">
                        <img src="{{ asset('storage/' . $information->image) }}"
                            alt="{{ $information->title }}"
                            class="rounded-2xl w-full max-h-[500px] object-cover shadow-xl">
                    </div>
                    @endif

                    <!-- Article Content -->
                    <div class="bg-white rounded-2xl p-8 shadow-lg mb-8 animate-slide-up" style="animation-delay: 0.4s">
                        <div class="prose prose-lg">
                            {!! $information->content !!}
                        </div>
                    </div>

                    <!-- Call to Action -->
                    <div class="bg-gradient-to-r bg-blue-600 hover:bg-blue-700 rounded-2xl p-8 text-center animate-slide-up" style="animation-delay: 0.6s">
                        <h3 class="text-2xl font-bold text-white mb-4">Tertarik dengan penawaran ini?</h3>
                        <p class="text-white opacity-90 mb-6">Hubungi kami sekarang untuk mendapatkan informasi lebih lanjut dan penawaran khusus!</p>
                        <a href="https://wa.me/6282138304415" target="_blank" rel="noopener noreferrer">
                            <button class="bg-white text-black px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 animate-pulse-glow">
                                <i class="fab fa-whatsapp mr-2"></i>
                                HUBUNGI KAMI SEKARANG
                            </button>
                        </a>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-4">
                    <div class="sticky-share">
                        <!-- Floating Social Share -->
                        <div class="bg-white rounded-2xl p-6 shadow-lg mb-8 social-float">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-share-alt mr-2 text-blue-600"></i>
                                Bagikan Artikel
                            </h3>
                            <div class="grid grid-cols-2 gap-3">
                                <button onclick="shareToWhatsApp()" class="bg-green-500 hover:bg-green-600 text-white p-3 rounded-xl flex items-center justify-center gap-2 transition-all duration-300 hover:scale-105">
                                    <i class="fab fa-whatsapp"></i>
                                    <span class="text-sm font-medium">WhatsApp</span>
                                </button>
                                <button onclick="shareToFacebook()" class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-xl flex items-center justify-center gap-2 transition-all duration-300 hover:scale-105">
                                    <i class="fab fa-facebook-f"></i>
                                    <span class="text-sm font-medium">Facebook</span>
                                </button>
                                <button onclick="shareToInstagram()" class="bg-pink-500 hover:bg-pink-600 text-white p-3 rounded-xl flex items-center justify-center gap-2 transition-all duration-300 hover:scale-105">
                                    <i class="fab fa-instagram"></i>
                                    <span class="text-sm font-medium">Instagram</span>
                                </button>
                                <button onclick="copyToClipboard()" class="bg-gray-600 hover:bg-gray-700 text-white p-3 rounded-xl flex items-center justify-center gap-2 transition-all duration-300 hover:scale-105">
                                    <i class="fas fa-link"></i>
                                    <span class="text-sm font-medium">Copy Link</span>
                                </button>
                            </div>
                        </div>

                        <!-- Promo Lainnya -->
                        @if ($otherPromos->count())
                        <div class="bg-white rounded-2xl p-6 shadow-lg mb-8">
                            <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                                <i class="fas fa-fire mr-2 text-red-500"></i>
                                Promo Lainnya
                            </h3>

                            <div class="space-y-4">
                                @foreach ($otherPromos as $promo)
                                <a href="{{ route('informations.show', $promo->slug) }}"
                                    class="block border-l-4 border-blue-500 pl-4 py-2 hover:bg-blue-50 transition-colors cursor-pointer">
                                    <h4 class="font-semibold text-gray-800 text-sm">{{ $promo->title }}</h4>
                                    @if ($promo->sub_title)
                                    <p class="text-gray-600 text-xs mt-1">{{ $promo->sub_title }}</p>
                                    @endif
                                </a>
                                @endforeach
                            </div>

                            <a href="{{ route('home') . '#informasi-dan-promo' }}" class="block mt-4 text-center bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-xl text-sm font-medium transition-colors">
                                Lihat Semua Promo
                            </a>
                        </div>
                        @endif

                        <!-- Quick Contact -->
                        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white">
                            <h3 class="text-lg font-bold mb-4 flex items-center">
                                <i class="fas fa-phone mr-2"></i>
                                Butuh Bantuan?
                            </h3>
                            <p class="text-sm opacity-90 mb-4">Tim customer service kami siap membantu Anda 24/7</p>
                            <div class="space-y-3">
                                <a href="https://wa.me/6282138304415" target="_blank" rel="noopener noreferrer" class="block bg-white bg-opacity-20 hover:bg-opacity-30 rounded-xl p-3 transition-all duration-300">
                                    <div class="flex items-center">
                                        <i class="fab fa-whatsapp text-xl mr-3"></i>
                                        <div>
                                            <div class="text-sm font-medium">WhatsApp</div>
                                            <div class="text-xs opacity-80">Chat langsung</div>
                                        </div>
                                    </div>
                                </a>
                                <a href="tel:02817781133" class="block bg-white bg-opacity-20 hover:bg-opacity-30 rounded-xl p-3 transition-all duration-300">
                                    <div class="flex items-center">
                                        <i class="fas fa-phone text-xl mr-3"></i>
                                        <div>
                                            <div class="text-sm font-medium">0281-7781133</div>
                                            <div class="text-xs opacity-80">Telepon langsung</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Articles -->
    @if ($relatedArticles->count())
    <section class="py-16 bg-gradient-to-r from-blue-50 to-purple-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Informasi & Promo Terkait</h2>
                <p class="text-gray-600">Temukan penawaran dan informasi menarik lainnya</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach ($relatedArticles as $article)
                <a href="{{ route('informations.show', $article->slug) }}"
                    class="bg-white rounded-2xl overflow-hidden shadow-lg card-hover block">
                    @if ($article->image)
                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                    @else
                    <img src="https://via.placeholder.com/400x200?text=Artikel" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                    @endif

                    <div class="p-6">
                        @php
                        $start = $article->start_date ? \Carbon\Carbon::parse($article->start_date)->locale('id')->isoFormat('D MMMM Y HH:mm') : null;
                        $end = $article->end_date ? \Carbon\Carbon::parse($article->end_date)->locale('id')->isoFormat('D MMMM Y HH:mm') : null;
                        $isPromo = Str::contains(strtolower($article->category->title ?? ''), 'promo');
                        @endphp

                        <span class="bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full font-medium mb-4">
                            @if ($isPromo)
                            @if ($start || $end)
                            Promo - Batas Waktu
                            @else
                            Promo - Tanpa Batas Waktu
                            @endif
                            @else
                            Informasi
                            @endif
                        </span>

                        <h3 class="text-lg font-bold text-gray-800 mt-3 mb-2">{{ $article->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4">
                            {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 100, '...') }}
                        </p>
                        <span class="text-blue-600 hover:text-blue-800 text-sm font-medium">Baca Selengkapnya →</span>
                    </div>
                </a>
                @endforeach
            </div>

        </div>
    </section>
    @endif

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-2xl font-bold mb-6">PT SATRIA DIGITAL MEDIA</h3>
                    <div class="space-y-2 text-gray-300">

                        <!-- Alamat: buka Google Maps -->
                        <p>
                            <a href="https://maps.app.goo.gl/ZSCQJEnEfAWzn7wj7" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors flex items-start">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                Jl. Arsadimedja, Perum Bumi Teluk Permai Blok F No. 16 Teluk, Purwokerto Selatan, Banyumas, Jawa Tengah 53124
                            </a>
                        </p>

                        <!-- No telpon -->
                        <p>
                            <a href="tel:02817781133" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors flex items-center">
                                <i class="fas fa-phone mr-2"></i> 0281–7781133
                            </a>
                        </p>

                        <!-- Email: buka email client -->
                        <p>
                            <a href="mailto:info@satrianet.co.id" class="hover:text-white transition-colors flex items-center">
                                <i class="fas fa-envelope mr-2"></i> info@satrianet.co.id
                            </a>
                        </p>

                        <!-- Website: buka satrianet.id -->
                        <p>
                            <a href="https://satrianet.id" target="_blank" rel="noopener noreferrer" class="hover:text-white transition-colors flex items-center">
                                <i class="fas fa-globe mr-2"></i> satrianet.id
                            </a>
                        </p>

                    </div>
                </div>

                <div class="lg:ml-16">
                    <h4 class="text-lg font-semibold mb-4">Perusahaan</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="{{ route('home') . '#tentang-kami' }}" class="hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="{{ route('home') . '#tentang-kami' }}" class="hover:text-white transition-colors">Organisasi</a></li>
                        <li><a href="{{ route('home') . '#tentang-kami' }}" class="hover:text-white transition-colors">Legalitas</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Produk & Layanan</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white transition-colors">Internet Provider</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Internet Dedicated</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">CCTV IPCAM</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Router</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">IP Public Static V4</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="font-semibold mb-3">Follow Us</h5>
                    <div class="flex space-x-4">
                        <a href="https://web.facebook.com/profile.php?id=100070538542707#" target="_blank" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/satrianet_official/" target="_blank" class="w-10 h-10 bg-pink-600 rounded-full flex items-center justify-center hover:bg-pink-700 transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://wa.me/6282138304415" target="_blank" class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center hover:bg-green-700 transition-colors">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; 2025 PT Satria Digital Media. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="https://wa.me/6282138304415" target="_blank" class="bg-green-500 hover:bg-green-600 text-white w-16 h-16 rounded-full flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 animate-bounce-gentle">
            <i class="fab fa-whatsapp text-2xl"></i>
        </a>
    </div>

    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="fixed bottom-6 left-6 bg-blue-600 hover:bg-blue-700 text-white w-12 h-12 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 opacity-0 pointer-events-none">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Toast Notification -->
    <div id="toast" class="fixed top-24 right-6 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 z-50">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            <span id="toast-message">Link berhasil disalin!</span>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileMenu = document.querySelector('.mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Scroll to top functionality
        const scrollToTopBtn = document.getElementById('scrollToTop');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                scrollToTopBtn.classList.remove('opacity-0', 'pointer-events-none');
            } else {
                scrollToTopBtn.classList.add('opacity-0', 'pointer-events-none');
            }
        });

        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Intersection Observer for animations
        const observeElements = document.querySelectorAll('.animate-slide-up');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.1
        });

        observeElements.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(50px)';
            el.style.transition = 'all 0.6s ease-out';
            observer.observe(el);
        });

        // Share functions
        function shareToWhatsApp() {
            const url = encodeURIComponent(window.location.href);
            const text = encodeURIComponent(document.title);
            const whatsappUrl = `https://wa.me/?text=${text}%20${url}`;
            window.open(whatsappUrl, '_blank');
        }

        function shareToFacebook() {
            const url = encodeURIComponent(window.location.href);
            const facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
            window.open(facebookUrl, '_blank', 'width=600,height=400');
        }

        function shareToInstagram() {
            // Instagram doesn't have direct URL sharing, so we'll copy to clipboard with a message
            copyToClipboard();
            showToast('Link disalin! Buka Instagram dan paste di story atau bio Anda', 'info');
        }

        function shareToTwitter() {
            const url = encodeURIComponent(window.location.href);
            const text = encodeURIComponent(document.title);
            const twitterUrl = `https://twitter.com/intent/tweet?text=${text}&url=${url}`;
            window.open(twitterUrl, '_blank', 'width=600,height=400');
        }

        function copyToClipboard() {
            const url = window.location.href;

            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(url).then(() => {
                    showToast('Link berhasil disalin!', 'success');
                }).catch(() => {
                    fallbackCopyTextToClipboard(url);
                });
            } else {
                fallbackCopyTextToClipboard(url);
            }
        }

        function fallbackCopyTextToClipboard(text) {
            const textArea = document.createElement("textarea");
            textArea.value = text;
            textArea.style.position = "fixed";
            textArea.style.left = "-999999px";
            textArea.style.top = "-999999px";
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();

            try {
                document.execCommand('copy');
                showToast('Link berhasil disalin!', 'success');
            } catch (err) {
                showToast('Gagal menyalin link', 'error');
            }

            document.body.removeChild(textArea);
        }

        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toast-message');
            const toastIcon = toast.querySelector('i');

            toastMessage.textContent = message;

            // Set color based on type
            toast.className = toast.className.replace(/bg-\w+-500/, '');
            toastIcon.className = toastIcon.className.replace(/fa-\w+-circle/, '');

            switch (type) {
                case 'success':
                    toast.classList.add('bg-green-500');
                    toastIcon.classList.add('fa-check-circle');
                    break;
                case 'error':
                    toast.classList.add('bg-red-500');
                    toastIcon.classList.add('fa-times-circle');
                    break;
                case 'info':
                    toast.classList.add('bg-blue-500');
                    toastIcon.classList.add('fa-info-circle');
                    break;
            }

            // Show toast
            toast.classList.remove('translate-x-full');

            // Hide toast after 3 seconds
            setTimeout(() => {
                toast.classList.add('translate-x-full');
            }, 3000);
        }

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Enhanced hover effects for cards
        document.querySelectorAll('.card-hover').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Parallax effect for floating elements
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const floatingElements = document.querySelectorAll('.social-float');

            floatingElements.forEach((element, index) => {
                const speed = (index + 1) * 0.1;
                element.style.transform = `translateY(${scrolled * speed}px)`;
            });
        });

        // Reading progress indicator
        function createReadingProgress() {
            const progressBar = document.createElement('div');
            progressBar.id = 'reading-progress';
            progressBar.style.cssText = `
                position: fixed;
                top: 64px;
                left: 0;
                width: 0%;
                height: 3px;
                background: linear-gradient(90deg, #3b82f6, #8b5cf6);
                z-index: 1000;
                transition: width 0.3s ease;
            `;
            document.body.appendChild(progressBar);

            window.addEventListener('scroll', () => {
                const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const scrolled = (winScroll / height) * 100;
                progressBar.style.width = scrolled + '%';
            });
        }

        // Initialize reading progress
        createReadingProgress();

        // Add click animation to buttons
        document.querySelectorAll('button, .share-button').forEach(button => {
            button.addEventListener('click', function(e) {
                // Create ripple effect
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.cssText = `
                    position: absolute;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    background: rgba(255, 255, 255, 0.3);
                    border-radius: 50%;
                    transform: scale(0);
                    animation: ripple-animation 0.6s linear;
                    pointer-events: none;
                `;

                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add ripple animation keyframes
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple-animation {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        // Lazy loading for images
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.style.opacity = '0';
                    img.style.transition = 'opacity 0.5s ease';

                    setTimeout(() => {
                        img.style.opacity = '1';
                    }, 100);

                    imageObserver.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img').forEach(img => {
            imageObserver.observe(img);
        });

        // Enhanced sticky sidebar behavior
        function initStickyBehavior() {
            const sidebar = document.querySelector('.sticky-share');
            const mainContent = document.querySelector('.lg\\:col-span-8');

            if (sidebar && mainContent) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            sidebar.style.transform = 'translateY(0)';
                            sidebar.style.opacity = '1';
                        } else {
                            sidebar.style.transform = 'translateY(-20px)';
                            sidebar.style.opacity = '0.8';
                        }
                    });
                }, {
                    threshold: 0.1
                });

                observer.observe(mainContent);
            }
        }

        // Initialize all features when DOM is ready
        document.addEventListener('DOMContentLoaded', () => {
            initStickyBehavior();

            // Add smooth transitions to all elements
            document.querySelectorAll('*').forEach(el => {
                if (!el.style.transition) {
                    el.style.transition = 'all 0.3s ease';
                }
            });
        });
    </script>
</body>

</html>