<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SatriaNet - Internet Cepat dan Stabil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Include Swiper CSS & JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
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
                        'bounce-gentle': 'bounceGentle 2s ease-in-out infinite'
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

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="font-sans">
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
                    <a href="#tentang-kami" class="nav-link text-gray-700 hover:text-primary transition-colors duration-200">Tentang Kami</a>
                    <a href="#informasi-dan-promo" class="nav-link text-gray-700 hover:text-primary transition-colors duration-200">Informasi & Promo</a>
                    <a href="#paket-dan-harga" class="nav-link text-gray-700 hover:text-primary transition-colors duration-200">Paket & Harga</a>
                    <a href="#coverage" class="nav-link text-gray-700 hover:text-primary transition-colors duration-200">Coverage Area</a>
                    <a href="#kerja-sama" class="nav-link text-gray-700 hover:text-primary transition-colors duration-200">Kerja Sama</a>
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
                <a href="#tentang-kami" class="nav-link block px-3 py-2 text-gray-700 hover:text-primary">Tentang Kami</a>
                <a href="#informasi-dan-promo" class="nav-link block px-3 py-2 text-gray-700 hover:text-primary">Informasi & Promo</a>
                <a href="#paket-dan-harga" class="nav-link block px-3 py-2 text-gray-700 hover:text-primary">Paket & Harga</a>
                <a href="#coverage" class="nav-link block px-3 py-2 text-gray-700 hover:text-primary">Coverage Area</a>
                <a href="#kerja-sama" class="nav-link block px-3 py-2 text-gray-700 hover:text-primary">Kerja Sama</a>
                <a href="{{ route('informations.show', 'informasi-pembayaran-satrianet') }}" class="nav-link block px-3 py-2 text-gray-700 hover:text-primary transition-colors duration-200">Cara Bayar</a>
                <a href="https://wa.me/6282138304415" target="_blank" rel="noopener noreferrer" class="block px-3 py-2">
                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-full font-semibold transition-all duration-300">
                        Hubungi Kami
                    </button>
                </a>
            </div>
        </div>
    </nav>

    <!-- Banner Section -->
    <section class="relative w-full min-h-screen overflow-hidden mt-14">
        @if($banners && $banners->count())
        <div class="swiper mySwiper w-full h-full">
            <div class="swiper-wrapper w-full h-full">
                @foreach($banners as $banner)
                <div class="swiper-slide w-full h-full">
                    <img
                        src="{{ Storage::url($banner->image) }}"
                        alt="{{ $banner->title }}"
                        class="w-full h-full object-cover object-center">
                </div>
                @endforeach
            </div>

            <!-- Navigation buttons -->
            <div class="swiper-button-prev text-white text-4xl"></div>
            <div class="swiper-button-next text-white text-4xl"></div>
        </div>
        @else
        <div class="w-full min-h-screen flex items-center justify-center bg-gray-200 text-gray-500 text-xl">
            Banner tidak tersedia atau tidak aktif.
        </div>
        @endif
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-8 text-center card-hover animate-slide-up">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-wifi text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Fast Wifi</h3>
                    <p class="text-gray-600">Koneksi internet super cepat hingga 100 Mbps untuk kebutuhan streaming dan gaming.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 text-center card-hover animate-slide-up" style="animation-delay: 0.2s">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-headset text-2xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Support 24/7 CS</h3>
                    <p class="text-gray-600">Tim customer service yang siap membantu Anda 24 jam sehari, 7 hari seminggu.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 text-center card-hover animate-slide-up" style="animation-delay: 0.4s">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-network-wired text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">100% Fiber Optik</h3>
                    <p class="text-gray-600">Teknologi fiber optik terdepan untuk koneksi yang stabil dan reliable.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Kami -->
    <section id="tentang-kami" class="py-20 bg-gradient-to-r from-blue-50 to-purple-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="animate-slide-up">
                    <h2 class="text-4xl font-bold text-gray-800 mb-6">Satria Digital Media</h2>
                    <p class="text-xl text-gray-600 mb-8">
                        Nikmati koneksi internet cepat dan stabil untuk streaming, gaming hingga bekerja dari rumah.
                        Satria Digital Media hadir dengan layanan WiFi terbaik dan pengalaman online tanpa hambatan.
                    </p>

                    <!-- Legalitas -->
                    <div class="mb-6 border-l-4 border-blue-600 pl-4 flex items-start">
                        <i class="fas fa-gavel text-blue-600 text-2xl mr-4"></i>
                        <div>
                            <h4 class="text-lg font-bold text-gray-700 mb-2">Legalitas Perusahaan</h4>
                            <p class="text-xl text-gray-600">
                                Izin Operasional 02130100506830015, Izin SKLO JASA-002/TEL. 04.02/2023
                            </p>
                        </div>
                    </div>

                    <!-- Organisasi -->
                    <div class="mb-8 border-l-4 border-purple-600 pl-4 flex items-start">
                        <i class="fas fa-users text-purple-600 text-2xl mr-4"></i>
                        <div>
                            <h4 class="text-lg font-bold text-gray-700 mb-2">Organisasi</h4>
                            <p class="text-xl text-gray-600">
                                Anggota APJII No. 1002/REKOM/APJII-JATENG/III/2023
                            </p>
                        </div>
                    </div>

                    <a href="https://wa.me/6282138304415" target="_blank" rel="noopener noreferrer">
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">
                            HUBUNGI KAMI
                        </button>
                    </a>
                </div>
                <div class="relative animate-float">
                    <div class="bg-gradient-to-br from-yellow-400 to-orange-500 rounded-3xl p-8">
                        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMwMCIgdmlld0JveD0iMCAwIDQwMCAzMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSI0MDAiIGhlaWdodD0iMzAwIiBmaWxsPSJ1cmwoI3BhaW50MF9saW5lYXJfMF8xKSIvPgo8Y2lyY2xlIGN4PSIyMDAiIGN5PSIxNTAiIHI9IjgwIiBmaWxsPSIjRkZGRkZGIiBvcGFjaXR5PSIwLjMiLz4KPHJlY3QgeD0iMTYwIiB5PSIxMTAiIHdpZHRoPSI4MCIgaGVpZ2h0PSI4MCIgcng9IjEwIiBmaWxsPSIjRkZGRkZGIiBvcGFjaXR5PSIwLjUiLz4KPHN2ZyB4PSIxODAiIHk9IjEzMCIgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiBmaWxsPSIjMzMzIiBvcGFjaXR5PSIwLjciPgo8cGF0aCBkPSJNMjAgMTBWMzBIMzBWMTBIMjBaTTI1IDEyLjVMMjIuNSAxNVYyNUgyNy41VjE1TDI1IDEyLjVaIi8+Cjwvc3ZnPgo8ZGVmcz4KPGxpbmVhckdyYWRpZW50IGlkPSJwYWludDBfbGluZWFyXzBfMSIgeDE9IjAiIHkxPSIwIiB4Mj0iNDAwIiB5Mj0iMzAwIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+CjxzdG9wIHN0b3AtY29sb3I9IiNGNTlFMEIiLz4KPHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjRUY0NDQ0Ii8+CjwvbGluZWFyR3JhZGllbnQ+CjwvZGVmcz4KPC9zdmc+Cg==" alt="Digital Media" class="w-full h-auto rounded-2xl">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Informasi & Promo Section (Gabungan Semua Kategori) -->
    <section id="informasi-dan-promo" class="py-20 bg-gradient-to-r from-blue-50 to-blue-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Informasi & Promo</h2>
                <p class="text-xl text-gray-600">Temukan penawaran menarik dari berbagai kategori</p>
            </div>

            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($categories as $category)
                @foreach ($category->informations as $info)
                <div class="bg-gradient-to-br from-blue-600 to-blue-800 text-white rounded-2xl p-6 card-hover h-[500px] flex flex-col justify-between">
                    <div>
                        @php
                        $start = $info->start_date ? \Carbon\Carbon::parse($info->start_date)->locale('id')->isoFormat('D MMMM Y HH:mm') : null;
                        $end = $info->end_date ? \Carbon\Carbon::parse($info->end_date)->locale('id')->isoFormat('D MMMM Y HH:mm') : null;

                        $isPromo = Str::contains(strtolower($category->title), 'promo');
                        @endphp

                        <span class="bg-yellow-400 text-black text-xs px-3 py-1 rounded-full font-bold flex items-center gap-1 mb-4">
                            @if ($start || $end)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3M16 7V3M4 11h16M5 20h14a2 2 0 002-2v-5H3v5a2 2 0 002 2z" />
                            </svg>
                            {{ $start ?? '–' }} - {{ $end ?? '–' }}
                            @else
                            {{ $isPromo ? 'PROMO TANPA BATAS WAKTU' : 'INFORMASI' }}
                            @endif
                        </span>

                        @if ($info->image)
                        <img src="{{ asset('storage/' . $info->image) }}" alt="{{ $info->title }}"
                            class="rounded-lg mb-4 w-full h-40 object-cover">
                        @endif

                        <h3 class="text-lg font-bold mb-2">{{ $info->title }}</h3>
                        <p class="text-sm opacity-90">
                            {{ \Illuminate\Support\Str::limit(strip_tags($info->content), 100) }}
                        </p>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('informations.show', $info->slug) }}"
                            class="bg-white text-blue-600 px-4 py-2 rounded-full text-sm font-semibold hover:bg-gray-100 transition-colors">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
                @endforeach
                @endforeach
            </div>
        </div>
    </section>

    <!-- Packages Section -->
    <section id="paket-dan-harga" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @foreach ($productCategories as $category)
            @if ($category->subCategories && $category->subCategories->count())
            <div class="mb-16">
                <!-- Dynamic Header -->
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">{{ $category->name }}</h2>
                    @if ($category->description)
                    <p class="text-xl text-gray-600">{{ $category->description }}</p>
                    @endif
                </div>

                <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                    @foreach ($category->subCategories as $sub)
                    <div class="
                        {{ $loop->index % 2 === 0 
                            ? 'bg-gradient-to-br from-blue-600 to-blue-800' 
                            : 'bg-gradient-to-br from-yellow-400 to-yellow-600' }} 
                        rounded-3xl p-8 text-center card-hover transform hover:scale-105 transition-all duration-300">

                        <h4 class="text-2xl font-bold text-white mb-2">{{ $sub->name }}</h4>

                        @if ($sub->sub_title)
                        <p class="text-white opacity-90 mb-6">{{ $sub->sub_title }}</p>
                        @endif

                        @php
                        $firstProduct = $sub->products->first();
                        @endphp

                        @php
                        $cheapestProduct = $sub->products->sortBy('price')->first();
                        @endphp

                        @if ($cheapestProduct)
                        <div class="bg-white bg-opacity-20 rounded-2xl p-6 mb-6">
                            <div class="text-3xl font-bold text-white mb-2">
                                Mulai dari Rp. {{ number_format($cheapestProduct->price, 0, ',', '.') }}
                            </div>
                            <div class="text-white opacity-90 text-sm">per {{ $cheapestProduct->billing_period ?? 'bulan' }}</div>
                        </div>
                        @endif

                        <ul class="text-white text-left space-y-2 mb-8">
                            @foreach ($sub->features as $feat)
                            <li class="flex items-center"><i class="fas fa-check mr-2"></i>{{ $feat['feature'] }}</li>
                            @endforeach
                        </ul>

                        <a href="{{ route('subcategories.show', $sub->slug) }}"
                            class="bg-white text-yellow-600 w-full py-3 rounded-full font-bold hover:bg-gray-100 transition-colors block text-center">
                            DETAIL
                        </a>
                    </div>
                    @endforeach
                </div>

            </div>
            @endif
            @endforeach
        </div>
    </section>

    <!-- Coverage Area -->
    <section id="coverage" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Coverage Area</h2>
                <p class="text-xl text-gray-600">
                    Coverage Area: PT Satria Digital Media melayani koneksi internet untuk kebutuhan Corporate di wilayah Jawa, Sumatra, Kalimantan, dan Sulawesi, serta layanan Broadband di wilayah Banyumas.
                </p>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-xl">
                <div class="aspect-video rounded-2xl overflow-hidden">
                    <img src="{{ asset('assets/images/cakupan_wilayah.png') }}"
                        alt="Coverage Area Map"
                        class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="kerja-sama" class="py-20 bg-gradient-to-r from-blue-600 to-purple-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-white">
                    <h2 class="text-4xl font-bold mb-6">Usaha internet lebih mudah dengan monitoring terkontrol</h2>
                    <p class="text-xl opacity-90 mb-8">
                        SatriaNet menyediakan solusi terlengkapi untuk bisnis yang mengandalkan internet dalam operasional
                        sehari-hari dengan dukungan teknis 24/7 dan jaringan yang handal.
                    </p>
                    <a href="https://wa.me/6282138304415" target="_blank" rel="noopener noreferrer">
                        <button class="bg-yellow-400 hover:bg-yellow-500 text-black px-8 py-4 rounded-full font-bold text-lg transition-all duration-300 transform hover:scale-105">
                            Hubungi Kami
                        </button>
                    </a>
                </div>
                <div class="text-white">
                    <h2 class="text-4xl font-bold mb-6">Mau gunya usaha internet? Buka franchise Aja</h2>
                    <p class="text-xl opacity-90 mb-8">
                        Bergabunglah dengan mitra franchise SatriaNet dan dapatkan kesempatan berbisnis dengan
                        dukungan penuh sistem manajemen dan teknologi terdepan.
                    </p>
                    <a href="https://wa.me/6282138304415" target="_blank" rel="noopener noreferrer">
                        <button class="bg-yellow-400 hover:bg-yellow-500 text-black px-8 py-4 rounded-full font-bold text-lg transition-all duration-300 transform hover:scale-105">
                            Hubungi Kami
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </section>

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
                        <li><a href="#tentang-kami" class="hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="#tentang-kami" class="hover:text-white transition-colors">Organisasi</a></li>
                        <li><a href="#tentang-kami" class="hover:text-white transition-colors">Legalitas</a></li>
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

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileMenu = document.querySelector('.mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            const scrollToTopBtn = document.getElementById('scrollToTop');

            if (window.scrollY > 100) {
                navbar.classList.add('shadow-xl', 'bg-white/95', 'backdrop-blur-sm');
                scrollToTopBtn.classList.remove('opacity-0', 'pointer-events-none');
            } else {
                navbar.classList.remove('shadow-xl', 'bg-white/95', 'backdrop-blur-sm');
                scrollToTopBtn.classList.add('opacity-0', 'pointer-events-none');
            }
        });

        // Smooth scroll for navigation links
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
                // Close mobile menu if open
                mobileMenu.classList.add('hidden');
            });
        });

        // Scroll to top functionality
        document.getElementById('scrollToTop').addEventListener('click', () => {
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

        // Add loading animation
        window.addEventListener('load', () => {
            document.body.classList.add('loaded');
        });

        // Parallax effect for hero section
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const parallax = document.querySelector('.gradient-bg');
            const speed = scrolled * 0.5;
            parallax.style.transform = `translateY(${speed}px)`;
        });

        // Add click animation to buttons
        document.querySelectorAll('button').forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add typing effect to main heading
        const heading = document.querySelector('h1');
        const text = heading.textContent;
        heading.textContent = '';
        let i = 0;
        const typeWriter = () => {
            if (i < text.length) {
                heading.textContent += text.charAt(i);
                i++;
                setTimeout(typeWriter, 50);
            }
        };
        setTimeout(typeWriter, 1000);
    </script>

    <style>
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #1e40af;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #1e3a8a;
        }

        /* Loading animation */
        body:not(.loaded) {
            overflow: hidden;
        }

        body:not(.loaded)::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        body:not(.loaded)::after {
            content: 'SatriaNet';
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 2rem;
            font-weight: bold;
            z-index: 10000;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        /* Improved hover effects */
        .card-hover {
            position: relative;
            overflow: hidden;
        }

        .card-hover::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s;
        }

        .card-hover:hover::before {
            left: 100%;
        }
    </style>

    <script>
        const swiper = new Swiper(".mySwiper", {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            effect: "fade",
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const sections = document.querySelectorAll("section[id]");
            const navLinks = document.querySelectorAll(".nav-link");

            function activateNav() {
                let scrollY = window.pageYOffset;

                sections.forEach(current => {
                    const sectionHeight = current.offsetHeight;
                    const sectionTop = current.offsetTop - 100;
                    const sectionId = current.getAttribute("id");

                    if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
                        navLinks.forEach(link => {
                            link.classList.remove("text-blue-600", "font-bold");
                            if (link.getAttribute("href") === `#${sectionId}`) {
                                link.classList.add("text-blue-600", "font-bold");
                            }
                        });
                    }
                });
            }

            window.addEventListener("scroll", activateNav);
        });
    </script>

</body>

</html>