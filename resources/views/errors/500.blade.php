<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/icon.png') }}" type="image/x-icon">
    
    <title>500 - Kesalahan Server | SatriaNet</title>
    <meta name="description" content="Terjadi kesalahan pada server. Tim teknis SatriaNet sedang menangani masalah ini. Coba lagi beberapa saat.">
    
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
                        'pulse-slow': 'pulse 3s ease-in-out infinite',
                        'spin-slow': 'spin 3s linear infinite'
                    }
                }
            }
        }
    </script>
    
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes bounceGentle {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .error-number {
            background: linear-gradient(45deg, #ef4444, #dc2626);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .server-error {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
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
            </div>
        </div>
    </nav>

    <!-- Error Content -->
    <div class="min-h-screen flex items-center justify-center pt-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Floating Animation Container -->
            <div class="animate-float mb-8">
                <div class="error-number text-8xl md:text-9xl font-bold mb-4">
                    500
                </div>
            </div>

            <!-- Main Content -->
            <div class="animate-fade-in">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">
                    Kesalahan Server Internal
                </h1>
                
                <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                    Maaf, terjadi kesalahan pada server kami. Tim teknis sedang bekerja keras untuk 
                    memperbaiki masalah ini. Silakan coba lagi dalam beberapa menit.
                </p>

                <!-- Server Error Illustration -->
                <div class="server-error rounded-3xl p-8 shadow-xl mb-8 max-w-md mx-auto">
                    <div class="text-6xl text-red-500 mb-4 animate-pulse-slow">
                        <i class="fas fa-server"></i>
                    </div>
                    <div class="text-2xl text-red-400 animate-spin-slow mb-2">
                        <i class="fas fa-cog"></i>
                    </div>
                    <p class="text-red-600 font-medium">Server sedang dalam perbaikan</p>
                </div>

                <!-- Status Information -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-6 mb-8">
                    <div class="flex items-center justify-center mb-4">
                        <i class="fas fa-exclamation-triangle text-yellow-500 text-2xl mr-3"></i>
                        <h3 class="text-xl font-bold text-yellow-800">Status Sistem</h3>
                    </div>
                    <p class="text-yellow-700 mb-4">
                        Kami sedang mengalami gangguan teknis sementara. Tim teknis telah diberitahu dan 
                        sedang menangani masalah ini dengan prioritas tinggi.
                    </p>
                    <div class="text-sm text-yellow-600">
                        <p><strong>Estimasi Waktu Perbaikan:</strong> 15-30 menit</p>
                        <p><strong>Status Terakhir:</strong> Sedang dalam proses perbaikan</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-8">
                    <button onclick="window.location.reload()" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 w-full sm:w-auto">
                        <i class="fas fa-redo mr-2"></i>
                        Coba Lagi
                    </button>      
                </div>

                <!-- Technical Support Section -->
                <div class="bg-gradient-to-r from-red-50 to-pink-50 rounded-3xl p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Butuh Bantuan Teknis?</h3>
                    <p class="text-gray-600 mb-6">
                        Jika masalah ini terus berlanjut, hubungi tim teknis SatriaNet untuk bantuan lebih lanjut
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="https://wa.me/6282138304415" target="_blank" rel="noopener noreferrer" 
                           class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                            <i class="fab fa-whatsapp mr-2"></i>
                            Lapor via WhatsApp
                        </a>
                        
                        <a href="tel:02817781133" 
                           class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                            <i class="fas fa-phone mr-2"></i>
                            Hubungi Tim Teknis
                        </a>
                    </div>
                </div>

                <!-- Auto Refresh Notice -->
                <div class="mt-8 text-sm text-gray-500">
                    <p>Halaman ini akan otomatis di-refresh dalam <span id="countdown">60</span> detik</p>
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

        // Auto refresh countdown
        let countdown = 60;
        const countdownElement = document.getElementById('countdown');
        
        const timer = setInterval(() => {
            countdown--;
            countdownElement.textContent = countdown;
            
            if (countdown <= 0) {
                clearInterval(timer);
                window.location.reload();
            }
        }, 1000);

        // Add retry button functionality
        document.addEventListener('DOMContentLoaded', () => {
            const retryButton = document.querySelector('button[onclick="window.location.reload()"]');
            if (retryButton) {
                retryButton.addEventListener('click', () => {
                    retryButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mencoba ulang...';
                    retryButton.disabled = true;
                });
            }
        });
    </script>
</body>

</html>