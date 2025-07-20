<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Form Registrasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>

<body>
    <h1>Form Registrasi</h1>

    @if(session('success'))
    <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if($errors->any())
    <div style="color: red;">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('registrations.store') }}">
        @csrf

        <label>Nama:</label><br>
        <input type="text" name="name" value="{{ old('name') }}" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}"><br><br>

        <label>Nomor HP:</label><br>
        <input type="text" name="phone" value="{{ old('phone') }}"><br><br>

        <label>ID Product:</label><br>
        <input type="text" name="id_product" value="{{ old('id_product') }}" required><br><br>

        <label>Referral:</label><br>
        <input type="text" name="referral" value="{{ old('referral') }}"><br><br>

        <label>Status:</label><br>
        <input type="text" name="status" value="{{ old('status') }}"><br><br>

        <label>Koordinat:</label><br>
        <input type="text" name="koordinat" value="{{ old('koordinat') }}"><br><br>

        <label>Alamat Spesifik:</label><br>
        <textarea name="alamat_spesifik">{{ old('alamat_spesifik') }}</textarea><br><br>

        {{-- Provinsi --}}
        <label>Provinsi:</label><br>
        <select id="province" name="province_id" required>
            <option value="">Pilih Provinsi</option>
            @php
            $excluded = ['Maluku Utara', 'Papua', 'Papua Barat']; // sesuaikan nama-namanya
            @endphp
            @foreach(\Laravolt\Indonesia\Models\Province::whereNotIn('name', $excluded)->get() as $province)
            <option value="{{ $province->code }}" {{ old('province_id') == $province->code ? 'selected' : '' }}>
                {{ $province->name }}
            </option>
            @endforeach
        </select><br><br>


        {{-- Kabupaten/Kota --}}
        <label>Kabupaten/Kota:</label><br>
        <select id="city" name="city_id" required>
            <option value="">Pilih Kabupaten/Kota</option>
            @if(old('province_id'))
            @foreach(\Laravolt\Indonesia\Models\City::where('province_code', old('province_id'))->get() as $city)
            <option value="{{ $city->code }}" {{ old('city_id') == $city->code ? 'selected' : '' }}>
                {{ $city->name }}
            </option>
            @endforeach
            @endif
        </select><br><br>

        {{-- Kecamatan --}}
        <label>Kecamatan:</label><br>
        <select id="district" name="district_id" required>
            <option value="">Pilih Kecamatan</option>
            @if(old('city_id'))
            @foreach(\Laravolt\Indonesia\Models\District::where('city_code', old('city_id'))->get() as $district)
            <option value="{{ $district->code }}" {{ old('district_id') == $district->code ? 'selected' : '' }}>
                {{ $district->name }}
            </option>
            @endforeach
            @endif
        </select><br><br>

        {{-- Kelurahan/Desa --}}
        <label>Kelurahan/Desa:</label><br>
        <select id="village" name="village_id" required>
            <option value="">Pilih Kelurahan/Desa</option>
            @if(old('district_id'))
            @foreach(\Laravolt\Indonesia\Models\Village::where('district_code', old('district_id'))->get() as $village)
            <option value="{{ $village->code }}" {{ old('village_id') == $village->code ? 'selected' : '' }}>
                {{ $village->name }}
            </option>
            @endforeach
            @endif
        </select><br><br>

        <button type="submit">Daftar</button>
    </form>

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