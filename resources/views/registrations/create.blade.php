<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <title>Form Registrasi - SatriaNet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Axios -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

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
                box-shadow: 0 0 20px rgba(30, 64, 175, 0.3);
            }

            50% {
                box-shadow: 0 0 40px rgba(30, 64, 175, 0.6);
            }
        }

        .gradient-bg {
            background: linear-gradient(135deg, #1e40af 0%, #7c3aed 50%, #f59e0b 100%);
            min-height: 100vh;
            position: relative;
        }

        .gradient-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.05"><circle cx="30" cy="30" r="2"/></g></svg>');
        }

        .form-container {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #1e40af, #7c3aed, #f59e0b);
        }

        .form-control,
        .form-select {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px 16px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #1e40af;
            box-shadow: 0 0 0 4px rgba(30, 64, 175, 0.1);
            transform: translateY(-2px);
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #1e40af 0%, #7c3aed 100%);
            border: none;
            padding: 16px 32px;
            font-weight: 700;
            font-size: 16px;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .btn-primary-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(30, 64, 175, 0.4);
            animation: pulse-glow 2s ease-in-out infinite;
        }

        .btn-primary-custom:hover::before {
            left: 100%;
        }

        .input-group-text {
            background: linear-gradient(135deg, #1e40af 0%, #7c3aed 100%);
            color: white;
            border: none;
            border-radius: 12px 0 0 12px;
        }

        .alert-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
            color: white;
            border-radius: 16px;
            padding: 16px 20px;
            border-left: 4px solid #065f46;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border: none;
            color: white;
            border-radius: 16px;
            padding: 16px 20px;
            border-left: 4px solid #991b1b;
        }

        .location-section {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            border-radius: 20px;
            padding: 24px;
            border: 2px solid #d1d5db;
            position: relative;
        }

        .location-section::before {
            content: '📍';
            position: absolute;
            top: -10px;
            left: 20px;
            background: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 18px;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #1D4ED8 0%, #6366F1 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            animation: float 6s ease-in-out infinite;
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #1e40af, #7c3aed);
            border-radius: 4px;
        }

        .navbar-custom {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
    </style>

    <style>
        .form-control:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.25);
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .text-blue-500 {
            color: #3b82f6;
        }

        .text-blue-600 {
            color: #2563eb;
        }

        .text-red-600 {
            color: #dc2626;
        }

        .modal-content {
            border: none;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .list-group-item {
            padding: 0.5rem 0;
        }
    </style>
</head>

<body class="bg-blue-700 font-sans">
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

    <!-- Main Content -->
    <div class="container py-28">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <!-- Header Section -->
                <div class="text-center mb-12 animate-slide-up">
                    <div class="feature-icon mb-6">
                        <i class="fas fa-user-plus text-white text-2xl"></i>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold text-white bg-clip-text text-transparent mb-4">
                        Form Registrasi
                    </h1>
                    <p class="text-lg text-gray-300 max-w-2xl mx-auto">
                        Bergabunglah dengan ribuan pelanggan yang telah merasakan internet super cepat dan stabil dari SatriaNet
                    </p>
                </div>

                <!-- Form Container -->
                <div class="form-container rounded-4xl p-4 p-md-5 animate-fade-in">

                    @if(session('success'))
                    <div class="alert alert-success rounded-3 mb-4 animate-slide-up">
                        <i class="fas fa-check-circle me-3"></i>
                        <strong>Berhasil!</strong> {{ session('success') }}
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger rounded-3 mb-4 animate-slide-up">
                        <i class="fas fa-exclamation-triangle me-3"></i>
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0 mt-2 ps-4">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Features Preview -->
                    <div class="row mb-5">
                        <div class="col-md-4 mb-3">
                            <div class="bg-white rounded-2xl p-4 text-center card-hover h-100 border">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-rocket text-blue-600"></i>
                                </div>
                                <h6 class="font-bold mb-2">Internet Super Cepat</h6>
                                <small class="text-gray-600">Hingga 100 Mbps</small>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="bg-white rounded-2xl p-4 text-center card-hover h-100 border">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-headset text-green-600"></i>
                                </div>
                                <h6 class="font-bold mb-2">Support 24/7</h6>
                                <small class="text-gray-600">Siap membantu Anda</small>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="bg-white rounded-2xl p-4 text-center card-hover h-100 border">
                                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-network-wired text-purple-600"></i>
                                </div>
                                <h6 class="font-bold mb-2">100% Fiber Optik</h6>
                                <small class="text-gray-600">Teknologi terdepan</small>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('registrations.store') }}">
                        @csrf

                        <!-- Personal Information Section -->
                        <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-3xl p-4 mb-5">
                            <h5 class="text-center mb-4 font-bold text-gray-800">
                                <i class="fas fa-user-circle me-2 text-blue-600"></i>
                                Informasi Pribadi
                            </h5>

                            <div class="row">
                                <!-- Nama -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-user me-2 text-blue-600"></i>
                                        Nama Lengkap *
                                    </label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name') }}" required
                                        placeholder="Masukkan nama lengkap Anda">
                                </div>

                                <!-- Email -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-envelope me-2 text-blue-600"></i>
                                        Email
                                    </label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email') }}"
                                        placeholder="nama@email.com">
                                </div>

                                <!-- Nomor HP -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-phone me-2 text-blue-600"></i>
                                        Nomor HP
                                    </label>
                                    <input type="text" name="phone" class="form-control"
                                        value="{{ old('phone') }}"
                                        placeholder="08xxxxxxxxxx">
                                </div>

                                <!-- Referral -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-users me-2 text-blue-600"></i>
                                        Referral
                                    </label>
                                    <input type="text" name="referral" class="form-control"
                                        value="{{ old('referral') }}"
                                        placeholder="Kode referral (opsional)">
                                </div>
                            </div>
                        </div>

                        <!-- Package Selection -->
                        <div class="bg-gradient-to-r from-purple-50 to-yellow-50 rounded-3xl p-4 mb-5">
                            <h5 class="text-center mb-4 font-bold text-gray-800">
                                <i class="fas fa-box me-2 text-purple-600"></i>
                                Pilih Paket
                            </h5>

                            <div class="col-12 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-wifi me-2 text-purple-600"></i>
                                    Produk *
                                </label>
                                <select name="product_id" class="form-select" required>
                                    <option value="">🎯 Pilih Paket Internet Terbaik</option>
                                    @foreach(\App\Models\Product::pluck('name', 'id') as $id => $name)
                                    <option value="{{ $id }}" {{ old('product_id', $selectedProductId) == $id ? 'selected' : '' }}>
                                        🚀 {{ $name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Location Information -->
                        <div class="location-section mb-5">
                            <h5 class="text-center mb-4 font-bold text-gray-800">
                                <i class="fas fa-map-marker-alt me-2 text-red-600"></i>
                                Informasi Lokasi
                            </h5>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-map me-2 text-red-600"></i>
                                        Provinsi *
                                    </label>
                                    <select id="province" name="province_code" class="form-select" required>
                                        <option value="">Pilih Provinsi</option>
                                        @foreach(\Laravolt\Indonesia\Models\Province::all() as $province)
                                        <option value="{{ $province->code }}" {{ old('province_code') == $province->code ? 'selected' : '' }}>
                                            {{ $province->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-city me-2 text-red-600"></i>
                                        Kabupaten/Kota *
                                    </label>
                                    <select id="city" name="city_code" class="form-select" required>
                                        <option value="">Pilih Kota</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-building me-2 text-red-600"></i>
                                        Kecamatan *
                                    </label>
                                    <select id="district" name="district_code" class="form-select" required>
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-home me-2 text-red-600"></i>
                                        Kelurahan/Desa *
                                    </label>
                                    <select id="village" name="village_code" class="form-select" required>
                                        <option value="">Pilih Kelurahan</option>
                                    </select>
                                </div>

                                <!-- Koordinat -->
                                <div class="col-12 mb-4">
                                    <label class="form-label fw-semibold">
                                        <i class="fas fa-crosshairs me-2 text-red-600"></i>
                                        Koordinat GPS
                                    </label>

                                    <div class="input-group">
                                        <input type="text" name="koordinat" class="form-control"
                                            value="{{ old('koordinat') }}"
                                            placeholder="Contoh: -7.4186, 109.2374">
                                        <button type="button" class="btn btn-outline-primary" onclick="getLocation()" title="Gunakan Lokasi Saya">
                                            <i class="fas fa-location-arrow"></i>
                                        </button>
                                    </div>

                                    <div class="mt-2">
                                        <small class="text-muted d-block">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Koordinat membantu teknisi menemukan lokasi dengan lebih akurat
                                        </small>
                                        <small class="d-block mt-1">
                                            <i class="fas fa-question-circle me-1 text-blue-500"></i>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#koordinatModal"
                                                class="text-decoration-none text-blue-600 fw-medium">
                                                Cara mendapatkan koordinat?
                                            </a>
                                        </small>
                                    </div>
                                </div>

                                <!-- Alamat Spesifik -->
                                <div class="col-12 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-map-signs me-2 text-red-600"></i>
                                        Alamat Spesifik
                                    </label>
                                    <textarea name="alamat_spesifik" class="form-control" rows="3"
                                        placeholder="Contoh: Jalan Sudirman No. 123, RT 01/RW 05, dekat Warung Mak Asih">{{ old('alamat_spesifik') }}</textarea>
                                    <small class="text-muted">
                                        <i class="fas fa-lightbulb me-1"></i>
                                        Semakin detail alamat, semakin mudah pemasangan
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary-custom btn-lg px-5 py-3 text-white">
                                <i class="fas fa-paper-plane me-2"></i>
                                Daftar Sekarang
                            </button>
                            <p class="text-sm text-gray-500 mt-3">
                                <i class="fas fa-shield-alt me-1"></i>
                                Data Anda aman dan akan diproses sesuai kebijakan privasi kami
                            </p>
                        </div>
                    </form>
                </div>

                <!-- Benefits Section -->
                <div class="row mt-5">
                    <div class="col-md-6 mb-3">
                        <div class="bg-white rounded-2xl p-4 text-center card-hover border">
                            <i class="fas fa-clock text-3xl text-blue-600 mb-3"></i>
                            <h6 class="font-bold mb-2">Pemasangan Cepat</h6>
                            <small class="text-gray-600">Tim teknisi akan menghubungi Anda dalam 1x24 jam</small>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="bg-white rounded-2xl p-4 text-center card-hover border">
                            <i class="fas fa-money-bill-wave text-3xl text-green-600 mb-3"></i>
                            <h6 class="font-bold mb-2">Harga Terjangkau</h6>
                            <small class="text-gray-600">Paket internet berkualitas dengan harga bersahabat</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tutorial Koordinat -->
    <div class="modal fade" id="koordinatModal" tabindex="-1" aria-labelledby="koordinatModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="koordinatModalLabel">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        Cara Mendapatkan Koordinat GPS
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info d-flex align-items-center mb-4">
                        <i class="fas fa-location-arrow fa-lg me-3"></i>
                        <div>
                            <strong>Gunakan Lokasi Otomatis:</strong><br>
                            Klik tombol <i class="fas fa-location-arrow text-primary"></i> di samping kolom koordinat,
                            dan izinkan browser mengakses lokasi Anda. Koordinat akan terisi otomatis.
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="fw-bold text-success">
                                <i class="fas fa-mobile-alt me-2"></i>Dari Smartphone
                            </h6>
                            <ol class="list-group list-group-numbered list-group-flush">
                                <li class="list-group-item border-0 ps-0">Buka aplikasi <strong>Google Maps</strong></li>
                                <li class="list-group-item border-0 ps-0">Tekan dan tahan lokasi yang diinginkan</li>
                                <li class="list-group-item border-0 ps-0">Koordinat akan muncul di bagian bawah</li>
                                <li class="list-group-item border-0 ps-0">Tap koordinat untuk menyalin</li>
                            </ol>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold text-info">
                                <i class="fas fa-desktop me-2"></i>Dari Komputer
                            </h6>
                            <ol class="list-group list-group-numbered list-group-flush">
                                <li class="list-group-item border-0 ps-0">Buka <strong>maps.google.com</strong></li>
                                <li class="list-group-item border-0 ps-0">Klik kanan pada lokasi</li>
                                <li class="list-group-item border-0 ps-0">Pilih koordinat yang muncul</li>
                                <li class="list-group-item border-0 ps-0">Koordinat akan tersalin otomatis</li>
                            </ol>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Tips:</strong> Format koordinat yang benar adalah: <code>-7.4186, 109.2374</code>
                    </div>

                    <div class="mt-4">
                        <ul class="nav nav-tabs justify-content-center" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#mobile-tutorial">
                                    <i class="fas fa-mobile-alt me-2"></i>Mobile
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#desktop-tutorial">
                                    <i class="fas fa-desktop me-2"></i>Desktop
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content mt-3">
                            <div class="tab-pane fade show active text-center" id="mobile-tutorial">
                                <img src="path/to/mobile-tutorial.gif"
                                    class="img-fluid rounded shadow-sm"
                                    alt="Tutorial Mobile"
                                    style="max-height: 300px;">
                                <p class="text-muted mt-2 small">Cara mendapatkan koordinat di smartphone</p>
                            </div>

                            <div class="tab-pane fade text-center" id="desktop-tutorial">
                                <img src="path/to/desktop-tutorial.gif"
                                    class="img-fluid rounded shadow-sm"
                                    alt="Tutorial Desktop"
                                    style="max-height: 300px;">
                                <p class="text-muted mt-2 small">Cara mendapatkan koordinat di komputer</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

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

    {{-- AJAX untuk Load Kota/Kecamatan/Desa --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const province = document.getElementById("province");
            const city = document.getElementById("city");
            const district = document.getElementById("district");
            const village = document.getElementById("village");

            // Add loading animation to selects
            function showLoading(element, text = "Loading...") {
                element.innerHTML = `<option value="">${text}</option>`;
                element.disabled = true;
            }

            function hideLoading(element, defaultText) {
                element.innerHTML = `<option value="">${defaultText}</option>`;
                element.disabled = false;
            }

            province.addEventListener("change", async function() {
                showLoading(city, "🔄 Memuat kota...");
                district.innerHTML = '<option value="">Pilih Kecamatan</option>';
                village.innerHTML = '<option value="">Pilih Kelurahan</option>';

                try {
                    const res = await fetch(`/api/cities/${this.value}`);
                    const data = await res.json();
                    hideLoading(city, "Pilih Kota");
                    data.forEach(c => city.innerHTML += `<option value="${c.code}">🏙️ ${c.name}</option>`);
                } catch (error) {
                    hideLoading(city, "Error - Coba lagi");
                }
            });

            city.addEventListener("change", async function() {
                showLoading(district, "🔄 Memuat kecamatan...");
                village.innerHTML = '<option value="">Pilih Kelurahan</option>';

                try {
                    const res = await fetch(`/api/districts/${this.value}`);
                    const data = await res.json();
                    hideLoading(district, "Pilih Kecamatan");
                    data.forEach(d => district.innerHTML += `<option value="${d.code}">🏘️ ${d.name}</option>`);
                } catch (error) {
                    hideLoading(district, "Error - Coba lagi");
                }
            });

            district.addEventListener("change", async function() {
                showLoading(village, "🔄 Memuat kelurahan...");

                try {
                    const res = await fetch(`/api/villages/${this.value}`);
                    const data = await res.json();
                    hideLoading(village, "Pilih Kelurahan");
                    data.forEach(v => village.innerHTML += `<option value="${v.code}">🏠 ${v.name}</option>`);
                } catch (error) {
                    hideLoading(village, "Error - Coba lagi");
                }
            });

            // Add form validation animations
            const inputs = document.querySelectorAll('.form-control, .form-select');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });

                input.addEventListener('blur', function() {
                    if (!this.value) {
                        this.parentElement.classList.remove('focused');
                    }
                });
            });

            // Add submit button loading state
            const form = document.querySelector('form');
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;

            form.addEventListener('submit', function() {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
                submitBtn.disabled = true;
            });
        });

        // Add scroll animations
        const observeElements = document.querySelectorAll('.animate-slide-up, .animate-fade-in');
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
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.6s ease-out';
            observer.observe(el);
        });
    </script>

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

    <script>
        function getLocation() {
            const btn = event.target.closest('button');
            const originalContent = btn.innerHTML;

            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            btn.disabled = true;

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const lat = position.coords.latitude.toFixed(6);
                        const lon = position.coords.longitude.toFixed(6);
                        document.querySelector('input[name="koordinat"]').value = `${lat}, ${lon}`;

                        // Reset button
                        btn.innerHTML = '<i class="fas fa-check text-success"></i>';
                        setTimeout(() => {
                            btn.innerHTML = originalContent;
                            btn.disabled = false;
                        }, 2000);
                    },
                    function(error) {
                        let message = 'Gagal mendapatkan lokasi.';
                        switch (error.code) {
                            case error.PERMISSION_DENIED:
                                message = "Izin lokasi ditolak.";
                                break;
                            case error.POSITION_UNAVAILABLE:
                                message = "Informasi lokasi tidak tersedia.";
                                break;
                            case error.TIMEOUT:
                                message = "Permintaan lokasi melebihi batas waktu.";
                                break;
                        }
                        alert(message + " Mohon aktifkan izin lokasi di browser Anda.");

                        // Reset button
                        btn.innerHTML = originalContent;
                        btn.disabled = false;
                    }
                );
            } else {
                alert("Browser Anda tidak mendukung fitur lokasi.");
                btn.innerHTML = originalContent;
                btn.disabled = false;
            }
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</body>

</html>