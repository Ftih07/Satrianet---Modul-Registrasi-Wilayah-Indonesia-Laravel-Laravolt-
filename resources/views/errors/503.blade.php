<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/images/icon.png') }}" type="image/x-icon">
    
    <title>503 - Layanan Tidak Tersedia | SatriaNet</title>
    <meta name="description" content="Layanan sedang dalam pemeliharaan. SatriaNet akan segera kembali dengan layanan yang lebih baik.">
    
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
                        'maintenance': 'maintenance 2s ease-in-out infinite'
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

        @keyframes maintenance {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .error-number {
            background: linear-gradient(45deg, #f59e0b, #d97706);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .maintenance-bg {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        }

        .progress-bar {
            background: linear-gradient(90deg, #3b82f6, #1d4ed8);
            animation: progress 3s ease-in-out infinite;
        }

        @keyframes progress {
            0% { width: 0%; }
            50% { width: 75%; }
            100% { width: 0%; }
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
                    <span class="bg-yellow-500 text-white px-4 py-2 rounded-full font-semibold text-sm">
                        Dalam Pemeliharaan
                    </span>
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
                    503
                </div>
            </div>

            <!-- Main Content -->
            <div class="animate-fade-in">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">
                    Layanan Sedang Dipelihara
                </h1>
                
                <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                    Kami sedang melakukan pemeliharaan sistem untuk memberikan layanan yang lebih baik. 
                    Mohon maaf atas ketidaknyamanan ini.
                </p>

                <!-- Maintenance Illustration -->
                <div class="maintenance-bg rounded-3xl p-8 shadow-xl mb-8 max-w-md mx-auto">
                    <div class="text-6xl text-yellow-600 mb-4 animate-maintenance">
                        <i class="fas fa-tools"></i>
                    </div>
                    <div class="text-2xl text-yellow-500 animate-pulse-slow mb-4">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <p class="text-yellow-700 font-medium mb-4">Sistem dalam pemeliharaan</p>
                    
                    <!-- Progress Bar -->
                    <div class="w-full bg-yellow-200 rounded-full h-2 mb-2">
                        <div class="progress-bar h-2 rounded-full"></div>
                    </div>
                    <p class="text-yellow-600 text-sm">Sedang berlangsung...</p>
                </div>

                <!-- What's Being Improved -->
                <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-3xl p-8 mb-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Yang Sedang Kami Tingkatkan</h3>
                    <div class="grid md:grid-cols-3 gap-4 text-left">
                        <div class="bg-white rounded-lg p-4 text-center">
                            <i class="fas fa-tachometer-alt text-3xl text-blue-500 mb-3"></i>
                            <h4 class="font-semibold text-gray-700 mb-2">Kecepatan</h4>
                            <p class="text-gray-600 text-sm">Optimisasi performa website</p>
                        </div>
                        <div class="bg-white rounded-lg p-4 text-center">
                            <i class="fas fa-shield-alt text-3xl text-green-500 mb-3"></i>
                            <h4 class="font-semibold text-gray-700 mb-2">Keamanan</h4>
                            <p class="text-gray-600 text-sm">Update sistem keamanan</p>
                        </div>
                        <div class="bg-white rounded-lg p-4 text-center">
                            <i class="fas fa-mobile-alt text-3xl text-purple-500 mb-3"></i>
                            <h4 class="font-semibold text-gray-700 mb-2">Responsivitas</h4>
                            <p class="text-gray-600 text-sm">Perbaikan tampilan mobile</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-8">
                    <button onclick="window.location.reload()" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 w-full sm:w-auto">
                        <i class="fas fa-redo mr-2"></i>
                        Cek Status Terbaru
                    </button>
                    
                    <a href="mailto:info@satrianet.co.id" class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 w-full sm:w-auto">
                        <i class="fas fa-envelope mr-2"></i>
                        Hubungi Admin
                    </a>
                </div>

                <!-- Contact During Maintenance -->
                <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-3xl p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Tetap Terhubung</h3>
                    <p class="text-gray-600 mb-6">
                        Meskipun website sedang dipelihara, layanan internet tetap berjalan normal. 
                        Untuk bantuan mendesak, hubungi kami melalui:
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="https://wa.me/6282138304415" target="_blank" rel="noopener noreferrer" 
                           class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                            <i class="fab fa-whatsapp mr-2"></i>
                            WhatsApp 24/7
                        </a>
                        
                        <a href="tel:02817781133" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                            <i class="fas fa-phone mr-2"></i>
                            Telepon Darurat
                        </a>
                    </div>

                    <!-- Social Media Updates -->
                    <div class="mt-6 pt-6 border-t border-orange-200">
                        <p class="text-gray-600 mb-4">Ikuti update pemeliharaan di media sosial:</p>
                        <div class="flex justify-center space-x-4">
                            <a href="https://web.facebook.com/profile.php?id=100070538542707" target="_blank" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                <i class="fab fa-facebook-f text-white"></i>
                            </a>
                            <a href="https://www.instagram.com/satrianet_official/" target="_blank" class="w-10 h-10 bg-pink-600 rounded-full flex items-center justify-center hover:bg-pink-700 transition-colors">
                                <i class="fab fa-instagram text-white"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Auto Refresh Notice -->
                <div class="mt-8 text-sm text-gray-500">
                    <p>Halaman ini akan otomatis di-refresh setiap <span id="countdown">120</span> detik</p>
                    <div class="mt-2">
                        <div class="w-48 bg-gray-200 rounded-full h-1 mx-auto">
                            <div id="refresh-progress" class="bg-blue-500 h-1 rounded-full transition-all duration-1000" style="width: 0%"></div>
                        </div>
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
            <p class="text-gray-500 text-sm mt-2">Terima kasih atas kesabaran Anda selama pemeliharaan sistem</p>
        </div>
    </footer>

    <script>
        // Add loading animation
        window.addEventListener('load', () => {
            document.body.classList.add('loaded');
        });

        // Auto refresh countdown with progress bar
        let countdown = 120;
        const countdownElement = document.getElementById('countdown');
        const progressBar = document.getElementById('refresh-progress');
        const totalTime = 120;
        
        const timer = setInterval(() => {
            countdown--;
            countdownElement.textContent = countdown;
            
            // Update progress bar
            const progress = ((totalTime - countdown) / totalTime) * 100;
            progressBar.style.width = progress + '%';
            
            if (countdown <= 0) {
                clearInterval(timer);
                window.location.reload();
            }
        }, 1000);

        // Add status check functionality
        document.addEventListener('DOMContentLoaded', () => {
            const statusButton = document.querySelector('button[onclick="window.location.reload()"]');
            if (statusButton) {
                statusButton.addEventListener('click', () => {
                    statusButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengecek status...';
                    statusButton.disabled = true;
                });
            }
        });

        // Simulate maintenance progress (for demo purposes)
        setInterval(() => {
            const maintenanceProgress = document.querySelector('.progress-bar');
            if (maintenanceProgress) {
                const randomWidth = Math.floor(Math.random() * 40) + 30;
                maintenanceProgress.style.width = randomWidth + '%';
            }
        }, 5000);
    </script>
</body>

</html>