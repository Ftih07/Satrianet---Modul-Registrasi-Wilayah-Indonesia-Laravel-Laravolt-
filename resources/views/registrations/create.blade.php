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
                    <div class="text-center mb-4">
                        <h1 class="text-3xl font-bold">Form Registrasi</h1>
                        <p class="text-gray-600 mt-2">Silakan lengkapi form di bawah ini untuk mendaftar</p>
                    </div>

                    @if(session('success'))
                    <div class="alert alert-success rounded-3 mb-4">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger rounded-3 mb-4">
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('registrations.store') }}">
                        @csrf

                        <div class="row">
                            <!-- Nama -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap *</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name') }}" required>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email') }}">
                            </div>

                            <!-- Nomor HP -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor HP</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone') }}">
                            </div>

                            <!-- Produk -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Produk *</label>
                                <select name="product_id" class="form-select" required>
                                    <option value="">Pilih Produk</option>
                                    @foreach(\App\Models\Product::pluck('name', 'id') as $id => $name)
                                    <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Referral -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Referral</label>
                                <input type="text" name="referral" class="form-control"
                                    value="{{ old('referral') }}">
                            </div>

                            <!-- Koordinat -->
                            <div class="col-12 mb-3">
                                <label class="form-label">Koordinat</label>
                                <input type="text" name="koordinat" class="form-control"
                                    value="{{ old('koordinat') }}">
                            </div>

                            <!-- Alamat Spesifik -->
                            <div class="col-12 mb-3">
                                <label class="form-label">Alamat Spesifik</label>
                                <textarea name="alamat_spesifik" class="form-control" rows="3">{{ old('alamat_spesifik') }}</textarea>
                            </div>
                        </div>

                        <!-- Lokasi -->
                        <div class="bg-light rounded-3 p-4 mb-4">
                            <h5 class="text-center mb-3">Informasi Lokasi</h5>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Provinsi *</label>
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
                                    <label class="form-label">Kabupaten/Kota *</label>
                                    <select id="city" name="city_code" class="form-select" required>
                                        <option value="">Pilih Kota</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kecamatan *</label>
                                    <select id="district" name="district_code" class="form-select" required>
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kelurahan/Desa *</label>
                                    <select id="village" name="village_code" class="form-select" required>
                                        <option value="">Pilih Kelurahan</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Daftar Sekarang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- AJAX untuk Load Kota/Kecamatan/Desa --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const province = document.getElementById("province");
            const city = document.getElementById("city");
            const district = document.getElementById("district");
            const village = document.getElementById("village");

            province.addEventListener("change", async function() {
                city.innerHTML = '<option value="">Loading...</option>';
                const res = await fetch(`/api/cities/${this.value}`);
                const data = await res.json();
                city.innerHTML = '<option value="">Pilih Kota</option>';
                data.forEach(c => city.innerHTML += `<option value="${c.code}">${c.name}</option>`);
            });

            city.addEventListener("change", async function() {
                district.innerHTML = '<option value="">Loading...</option>';
                const res = await fetch(`/api/districts/${this.value}`);
                const data = await res.json();
                district.innerHTML = '<option value="">Pilih Kecamatan</option>';
                data.forEach(d => district.innerHTML += `<option value="${d.code}">${d.name}</option>`);
            });

            district.addEventListener("change", async function() {
                village.innerHTML = '<option value="">Loading...</option>';
                const res = await fetch(`/api/villages/${this.value}`);
                const data = await res.json();
                village.innerHTML = '<option value="">Pilih Kelurahan</option>';
                data.forEach(v => village.innerHTML += `<option value="${v.code}">${v.name}</option>`);
            });
        });
    </script>


    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</body>

</html>