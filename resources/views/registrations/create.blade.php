<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Form Registrasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Axios -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .form-container {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            transition: transform 0.2s ease-in-out;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .input-group-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
        }

        .alert-success {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            border: none;
            color: white;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
            border: none;
            color: white;
        }
    </style>
</head>

<body class="gradient-bg">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="form-container rounded-4 p-4 p-md-5">
                    <!-- Header -->
                    <div class="text-center mb-4">
                        <div class="bg-gradient-to-r from-purple-500 to-blue-500 w-16 h-16 rounded-full mx-auto mb-3 flex items-center justify-center">
                            <i class="fas fa-user-plus text-white text-2xl"></i>
                        </div>
                        <h1 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">
                            Form Registrasi
                        </h1>
                        <p class="text-gray-600 mt-2">Silakan lengkapi form di bawah ini untuk mendaftar</p>
                    </div>

                    <!-- Success Message -->
                    @if(session('success'))
                    <div class="alert alert-success rounded-3 mb-4">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    </div>
                    @endif

                    <!-- Error Messages -->
                    @if($errors->any())
                    <div class="alert alert-danger rounded-3 mb-4">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Registration Form -->
                    <form method="POST" action="{{ route('registrations.store') }}">
                        @csrf

                        <div class="row">
                            <!-- Nama -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-gray-700">
                                    <i class="fas fa-user me-2 text-purple-500"></i>Nama Lengkap *
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-gray-700">
                                    <i class="fas fa-envelope me-2 text-purple-500"></i>Email
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email') }}" placeholder="contoh@email.com">
                                </div>
                            </div>

                            <!-- Nomor HP -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-gray-700">
                                    <i class="fas fa-phone me-2 text-purple-500"></i>Nomor HP
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                    <input type="text" name="phone" class="form-control"
                                        value="{{ old('phone') }}" placeholder="08xxxxxxxxxx">
                                </div>
                            </div>

                            <!-- ID Product -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-gray-700">
                                    <i class="fas fa-box me-2 text-purple-500"></i>ID Product *
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-box"></i>
                                    </span>
                                    <input type="text" name="id_product" class="form-control"
                                        value="{{ old('id_product') }}" placeholder="Masukkan ID Product" required>
                                </div>
                            </div>

                            <!-- Referral -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-gray-700">
                                    <i class="fas fa-users me-2 text-purple-500"></i>Referral
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-users"></i>
                                    </span>
                                    <input type="text" name="referral" class="form-control"
                                        value="{{ old('referral') }}" placeholder="Kode referral (opsional)">
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-gray-700">
                                    <i class="fas fa-info-circle me-2 text-purple-500"></i>Status
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-info-circle"></i>
                                    </span>
                                    <input type="text" name="status" class="form-control"
                                        value="{{ old('status') }}" placeholder="Status">
                                </div>
                            </div>

                            <!-- Koordinat -->
                            <div class="col-12 mb-3">
                                <label class="form-label fw-semibold text-gray-700">
                                    <i class="fas fa-map-marker-alt me-2 text-purple-500"></i>Koordinat
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <input type="text" name="koordinat" class="form-control"
                                        value="{{ old('koordinat') }}" placeholder="Contoh: -6.200000, 106.816666">
                                </div>
                            </div>

                            <!-- Alamat Spesifik -->
                            <div class="col-12 mb-4">
                                <label class="form-label fw-semibold text-gray-700">
                                    <i class="fas fa-home me-2 text-purple-500"></i>Alamat Spesifik
                                </label>
                                <textarea name="alamat_spesifik" class="form-control" rows="3"
                                    placeholder="Jalan, nomor rumah, RT/RW, patokan, dll.">{{ old('alamat_spesifik') }}</textarea>
                            </div>
                        </div>

                        <!-- Location Section -->
                        <div class="bg-light rounded-3 p-4 mb-4">
                            <h5 class="text-center mb-4">
                                <i class="fas fa-map-pin me-2 text-purple-500"></i>
                                Informasi Lokasi
                            </h5>

                            <div class="row">
                                <!-- Provinsi -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Provinsi *</label>
                                    @php
                                    $allowedProvinces = [
                                    ['code' => '33', 'name' => 'JAWA TENGAH'],
                                    ['code' => '72', 'name' => 'SULAWESI TENGAH'],
                                    ];
                                    @endphp

                                    <select id="province" name="province_id" class="form-select" required>
                                        <option value="">Pilih Provinsi</option>
                                        @foreach($allowedProvinces as $province)
                                        <option value="{{ $province['code'] }}" {{ old('province_id') == $province['code'] ? 'selected' : '' }}>
                                            {{ $province['name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Kabupaten/Kota -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Kabupaten/Kota *</label>
                                    <select id="city" name="city_id" class="form-select" required>
                                        <option value="">Pilih Kabupaten/Kota</option>
                                        @if(old('province_id'))
                                        @foreach(\Laravolt\Indonesia\Models\City::where('province_code', old('province_id'))->get() as $city)
                                        <option value="{{ $city->code }}" {{ old('city_id') == $city->code ? 'selected' : '' }}>
                                            {{ $city->name }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>

                                <!-- Kecamatan -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Kecamatan *</label>
                                    <select id="district" name="district_id" class="form-select" required>
                                        <option value="">Pilih Kecamatan</option>
                                        @if(old('city_id'))
                                        @foreach(\Laravolt\Indonesia\Models\District::where('city_code', old('city_id'))->get() as $district)
                                        <option value="{{ $district->code }}" {{ old('district_id') == $district->code ? 'selected' : '' }}>
                                            {{ $district->name }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>

                                <!-- Kelurahan/Desa -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Kelurahan/Desa *</label>
                                    <select id="village" name="village_id" class="form-select" required>
                                        <option value="">Pilih Kelurahan/Desa</option>
                                        @if(old('district_id'))
                                        @foreach(\Laravolt\Indonesia\Models\Village::where('district_code', old('district_id'))->get() as $village)
                                        <option value="{{ $village->code }}" {{ old('village_id') == $village->code ? 'selected' : '' }}>
                                            {{ $village->name }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary-custom btn-lg py-3 rounded-3">
                                <i class="fas fa-paper-plane me-2"></i>
                                Daftar Sekarang
                            </button>
                        </div>

                        <!-- Note -->
                        <div class="text-center mt-3">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Field yang bertanda * wajib diisi
                            </small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript untuk dropdown cascade (tidak diubah) -->
    <script>
        const province = document.getElementById('province');
        const city = document.getElementById('city');
        const district = document.getElementById('district');
        const village = document.getElementById('village');

        province.addEventListener('change', async function() {
            const res = await axios.get(`/api/indonesia/cities?province_id=${this.value}`);
            city.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
            res.data.forEach(function(item) {
                city.innerHTML += `<option value="${item.code}">${item.name}</option>`;
            });
            district.innerHTML = '<option value="">Pilih Kecamatan</option>';
            village.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
        });

        city.addEventListener('change', async function() {
            const res = await axios.get(`/api/indonesia/districts?city_id=${this.value}`);
            district.innerHTML = '<option value="">Pilih Kecamatan</option>';
            res.data.forEach(function(item) {
                district.innerHTML += `<option value="${item.code}">${item.name}</option>`;
            });
            village.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
        });

        district.addEventListener('change', async function() {
            const res = await axios.get(`/api/indonesia/villages?district_id=${this.value}`);
            village.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
            res.data.forEach(function(item) {
                village.innerHTML += `<option value="${item.code}">${item.name}</option>`;
            });
        });
    </script>
</body>

</html>