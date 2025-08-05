<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/icon.png') }}" type="image/x-icon">

    <title>403 - Akses Ditolak | SatriaNet</title>
    <meta name="description" content="Akses ke halaman ini dibatasi. Hubungi administrator SatriaNet jika Anda memerlukan akses.">

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
                        'bounce-gentle': 'bounceGentle 2s ease-in-out infinite',
                        'shake': 'shake 0.5s ease-in-out infinite',
                        'lock-bounce': 'lockBounce 2s ease-in-out infinite'
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

        @keyframes bounceGentle {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        @keyframes lockBounce {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .error-number {
            background: linear-gradient(45deg, #dc2626, #b91c1c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .forbidden-bg {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        }

        .access-denied {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        }
    </style>
</head>

<body class="font-sans bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50">
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
                <div class="flex items-center">
                    <a href="/" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Error Content -->
    <div class="min-h-screen flex items-center justify-center pt-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Floating Animation Container -->
            <div class="animate-float mb-8">
                <div class="error-number text-8xl md:text-9xl font-bold mb-4">
                    403
                </div>
            </div>

            <!-- Main Content -->
            <div class="animate-fade-in">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">
                    Akses Ditolak
                </h1>

                <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                    Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.
                    Konten ini mungkin dibatasi atau memerlukan otorisasi khusus.
                </p>

                <!-- Access Denied Illustration -->
                <div class="forbidden-bg rounded-3xl p-8 shadow-xl mb-8 max-w-md mx-auto">
                    <div class="text-6xl text-red-500 mb-4 animate-shake">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="text-3xl text-red-400 animate-lock-bounce mb-4">
                        <i class="fas fa-ban"></i>
                    </div>
                    <p class="text-red-600 font-medium">Area Terbatas</p>
                </div>

                <!-- Possible Reasons -->
                <div class="access-denied rounded-2xl p-6 mb-8">
                    <div class="flex items-center justify-center mb-4">
                        <i class="fas fa-info-circle text-yellow-500 text-2xl mr-3"></i>
                        <h3 class="text-xl font-bold text-yellow-800">Kemungkinan Penyebab</h3>
                    </div>
                    <div class="grid md:grid-cols-2 gap-4 text-left">
                        <div class="bg-white rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-user-shield text-orange-500 mr-2"></i>
                                <h4 class="font-semibold text-gray-700">Hak Akses Terbatas</h4>
                            </div>
                            <p class="text-gray-600 text-sm">Akun Anda tidak memiliki izin untuk area ini</p>
                        </div>
                        <div class="bg-white rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-cogs text-purple-500 mr-2"></i>
                                <h4 class="font-semibold text-gray-700">Area Maintenance</h4>
                            </div>
                            <p class="text-gray-600 text-sm">Halaman sedang dalam pemeliharaan khusus</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-8">
                    <a href="/" class="bg-gray-600 hover:bg-gray-700 text-white px-8 py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 w-full sm:w-auto">
                        <i class="fas fa-home mr-2"></i>
                        Kembali ke Beranda
                    </a>

                    <button onclick="history.back()" class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 w-full sm:w-auto">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Halaman Sebelumnya
                    </button>
                </div>

                <!-- Access Request Section -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-3xl p-8 mb-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Butuh Akses Khusus?</h3>
                    <p class="text-gray-600 mb-6">
                        Jika Anda memerlukan akses ke area ini untuk keperluan bisnis atau layanan pelanggan,
                        silakan hubungi administrator sistem kami.
                    </p>

                    <div class="flex justify-center">
                        <div class="bg-white rounded-lg p-4 text-center w-full max-w-sm">
                            <i class="fas fa-headset text-3xl text-green-500 mb-3"></i>
                            <h4 class="font-semibold text-gray-700 mb-2">Customer Service</h4>
                            <p class="text-gray-600 text-sm mb-3">Bantuan umum pelanggan</p>
                            <a href="https://wa.me/6282138304415" target="_blank" class="text-green-600 hover:text-green-700 font-medium text-sm">
                                WhatsApp Support
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Security Notice -->
                <div class="bg-red-50 border border-red-200 rounded-2xl p-6">
                    <div class="flex items-center justify-center mb-4">
                        <i class="fas fa-shield-alt text-red-500 text-2xl mr-3"></i>
                        <h3 class="text-xl font-bold text-red-800">Pemberitahuan Keamanan</h3>
                    </div>
                    <p class="text-red-700 mb-4">
                        Akses tidak sah ke sistem dapat dimonitor dan dicatat untuk keperluan keamanan.
                        Pastikan Anda memiliki otorisasi yang tepat sebelum mencoba mengakses area terbatas.
                    </p>
                    <div class="flex items-center justify-center text-sm text-red-600">
                        <i class="fas fa-eye mr-2"></i>
                        <span>Aktivitas ini telah dicatat dalam log sistem</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating WhatsApp Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="https://wa.me/6282138304415" target="_blank" class="bg-green-500 hover:bg-green-600 text-white w-16 h-16 rounded-full flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 animate-bounce-gentle">
            <i class="fab fa-whatsapp text-2xl"></i>
        </a>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-400">&copy; 2025 PT Satria Digital Media. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Add loading animation
        window.addEventListener('load', () => {
            document.body.classList.add('loaded');
        });

        // Log access attempt (for demonstration)
        console.log('403 Access Denied - Page access logged at:', new Date().toISOString());

        // Add interactive lock animation
        document.addEventListener('DOMContentLoaded', () => {
            const lockIcon = document.querySelector('.fa-lock');
            if (lockIcon) {
                lockIcon.addEventListener('click', () => {
                    lockIcon.classList.add('animate-shake');
                    setTimeout(() => {
                        lockIcon.classList.remove('animate-shake');
                    }, 500);
                });
            }
        });
    </script>
</body>

</html>