<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SatriaNet - Internet Cepat dan Stabil</title>
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
                        <h1 class="text-2xl font-bold text-primary">SatriaNet</h1>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-primary transition-colors duration-200">Home</a>
                    <a href="#services" class="text-gray-700 hover:text-primary transition-colors duration-200">Tentang Kami</a>
                    <a href="#packages" class="text-gray-700 hover:text-primary transition-colors duration-200">Informasi</a>
                    <a href="#coverage" class="text-gray-700 hover:text-primary transition-colors duration-200">Harga Servis</a>
                    <a href="#contact" class="text-gray-700 hover:text-primary transition-colors duration-200">Paket Internet</a>
                    <a href="#contact" class="text-gray-700 hover:text-primary transition-colors duration-200">Coverage Area</a>
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
                <a href="#home" class="block px-3 py-2 text-gray-700 hover:text-primary">Home</a>
                <a href="#services" class="block px-3 py-2 text-gray-700 hover:text-primary">Tentang Kami</a>
                <a href="#packages" class="block px-3 py-2 text-gray-700 hover:text-primary">Informasi</a>
                <a href="#coverage" class="block px-3 py-2 text-gray-700 hover:text-primary">Harga Servis</a>
                <a href="#contact" class="block px-3 py-2 text-gray-700 hover:text-primary">Paket Internet</a>
                <a href="#contact" class="block px-3 py-2 text-gray-700 hover:text-primary">Coverage Area</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="gradient-bg min-h-screen flex items-center pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-white animate-fade-in">
                    <h1 class="text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                        Internet<span class="text-yellow-300">an</span> Sepuasnya Dirumah
                    </h1>
                    <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-2xl p-6 mb-8">
                        <h3 class="text-xl font-semibold mb-2">About Us</h3>
                        <h2 class="text-2xl font-bold mb-4">Nikmati internet cepat dan stabil dari Satria Net</h2>
                        <p class="text-lg opacity-90 mb-6">
                            Dapatkan koneksi internet terbaik dengan teknologi fiber optik terdepan.
                            Streaming, gaming, dan bekerja tanpa hambatan.
                        </p>
                        <div class="flex flex-wrap gap-4 mb-6">
                            <div class="bg-yellow-400 text-black px-4 py-2 rounded-full font-bold">
                                100% <br>GARANSI
                            </div>
                            <div class="bg-yellow-400 text-black px-4 py-2 rounded-full font-bold">
                                24/7<br>UNLIMITED
                            </div>
                        </div>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">
                            BUY NOW
                        </button>
                    </div>
                </div>
                <div class="relative animate-float">
                    <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTAwIiBoZWlnaHQ9IjQwMCIgdmlld0JveD0iMCAwIDUwMCA0MDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSI1MDAiIGhlaWdodD0iNDAwIiBmaWxsPSJ1cmwoI3BhaW50MF9saW5lYXJfMF8xKSIvPgo8cGF0aCBkPSJNMTUwIDIwMEM5MC4xIDIwMCA0MCAyNDkuOSA0MCAzMDBTOTAuMSA0MDAgMTUwIDQwMFMyNjAgMzUwLjEgMjYwIDMwMFMyMDkuOSAyMDAgMTUwIDIwMFoiIGZpbGw9IiNGRkZGRkYiIG9wYWNpdHk9IjAuMSIvPgo8cGF0aCBkPSJNMzUwIDEwMEMyOTAuMSAxMDAgMjQwIDE0OS45IDI0MCAyMDBTMjkwLjEgMzAwIDM1MCAzMDBTNDYwIDI1MC4xIDQ2MCAyMDBTNDA5LjkgMTAwIDM1MCAxMDBaIiBmaWxsPSIjRkZGRkZGIiBvcGFjaXR5PSIwLjE1Ii8+CjxjaXJjbGUgY3g9IjI1MCIgY3k9IjIwMCIgcj0iNDAiIGZpbGw9IiNGRkZGRkYiIG9wYWNpdHk9IjAuMyIvPgo8ZGVmcz4KPGxpbmVhckdyYWRpZW50IGlkPSJwYWludDBfbGluZWFyXzBfMSIgeDE9IjAiIHkxPSIwIiB4Mj0iNTAwIiB5Mj0iNDAwIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+CjxzdG9wIHN0b3AtY29sb3I9IiM2NjdFRUEiLz4KPHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjNzY0QkEyIi8+CjwvbGluZWFyR3JhZGllbnQ+CjwvZGVmcz4KPC9zdmc+Cg==" alt="Family enjoying internet" class="w-full h-auto rounded-2xl shadow-2xl">
                </div>
            </div>
        </div>
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

    <!-- Promo Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Promo Satrianet</h2>
                <p class="text-xl text-gray-600">Nikmati berbagai special promo terbatas untuk paket internet streaming, gaming hingga keya hari!</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Promo Card 1 -->
                <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl p-6 text-white card-hover">
                    <div class="mb-4">
                        <span class="bg-yellow-400 text-black text-xs px-3 py-1 rounded-full font-bold">PROMO TERBATAS</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Parang Satrianet sekarang, dan dapatkan WIFI Premium gratis selama 30 Agustus 2022</h3>
                    <p class="text-sm opacity-90 mb-4">Bersiala gratis! Garansi dengan 30 Agustus 2022</p>
                    <button class="bg-white text-blue-600 px-4 py-2 rounded-full text-sm font-semibold hover:bg-gray-100 transition-colors">
                        GABUNG SEKARANG
                    </button>
                </div>

                <!-- Promo Card 2 -->
                <div class="bg-gradient-to-br from-purple-600 to-purple-800 rounded-2xl p-6 text-white card-hover">
                    <div class="mb-4">
                        <span class="bg-yellow-400 text-black text-xs px-3 py-1 rounded-full font-bold">PROMO TERBATAS</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Parang Satrianet sekarang, dan dapatkan WIFI Premium gratis selama 30 Agustus 2022</h3>
                    <p class="text-sm opacity-90 mb-4">Bersiala gratis! Garansi dengan 30 Agustus 2022</p>
                    <button class="bg-white text-purple-600 px-4 py-2 rounded-full text-sm font-semibold hover:bg-gray-100 transition-colors">
                        GABUNG SEKARANG
                    </button>
                </div>

                <!-- Promo Card 3 -->
                <div class="bg-gradient-to-br from-green-600 to-green-800 rounded-2xl p-6 text-white card-hover">
                    <div class="mb-4">
                        <span class="bg-yellow-400 text-black text-xs px-3 py-1 rounded-full font-bold">PROMO TERBATAS</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Parang Satrianet sekarang, dan dapatkan WIFI Premium gratis selama 30 Agustus 2022</h3>
                    <p class="text-sm opacity-90 mb-4">Bersiala gratis! Garansi dengan 30 Agustus 2022</p>
                    <button class="bg-white text-green-600 px-4 py-2 rounded-full text-sm font-semibold hover:bg-gray-100 transition-colors">
                        GABUNG SEKARANG
                    </button>
                </div>

                <!-- Promo Card 4 -->
                <div class="bg-gradient-to-br from-red-600 to-red-800 rounded-2xl p-6 text-white card-hover">
                    <div class="mb-4">
                        <span class="bg-yellow-400 text-black text-xs px-3 py-1 rounded-full font-bold">PROMO TERBATAS</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Parang Satrianet sekarang, dan dapatkan WIFI Premium gratis selama 30 Agustus 2022</h3>
                    <p class="text-sm opacity-90 mb-4">Bersiala gratis! Garansi dengan 30 Agustus 2022</p>
                    <button class="bg-white text-red-600 px-4 py-2 rounded-full text-sm font-semibold hover:bg-gray-100 transition-colors">
                        GABUNG SEKARANG
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Digital Media Section -->
    <section class="py-20 bg-gradient-to-r from-blue-50 to-purple-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="animate-slide-up">
                    <h2 class="text-4xl font-bold text-gray-800 mb-6">Satria Digital Media</h2>
                    <p class="text-xl text-gray-600 mb-8">
                        Nikmati koneksi internet cepat dan stabil untuk streaming, gaming hingga bekerja dari rumah.
                        Satria Digital Media hadir dengan layanan WiFi terbaik dan pengalaman online tanpa hambatan.
                    </p>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">
                        HUBUNGI KAMI
                    </button>
                </div>
                <div class="relative animate-float">
                    <div class="bg-gradient-to-br from-yellow-400 to-orange-500 rounded-3xl p-8">
                        <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMwMCIgdmlld0JveD0iMCAwIDQwMCAzMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSI0MDAiIGhlaWdodD0iMzAwIiBmaWxsPSJ1cmwoI3BhaW50MF9saW5lYXJfMF8xKSIvPgo8Y2lyY2xlIGN4PSIyMDAiIGN5PSIxNTAiIHI9IjgwIiBmaWxsPSIjRkZGRkZGIiBvcGFjaXR5PSIwLjMiLz4KPHJlY3QgeD0iMTYwIiB5PSIxMTAiIHdpZHRoPSI4MCIgaGVpZ2h0PSI4MCIgcng9IjEwIiBmaWxsPSIjRkZGRkZGIiBvcGFjaXR5PSIwLjUiLz4KPHN2ZyB4PSIxODAiIHk9IjEzMCIgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiBmaWxsPSIjMzMzIiBvcGFjaXR5PSIwLjciPgo8cGF0aCBkPSJNMjAgMTBWMzBIMzBWMTBIMjBaTTI1IDEyLjVMMjIuNSAxNVYyNUgyNy41VjE1TDI1IDEyLjVaIi8+Cjwvc3ZnPgo8ZGVmcz4KPGxpbmVhckdyYWRpZW50IGlkPSJwYWludDBfbGluZWFyXzBfMSIgeDE9IjAiIHkxPSIwIiB4Mj0iNDAwIiB5Mj0iMzAwIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+CjxzdG9wIHN0b3AtY29sb3I9IiNGNTlFMEIiLz4KPHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjRUY0NDQ0Ii8+CjwvbGluZWFyR3JhZGllbnQ+CjwvZGVmcz4KPC9zdmc+Cg==" alt="Digital Media" class="w-full h-auto rounded-2xl">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Packages Section -->
    <section id="packages" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Paket layanan Internet Satrianet</h2>
                <p class="text-xl text-gray-600">Nikmati koneksi internet cepat dan stabil untuk digital Anda dan keluarga gaming, hingga kerja dari rumah!</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <!-- Standard Package -->
                <div class="bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-3xl p-8 text-center card-hover transform hover:scale-105 transition-all duration-300">
                    <h3 class="text-2xl font-bold text-white mb-2">Standard Home</h3>
                    <p class="text-white opacity-90 mb-6">Paket ideal untuk kebutuhan internet rumah tangga</p>

                    <div class="bg-white bg-opacity-20 rounded-2xl p-6 mb-6">
                        <div class="text-3xl font-bold text-white mb-2">Mulai dari Rp. 165.000</div>
                        <div class="text-white opacity-90 text-sm">per bulan</div>
                    </div>

                    <ul class="text-white text-left space-y-2 mb-8">
                        <li class="flex items-center"><i class="fas fa-check mr-2"></i>Speed up to 20 Mbps</li>
                        <li class="flex items-center"><i class="fas fa-check mr-2"></i>Tanpa batasan quota (Unlimited)</li>
                        <li class="flex items-center"><i class="fas fa-check mr-2"></i>Upload & download 1:1</li>
                        <li class="flex items-center"><i class="fas fa-check mr-2"></i>Free instalasi</li>
                    </ul>

                    <button class="bg-white text-yellow-600 w-full py-3 rounded-full font-bold hover:bg-gray-100 transition-colors">
                        DETAIL
                    </button>
                </div>

                <!-- Premium Package -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-3xl p-8 text-center card-hover transform hover:scale-105 transition-all duration-300">
                    <h3 class="text-2xl font-bold text-white mb-2">Satrianet Pro</h3>
                    <p class="text-white opacity-90 mb-6">Paket premium untuk gaming dan streaming</p>

                    <div class="bg-white bg-opacity-20 rounded-2xl p-6 mb-6">
                        <div class="text-3xl font-bold text-white mb-2">Mulai dari Rp. 4.500.000</div>
                        <div class="text-white opacity-90 text-sm">per tahun</div>
                    </div>

                    <ul class="text-white text-left space-y-2 mb-8">
                        <li class="flex items-center"><i class="fas fa-check mr-2"></i>Speed up to 100 Mbps</li>
                        <li class="flex items-center"><i class="fas fa-check mr-2"></i>Internet dedicated</li>
                        <li class="flex items-center"><i class="fas fa-check mr-2"></i>IP Static</li>
                        <li class="flex items-center"><i class="fas fa-check mr-2"></i>Harga per year</li>
                    </ul>

                    <button class="bg-white text-blue-600 w-full py-3 rounded-full font-bold hover:bg-gray-100 transition-colors">
                        DETAIL
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Coverage Area -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Coverage Area</h2>
                <p class="text-xl text-gray-600">
                    Coverage Area PT Satria Digital Media melayani berbagai wilayah strategis dengan teknologi
                    Fiber Optik dan jaringan yang stabil.
                </p>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-xl">
                <div class="aspect-video bg-gradient-to-br from-blue-100 to-purple-100 rounded-2xl flex items-center justify-center">
                    <div class="text-center">
                        <i class="fas fa-map-marked-alt text-6xl text-blue-600 mb-4"></i>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Peta Coverage Area</h3>
                        <p class="text-gray-600">Wilayah jangkauan layanan SatriaNet</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-white">
                    <h2 class="text-4xl font-bold mb-6">Usaha internet lebih mudah dengan monitoring terkontrol</h2>
                    <p class="text-xl opacity-90 mb-8">
                        SatriaNet menyediakan solusi terlengkapi untuk bisnis yang mengandalkan internet dalam operasional
                        sehari-hari dengan dukungan teknis 24/7 dan jaringan yang handal.
                    </p>
                    <button class="bg-yellow-400 hover:bg-yellow-500 text-black px-8 py-4 rounded-full font-bold text-lg transition-all duration-300 transform hover:scale-105">
                        Hubungi Kami
                    </button>
                </div>
                <div class="text-white">
                    <h2 class="text-4xl font-bold mb-6">Mau gunya usaha internet? Buka franchise Aja</h2>
                    <p class="text-xl opacity-90 mb-8">
                        Bergabunglah dengan mitra franchise SatriaNet dan dapatkan kesempatan berbisnis dengan
                        dukungan penuh sistem manajemen dan teknologi terdepan.
                    </p>
                    <button class="bg-yellow-400 hover:bg-yellow-500 text-black px-8 py-4 rounded-full font-bold text-lg transition-all duration-300 transform hover:scale-105">
                        Hubungi Kami
                    </button>
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
                        <p><i class="fas fa-map-marker-alt mr-2"></i>Jl. Akademika, Tembalang, Kota Semarang</p>
                        <p><i class="fas fa-phone mr-2"></i>Tlp. Rudi +6285-xxxx-xxxx Semarang, Central Java</p>
                        <p><i class="fas fa-envelope mr-2"></i>info@satrianet.co.id</p>
                        <p><i class="fas fa-globe mr-2"></i>www.satrianet.co.id</p>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Perusahaan</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Karir</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Press Release</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Produk & Layanan</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white transition-colors">Internet Residensial</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Internet Bisnis</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Dedicated Internet</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">IPTV & TV Cable</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">VoIP & Telepon</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">COLOCATION</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Hubungi Kami</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white transition-colors">Customer Service</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Technical Support</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Sales Information</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Partnership</a></li>
                    </ul>

                    <div class="mt-6">
                        <h5 class="font-semibold mb-3">Follow Us</h5>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-pink-600 rounded-full flex items-center justify-center hover:bg-pink-700 transition-colors">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center hover:bg-green-700 transition-colors">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; 2024 PT Satria Digital Media. All rights reserved. | Privacy Policy | Terms of Service</p>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="https://wa.me/6285xxxxxxxx" target="_blank" class="bg-green-500 hover:bg-green-600 text-white w-16 h-16 rounded-full flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 animate-bounce-gentle">
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
</body>

</html>