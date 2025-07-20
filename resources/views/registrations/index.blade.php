<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Registrasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .data-container {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .table-wrapper {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 600;
            border: none;
            padding: 15px 10px;
            font-size: 0.875rem;
            text-align: center;
        }

        .table td {
            padding: 12px 10px;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
            font-size: 0.875rem;
        }

        .table tbody tr:hover {
            background-color: #f8f9ff;
            transform: scale(1.002);
            transition: all 0.2s ease;
        }

        .badge-status {
            border-radius: 20px;
            padding: 5px 12px;
            font-weight: 500;
            font-size: 0.75rem;
        }

        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .pagination .page-link {
            border: none;
            border-radius: 8px;
            margin: 0 2px;
            color: #667eea;
        }

        .pagination .page-link:hover {
            background-color: #667eea;
            color: white;
        }

        .pagination .page-item.active .page-link {
            background-color: #667eea;
            border-color: #667eea;
        }

        .search-box {
            border-radius: 25px;
            border: 2px solid #e9ecef;
            padding: 10px 20px;
            transition: border-color 0.3s ease;
        }

        .search-box:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            outline: none;
        }

        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            border-radius: 8px;
            border: 1px solid #e9ecef;
            padding: 5px 10px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px !important;
            margin: 0 2px;
        }

        .btn-export {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            border: none;
            border-radius: 8px;
            color: white;
            padding: 8px 16px;
            margin: 0 2px;
            transition: transform 0.2s ease;
        }

        .btn-export:hover {
            transform: translateY(-2px);
            color: white;
        }

        @media (max-width: 768px) {
            .table-responsive {
                border-radius: 12px;
            }

            .table th,
            .table td {
                padding: 8px 6px;
                font-size: 0.75rem;
            }

            .stats-card {
                padding: 15px;
                margin-bottom: 15px;
            }
        }
    </style>
</head>

<body class="gradient-bg">
    <div class="container-fluid py-4">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="data-container rounded-4 p-4">
                    <div class="text-center mb-4">
                        <div class="bg-gradient-to-r from-purple-500 to-blue-500 w-16 h-16 rounded-full mx-auto mb-3 flex items-center justify-center">
                            <i class="fas fa-database text-white text-2xl"></i>
                        </div>
                        <h1 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent mb-2">
                            Data Registrasi
                        </h1>
                        <p class="text-gray-600">Kelola dan pantau data registrasi dengan mudah</p>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="row g-3 mb-4">
                        <div class="col-lg-3 col-md-6">
                            <div class="stats-card">
                                <div class="d-flex align-items-center">
                                    <div class="stats-icon bg-primary bg-opacity-10 text-primary me-3">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div>
                                        <h3 class="h4 mb-0 fw-bold">{{ $registrations->total() }}</h3>
                                        <p class="text-muted mb-0 small">Total Registrasi</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="stats-card">
                                <div class="d-flex align-items-center">
                                    <div class="stats-icon bg-success bg-opacity-10 text-success me-3">
                                        <i class="fas fa-calendar-day"></i>
                                    </div>
                                    <div>
                                        <h3 class="h4 mb-0 fw-bold">{{ date('d') }}</h3>
                                        <p class="text-muted mb-0 small">Hari Ini</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="stats-card">
                                <div class="d-flex align-items-center">
                                    <div class="stats-icon bg-info bg-opacity-10 text-info me-3">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <div>
                                        <h3 class="h4 mb-0 fw-bold">{{ $registrations->currentPage() }}</h3>
                                        <p class="text-muted mb-0 small">Halaman</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="stats-card">
                                <div class="d-flex align-items-center">
                                    <div class="stats-icon bg-warning bg-opacity-10 text-warning me-3">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                    <div>
                                        <h3 class="h4 mb-0 fw-bold">{{ $registrations->count() }}</h3>
                                        <p class="text-muted mb-0 small">Tampil</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="d-flex flex-wrap gap-2">
                                <button class="btn btn-export" onclick="exportData('excel')">
                                    <i class="fas fa-file-excel me-1"></i> Excel
                                </button>
                                <button class="btn btn-export" onclick="exportData('pdf')">
                                    <i class="fas fa-file-pdf me-1"></i> PDF
                                </button>
                                <button class="btn btn-export" onclick="printData()">
                                    <i class="fas fa-print me-1"></i> Print
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-md-end">
                                <a href="{{ route('registrations.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i> Tambah Data
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table Section -->
        <div class="row">
            <div class="col-12">
                <div class="data-container rounded-4 p-4">
                    <div class="table-wrapper">
                        <div class="table-responsive">
                            <table id="registrationTable" class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-hashtag me-1"></i>ID</th>
                                        <th><i class="fas fa-box me-1"></i>ID Product</th>
                                        <th><i class="fas fa-user me-1"></i>Nama</th>
                                        <th><i class="fas fa-envelope me-1"></i>Email</th>
                                        <th><i class="fas fa-phone me-1"></i>Telepon</th>
                                        <th><i class="fas fa-home me-1"></i>Alamat</th>
                                        <th><i class="fas fa-map me-1"></i>Provinsi</th>
                                        <th><i class="fas fa-building me-1"></i>Kab/Kota</th>
                                        <th><i class="fas fa-location-dot me-1"></i>Kecamatan</th>
                                        <th><i class="fas fa-map-pin me-1"></i>Kelurahan</th>
                                        <th><i class="fas fa-info-circle me-1"></i>Status</th>
                                        <th><i class="fas fa-users me-1"></i>Referral</th>
                                        <th><i class="fas fa-map-marker-alt me-1"></i>Koordinat</th>
                                        <th><i class="fas fa-calendar me-1"></i>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($registrations as $reg)
                                    <tr>
                                        <td class="text-center">
                                            <span class="badge bg-secondary">{{ $reg->id }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-info">{{ $reg->id_product }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-initial bg-primary bg-opacity-10 text-primary rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 14px;">
                                                    {{ strtoupper(substr($reg->name, 0, 1)) }}
                                                </div>
                                                <span class="fw-semibold">{{ $reg->name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @if($reg->email)
                                            <a href="mailto:{{ $reg->email }}" class="text-decoration-none">
                                                {{ $reg->email }}
                                            </a>
                                            @else
                                            <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($reg->phone)
                                            <a href="tel:{{ $reg->phone }}" class="text-decoration-none">
                                                {{ $reg->phone }}
                                            </a>
                                            @else
                                            <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($reg->alamat_spesifik)
                                            <div class="text-truncate" style="max-width: 150px;" title="{{ $reg->alamat_spesifik }}">
                                                {{ $reg->alamat_spesifik }}
                                            </div>
                                            @else
                                            <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>{{ optional($reg->province)->name ?? '-' }}</td>
                                        <td>{{ optional($reg->city)->name ?? '-' }}</td>
                                        <td>{{ optional($reg->district)->name ?? '-' }}</td>
                                        <td>{{ optional($reg->village)->name ?? '-' }}</td>
                                        <td class="text-center">
                                            @if($reg->status)
                                            @php
                                            $statusColors = [
                                            'active' => 'success',
                                            'pending' => 'warning',
                                            'inactive' => 'danger',
                                            'approved' => 'success',
                                            'rejected' => 'danger'
                                            ];
                                            $color = $statusColors[strtolower($reg->status)] ?? 'secondary';
                                            @endphp
                                            <span class="badge bg-{{ $color }} badge-status">{{ $reg->status }}</span>
                                            @else
                                            <span class="badge bg-light text-dark badge-status">N/A</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($reg->referral)
                                            <span class="badge bg-primary bg-opacity-10 text-primary">{{ $reg->referral }}</span>
                                            @else
                                            <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($reg->koordinat)
                                            <a href="https://maps.google.com/?q={{ $reg->koordinat }}" target="_blank" class="text-decoration-none" title="Buka di Google Maps">
                                                <i class="fas fa-external-link-alt me-1"></i>
                                                <small>{{ $reg->koordinat }}</small>
                                            </a>
                                            @else
                                            <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="fw-semibold">{{ $reg->created_at->format('d-m-Y') }}</span>
                                                <small class="text-muted">{{ $reg->created_at->format('H:i') }}</small>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted">
                            Menampilkan {{ $registrations->firstItem() ?? 0 }} sampai {{ $registrations->lastItem() ?? 0 }} dari {{ $registrations->total() }} data
                        </div>
                        <div>
                            {{ $registrations->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap5.min.js"></script>

    <script>
        // Initialize DataTables
        $(document).ready(function() {
            $('#registrationTable').DataTable({
                "paging": false,
                "info": false,
                "searching": true,
                "ordering": true,
                "responsive": true,
                "language": {
                    "search": "Cari:",
                    "searchPlaceholder": "Ketik untuk mencari...",
                    "emptyTable": "Tidak ada data yang tersedia",
                    "zeroRecords": "Tidak ditemukan data yang sesuai",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "columnDefs": [{
                        "width": "5%",
                        "targets": 0
                    },
                    {
                        "width": "8%",
                        "targets": 1
                    },
                    {
                        "width": "12%",
                        "targets": 2
                    },
                    {
                        "width": "15%",
                        "targets": 3
                    },
                    {
                        "width": "10%",
                        "targets": 4
                    },
                    {
                        "width": "15%",
                        "targets": 5
                    },
                    {
                        "width": "8%",
                        "targets": 10
                    },
                    {
                        "width": "10%",
                        "targets": 13
                    }
                ]
            });

            // Custom search styling
            $('.dataTables_filter input').addClass('search-box');
            $('.dataTables_filter label').contents().filter(function() {
                return this.nodeType === 3;
            }).remove();
        });

        // Export functions
        function exportData(format) {
            alert(`Export ${format.toUpperCase()} functionality would be implemented here`);
        }

        function printData() {
            window.print();
        }

        // Tooltip initialization
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    </script>

    <style media="print">
        .gradient-bg {
            background: white !important;
        }

        .data-container {
            background: white !important;
            backdrop-filter: none !important;
            box-shadow: none !important;
        }

        .stats-card,
        .btn,
        .pagination,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_length {
            display: none !important;
        }

        .table th {
            background: #f8f9fa !important;
            color: #333 !important;
        }
    </style>
</body>

</html>