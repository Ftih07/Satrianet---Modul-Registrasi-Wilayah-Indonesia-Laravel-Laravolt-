<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/icon.png') }}" type="image/x-icon">

    <title>404 - Halaman Tidak Ditemukan | SatriaNet</title>
    <meta name="description" content="Halaman yang Anda cari tidak ditemukan. Kembali ke SatriaNet untuk mendapatkan layanan internet fiber optik terbaik.">

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
                        'wiggle': 'wiggle 1s ease-in-out infinite'
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

        @keyframes wiggle {

            0%,
            7%,
            100% {
                transform: rotate(0deg);
            }

            15% {
                transform: rotate(-3deg);
            }

            20% {
                transform: rotate(3deg);
            }
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .error-number {
            background: linear-gradient(45deg, #f59e0b, #ef4444);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
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
                    404
                </div>
            </div>

            <!-- Main Content -->
            <div class="animate-fade-in">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">
                    Oops! Halaman Tidak Ditemukan
                </h1>

                <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                    Sepertinya Anda tersesat di dunia maya. Halaman yang Anda cari mungkin telah dipindahkan,
                    dihapus, atau URL yang dimasukkan salah.
                </p>

                <!-- Connection Lost Illustration -->
                <div class="bg-white rounded-3xl p-8 shadow-xl mb-8 max-w-md mx-auto">
                    <div class="text-6xl text-red-400 mb-4 animate-wiggle">
                        <i class="fas fa-question-circle animate-bounce"></i>
                    </div>
                    <p class="text-gray-500 font-medium">Koneksi ke halaman terputus</p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
                    <a href="/" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 w-full sm:w-auto">
                        <i class="fas fa-home mr-2"></i>
                        Kembali ke Beranda
                    </a>

                    <button onclick="history.back()" class="bg-gray-600 hover:bg-gray-700 text-white px-8 py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 w-full sm:w-auto">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Halaman Sebelumnya
                    </button>
                </div>

                <!-- Help Section -->
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-3xl p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Butuh Bantuan?</h3>
                    <p class="text-gray-600 mb-6">
                        Tim customer service SatriaNet siap membantu Anda 24/7
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="https://wa.me/6282138304415" target="_blank" rel="noopener noreferrer"
                            class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                            <i class="fab fa-whatsapp mr-2"></i>
                            Hubungi via WhatsApp
                        </a>

                        <a href="tel:02817781133"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                            <i class="fas fa-phone mr-2"></i>
                            Telepon Kami
                        </a>
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

        // Auto redirect after 30 seconds (optional)
        setTimeout(() => {
            if (confirm('Halaman tidak ditemukan. Apakah Anda ingin kembali ke beranda?')) {
                window.location.href = '/';
            }
        }, 30000);
    </script>
</body>

</html>