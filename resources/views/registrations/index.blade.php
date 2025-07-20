<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Registrasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Data Registrasi</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Product</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Provinsi</th>
                <th>Kab/Kota</th>
                <th>Kecamatan</th>
                <th>Kelurahan</th>
                <th>Status</th>
                <th>Referral</th>
                <th>Koordinat</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registrations as $reg)
                <tr>
                    <td>{{ $reg->id }}</td>
                    <td>{{ $reg->id_product }}</td>
                    <td>{{ $reg->name }}</td>
                    <td>{{ $reg->email }}</td>
                    <td>{{ $reg->phone }}</td>
                    <td>{{ $reg->alamat_spesifik }}</td>
                    <td>{{ optional($reg->province)->name }}</td>
                    <td>{{ optional($reg->city)->name }}</td>
                    <td>{{ optional($reg->district)->name }}</td>
                    <td>{{ optional($reg->village)->name }}</td>
                    <td>{{ $reg->status }}</td>
                    <td>{{ $reg->referral }}</td>
                    <td>{{ $reg->koordinat }}</td>
                    <td>{{ $reg->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $registrations->links() }}
</body>
</html>
