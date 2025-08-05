<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/icon.png') }}" type="image/x-icon">

    <!-- Primary Meta Tags -->
    <title>{{ $subcategory->name }} - SatriaNet</title>
    <meta name="title" content="{{ $subcategory->name }} - SatriaNet">
    <meta name="description" content="{{ $subcategory->description ?? 'Nikmati layanan internet cepat, stabil, dan terjangkau dari SatriaNet.' }}">
    <meta name="keywords" content="{{ $subcategory->meta_keywords }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $subcategory->name }} - SatriaNet">
    <meta property="og:description" content="{{ $subcategory->description ?? 'Nikmati layanan internet cepat, stabil, dan terjangkau dari SatriaNet.' }}">
    <meta property="og:image" content="{{ asset('assets/images/icon.png') }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $subcategory->name }} - SatriaNet">
    <meta name="twitter:description" content="{{ $subcategory->description ?? 'Nikmati layanan internet cepat, stabil, dan terjangkau dari SatriaNet.' }}">
    <meta name="twitter:image" content="{{ asset('assets/images/icon.png') }}">

    <!-- Canonical -->
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="description" content="{{ $subcategory->description ?? $subcategory->name }}">

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
                        'pulse-glow': 'pulseGlow 2s ease-in-out infinite',
                        'scale-hover': 'scaleHover 0.3s ease-out'
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

        @keyframes scaleHover {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(1.05);
            }
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .product-card {
            transition: all 0.4s ease;
            background: linear-gradient(145deg, #ffffff, #f8fafc);
        }

        .product-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.12);
            background: linear-gradient(145deg, #ffffff, #f1f5f9);
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

        .feature-item {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .feature-item:hover::before {
            left: 100%;
        }

        .price-badge {
            background: linear-gradient(135deg, #10b981, #059669);
            animation: pulse 2s ease-in-out infinite;
        }

        .category-badge {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        }

        .banner-overlay {
            background: linear-gradient(45deg, rgba(59, 130, 246, 0.9), rgba(139, 92, 246, 0.9));
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
            <nav class="flex items-center space-x-2 text-sm mb-4">
                <a href="/" class="text-blue-600 hover:text-blue-800 transition-colors">Home</a>
                <i class="fas fa-chevron-right text-gray-400"></i>
                <a href="/#packages" class="text-blue-600 hover:text-blue-800 transition-colors">Produk & Layanan</a>
                <i class="fas fa-chevron-right text-gray-400"></i>
                <span class="text-gray-500">{{ $subcategory->name }}</span>
            </nav>
        </div>
    </section>

    <!-- Hero Section -->
    <section class="py-12 bg-gradient-to-br from-blue-600 via-blue-700 to-purple-800 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="absolute inset-0">
            <div class="absolute top-10 left-10 w-72 h-72 bg-blue-400 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-float"></div>
            <div class="absolute top-0 right-4 w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-float" style="animation-delay: 2s;"></div>
            <div class="absolute -bottom-8 left-20 w-80 h-80 bg-pink-400 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-float" style="animation-delay: 4s;"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center animate-slide-up">
                <div class="mb-6">
                    <span class="category-badge text-white text-sm px-6 py-3 rounded-full font-bold flex items-center gap-2 w-fit mx-auto">
                        <i class="fas fa-layer-group"></i>
                        KATEGORI PRODUK
                    </span>
                </div>

                <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">{{ $subcategory->name }}</h1>

                @if ($subcategory->sub_title)
                <h2 class="text-2xl md:text-3xl opacity-90 mb-8 font-light">{{ $subcategory->sub_title }}</h2>
                @endif

                <!-- Share Buttons -->
                <div class="flex items-center justify-center gap-4 mb-8">
                    <span class="text-sm opacity-80">Bagikan Kategori:</span>
                    <div class="flex gap-3">
                        <button onclick="shareToWhatsApp()" class="share-button bg-green-500 hover:bg-green-600 text-white w-12 h-12 rounded-full flex items-center justify-center">
                            <i class="fab fa-whatsapp text-lg"></i>
                        </button>
                        <button onclick="shareToFacebook()" class="share-button bg-blue-600 hover:bg-blue-700 text-white w-12 h-12 rounded-full flex items-center justify-center">
                            <i class="fab fa-facebook-f text-lg"></i>
                        </button>
                        <button onclick="shareToInstagram()" class="share-button bg-pink-500 hover:bg-pink-600 text-white w-12 h-12 rounded-full flex items-center justify-center">
                            <i class="fab fa-instagram text-lg"></i>
                        </button>
                        <button onclick="shareToTwitter()" class="share-button bg-blue-400 hover:bg-blue-500 text-white w-12 h-12 rounded-full flex items-center justify-center">
                            <i class="fab fa-twitter text-lg"></i>
                        </button>
                        <button onclick="copyToClipboard()" class="share-button bg-gray-600 hover:bg-gray-700 text-white w-12 h-12 rounded-full flex items-center justify-center">
                            <i class="fas fa-link text-lg"></i>
                        </button>
                    </div>
                </div>

                <!-- Stats -->
                <div class="grid md:grid-cols-3 gap-8 max-w-3xl mx-auto">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-yellow-400">{{ $subcategory->products->count() }}</div>
                        <div class="text-sm opacity-80">Produk Tersedia</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-400">24/7</div>
                        <div class="text-sm opacity-80">Dukungan Teknis</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-blue-400">Terbaik</div>
                        <div class="text-sm opacity-80">Kualitas Layanan</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-8">
                <!-- Main Content Area -->
                <div class="lg:col-span-8">
                    <!-- Banner -->
                    @if ($subcategory->banner)
                    <div class="mb-12 animate-slide-up">
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                            <img src="{{ asset('storage/' . $subcategory->banner) }}"
                                alt="{{ $subcategory->name }}"
                                class="w-full h-96 object-cover">
                        </div>
                    </div>
                    @endif

                    <!-- Description -->
                    @if ($subcategory->description)
                    <div class="bg-white rounded-3xl p-8 shadow-lg mb-8 animate-slide-up" style="animation-delay: 0.2s">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-info-circle text-blue-600 mr-3"></i>
                            Tentang {{ $subcategory->name }}
                        </h2>
                        <div class="prose prose-lg text-gray-600 leading-relaxed">
                            {!! nl2br(e($subcategory->description)) !!}
                        </div>
                    </div>
                    @endif

                    <!-- Features -->
                    @if ($subcategory->features && count($subcategory->features))
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-3xl p-8 mb-8 animate-slide-up" style="animation-delay: 0.4s">
                        <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center flex items-center justify-center">
                            <i class="fas fa-star text-yellow-500 mr-3"></i>
                            Keunggulan & Fitur
                        </h2>
                        <div class="grid md:grid-cols-2 gap-6">
                            @foreach ($subcategory->features as $index => $feature)
                            <div class="feature-item bg-white rounded-2xl p-6 shadow-md hover:shadow-lg border-l-4 border-blue-500" style="animation-delay: {{ $index * 0.1 }}s">
                                <div class="flex items-start">
                                    <div class="bg-blue-100 text-blue-600 w-10 h-10 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                        <i class="fas fa-check text-sm"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 mb-2">{{ $feature['feature'] }}</h3>
                                        <p class="text-sm text-gray-600">Fitur unggulan yang memberikan nilai lebih untuk pengalaman internet Anda.</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Products Grid -->
                    <div class="animate-slide-up" style="animation-delay: 0.6s">
                        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center flex items-center justify-center">
                            <i class="fas fa-box text-blue-600 mr-3"></i>
                            Daftar Produk {{ $subcategory->name }}
                        </h2>

                        @if ($subcategory->products->count())
                        <div class="grid md:grid-cols-2 gap-8">
                            @foreach ($subcategory->products as $index => $product)
                            <div class="product-card rounded-3xl p-8 shadow-lg border border-gray-100" style="animation-delay: {{ $index * 0.1 }}s">
                                <!-- Product Header -->
                                <div class="flex items-start justify-between mb-6">
                                    <div class="flex items-center">
                                        <div class="bg-blue-600 text-white w-12 h-12 rounded-full flex items-center justify-center mr-4">
                                            <i class="fas fa-wifi text-lg"></i>
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-bold text-gray-800">{{ $product->name }}</h3>
                                            <p class="text-sm text-gray-500">Paket Internet Premium</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product Description -->
                                <p class="text-gray-600 mb-6 leading-relaxed">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($product->description), 120) }}
                                </p>

                                <!-- Product Features -->
                                @if (!empty($product->features))
                                <div class="mb-6">
                                    <h4 class="font-semibold text-gray-800 mb-3 flex items-center">
                                        <i class="fas fa-list-check text-blue-600 mr-2"></i>
                                        Fitur Unggulan:
                                    </h4>
                                    <ul class="space-y-2">
                                        @foreach (array_slice($product->features, 0, 3) as $feature)
                                        @if(is_array($feature) && isset($feature['feature']))
                                        <li class="flex items-center text-sm text-gray-700">
                                            <i class="fas fa-check-circle text-green-500 mr-2 flex-shrink-0"></i>
                                            {{ $feature['feature'] }}
                                        </li>
                                        @endif
                                        @endforeach
                                        @if (count($product->features) > 3)
                                        <li class="text-sm text-blue-600 font-medium">
                                            +{{ count($product->features) - 3 }} fitur lainnya
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                                @endif

                                <!-- Price and CTA -->
                                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                                    <div>
                                        <div class="text-3xl font-bold text-blue-600">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </div>
                                        <div class="text-sm text-gray-500">per bulan</div>
                                    </div>
                                    <a href="{{ route('registrations.create', ['product_id' => $product->id]) }}"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 animate-pulse-glow">
                                        <i class="fas fa-rocket mr-2"></i>
                                        Daftar Sekarang
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="text-center py-16">
                            <div class="bg-gray-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-box-open text-4xl text-gray-400"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-600 mb-2">Produk Segera Hadir</h3>
                            <p class="text-gray-500 mb-6">Kami sedang mempersiapkan produk terbaik untuk kategori ini.</p>
                            <a href="https://wa.me/6282138304415" target="_blank" rel="noopener noreferrer"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-full font-semibold transition-all duration-300">
                                <i class="fab fa-whatsapp mr-2"></i>
                                Hubungi Kami untuk Info
                            </a>
                        </div>
                        @endif
                    </div>

                    <!-- Call to Action -->
                    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl p-8 text-center mt-12 animate-slide-up" style="animation-delay: 0.8s">
                        <h3 class="text-2xl font-bold text-white mb-4">Butuh Konsultasi Produk?</h3>
                        <p class="text-white opacity-90 mb-6">Tim ahli kami siap membantu Anda memilih paket yang tepat sesuai kebutuhan</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="https://wa.me/6282138304415" target="_blank" rel="noopener noreferrer">
                                <button class="bg-white text-blue-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 animate-pulse-glow">
                                    <i class="fab fa-whatsapp mr-2"></i>
                                    Chat WhatsApp
                                </button>
                            </a>
                            <a href="tel:02817781133">
                                <button class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-blue-600 transition-all duration-300 transform hover:scale-105">
                                    <i class="fas fa-phone mr-2"></i>
                                    Telepon Langsung
                                </button>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-4">
                    <div class="sticky-share">
                        <!-- Social Share Widget -->
                        <div class="bg-white rounded-2xl p-6 shadow-lg mb-8 social-float">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-share-alt mr-2 text-blue-600"></i>
                                Bagikan Kategori
                            </h3>
                            <p class="text-sm text-gray-600 mb-4">Bagikan kategori produk ini kepada teman dan keluarga</p>
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

                        <!-- Other Subcategories -->
                        <div class="bg-white rounded-2xl p-6 shadow-lg mb-8">
                            <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                                <i class="fas fa-layer-group mr-2 text-purple-600"></i>
                                Kategori Produk Lainnya
                            </h3>

                            <div class="space-y-4">
                                @foreach ($otherSubcategories as $item)
                                @php
                                $colors = ['blue', 'green', 'purple', 'orange', 'indigo', 'red'];
                                $color = $colors[$loop->index % count($colors)];
                                @endphp
                                <a href="{{ route('subcategories.show', $item->slug) }}"
                                    class="block border-l-4 border-{{ $color }}-500 pl-4 py-3 hover:bg-{{ $color }}-50 transition-colors rounded-r-lg">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="font-semibold text-gray-800 text-sm">{{ $item->name }}</h4>
                                            <p class="text-gray-600 text-xs mt-1">
                                                {{ Str::words($item->sub_title ?? 'Lihat produk lainnya', 5, '...') }}
                                            </p>
                                        </div>
                                        <div class="bg-{{ $color }}-100 text-{{ $color }}-600 text-xs px-2 py-1 rounded-full">
                                            {{ $item->products_count }} Produk
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>

                            <a href="{{ route('home') . '#paket-dan-harga' }}" class="block mt-6 text-center bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white py-3 px-4 rounded-xl text-sm font-medium transition-all duration-300">
                                <i class="fas fa-th-large mr-2"></i>
                                Lihat Semua Kategori
                            </a>
                        </div>

                        <!-- Quick Contact -->
                        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white mb-8">
                            <h3 class="text-lg font-bold mb-4 flex items-center">
                                <i class="fas fa-headset mr-2"></i>
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

                        <!-- Product Benefits -->
                        <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-6 shadow-lg">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-trophy mr-2 text-yellow-500"></i>
                                Mengapa Pilih SatriaNet?
                            </h3>
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="bg-blue-100 text-blue-600 w-8 h-8 rounded-full flex items-center justify-center mr-3 flex-shrink-0 mt-1">
                                        <i class="fas fa-bolt text-xs"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800 text-sm">Kecepatan Stabil</h4>
                                        <p class="text-gray-600 text-xs">Internet cepat dan stabil 24/7</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="bg-green-100 text-green-600 w-8 h-8 rounded-full flex items-center justify-center mr-3 flex-shrink-0 mt-1">
                                        <i class="fas fa-shield-alt text-xs"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800 text-sm">Teknologi Terdepan</h4>
                                        <p class="text-gray-600 text-xs">Infrastruktur fiber optik modern</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="bg-purple-100 text-purple-600 w-8 h-8 rounded-full flex items-center justify-center mr-3 flex-shrink-0 mt-1">
                                        <i class="fas fa-users text-xs"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800 text-sm">Support 24/7</h4>
                                        <p class="text-gray-600 text-xs">Tim teknis siap membantu kapan saja</p>
                                    </div>
                                </div>
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
            const text = encodeURIComponent(`Lihat kategori produk ${document.title} di SatriaNet`);
            const whatsappUrl = `https://wa.me/?text=${text}%20${url}`;
            window.open(whatsappUrl, '_blank');
        }

        function shareToFacebook() {
            const url = encodeURIComponent(window.location.href);
            const facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
            window.open(facebookUrl, '_blank', 'width=600,height=400');
        }

        function shareToInstagram() {
            copyToClipboard();
            showToast('Link disalin! Buka Instagram dan paste di story atau bio Anda', 'info');
        }

        function shareToTwitter() {
            const url = encodeURIComponent(window.location.href);
            const text = encodeURIComponent(`Lihat kategori produk ${document.title} di SatriaNet`);
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

            toast.classList.remove('translate-x-full');

            setTimeout(() => {
                toast.classList.add('translate-x-full');
            }, 3000);
        }

        // Enhanced hover effects for product cards
        document.querySelectorAll('.product-card').forEach(card => {
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

            document.querySelectorAll('*').forEach(el => {
                if (!el.style.transition) {
                    el.style.transition = 'all 0.3s ease';
                }
            });
        });
    </script>
</body>

</html>