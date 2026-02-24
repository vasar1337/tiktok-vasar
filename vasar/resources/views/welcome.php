<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>vasar — Скачать TikTok без водяного знака</title>
    <meta name="description" content="Скачивайте видео с TikTok без водяного знака быстро и бесплатно">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Vue.js 3 -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #0f0f0f 0%, #1a1a2e 50%, #16213e 100%);
            min-height: 100vh;
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .input-glow:focus {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.3);
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 40px rgba(102, 126, 234, 0.4);
        }
        
        .btn-gradient:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }
        
        @keyframes pulse-glow {
            0%, 100% {
                box-shadow: 0 0 20px rgba(102, 126, 234, 0.3);
            }
            50% {
                box-shadow: 0 0 40px rgba(102, 126, 234, 0.6);
            }
        }
        
        .loading-pulse {
            animation: pulse-glow 2s infinite;
        }
        
        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .slide-up {
            animation: slide-up 0.5s ease forwards;
        }
        
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .spin {
            animation: spin 1s linear infinite;
        }
        
        .tiktok-gradient {
            background: linear-gradient(45deg, #00f2ea, #ff0050);
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }
        
        ::-webkit-scrollbar-thumb {
            background: rgba(102, 126, 234, 0.5);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(102, 126, 234, 0.7);
        }
    </style>
</head>
<body class="text-white">
    <div id="app" class="min-h-screen">
        <!-- Header -->
        <header class="py-6 px-4">
            <div class="max-w-6xl mx-auto flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl btn-gradient flex items-center justify-center">
                        <i class="ri-download-2-fill text-xl"></i>
                    </div>
                    <h1 class="text-2xl font-bold gradient-text">vasar</h1>
                </div>
                <nav class="hidden md:flex items-center gap-8">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Главная</a>
                    <a href="#how-it-works" class="text-gray-400 hover:text-white transition-colors">Как это работает</a>
                    <a href="#faq" class="text-gray-400 hover:text-white transition-colors">FAQ</a>
                </nav>
            </div>
        </header>

        <!-- Main Content -->
        <main class="px-4 py-16">
            <div class="max-w-4xl mx-auto">
                <!-- Hero Section -->
                <div class="text-center mb-12 slide-up">
                    <h2 class="text-5xl md:text-6xl font-bold mb-6">
                        Скачать TikTok<br>
                        <span class="gradient-text">без водяного знака</span>
                    </h2>
                    <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                        Быстро, бесплатно и без регистрации. Просто вставьте ссылку на видео и скачайте его в оригинальном качестве.
                    </p>
                </div>

                <!-- Input Section -->
                <div class="glass-card rounded-3xl p-8 mb-12 slide-up" style="animation-delay: 0.1s">
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1 relative">
                            <i class="ri-link absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-xl"></i>
                            <input 
                                v-model="url"
                                @keyup.enter="downloadVideo"
                                type="text" 
                                placeholder="Вставьте ссылку на TikTok видео..."
                                class="w-full pl-12 pr-4 py-4 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-500 input-glow focus:border-purple-500 focus:outline-none transition-all"
                            >
                        </div>
                        <button 
                            @click="downloadVideo"
                            :disabled="loading || !url"
                            class="btn-gradient px-8 py-4 rounded-xl font-semibold whitespace-nowrap flex items-center justify-center gap-2 min-w-[160px]"
                        >
                            <i v-if="loading" class="ri-loader-4-line spin"></i>
                            <i v-else class="ri-download-line"></i>
                            {{ loading ? 'Загрузка...' : 'Скачать' }}
                        </button>
                    </div>

                    <!-- Error Message -->
                    <div v-if="error" class="mt-4 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 flex items-center gap-3">
                        <i class="ri-error-warning-line text-xl"></i>
                        {{ error }}
                    </div>
                </div>

                <!-- Video Result -->
                <div v-if="videoData" class="glass-card rounded-3xl p-8 mb-12 slide-up" style="animation-delay: 0.2s">
                    <div class="flex flex-col md:flex-row gap-8">
                        <!-- Video Preview -->
                        <div class="md:w-72 flex-shrink-0">
                            <div class="relative rounded-2xl overflow-hidden aspect-[9/16]">
                                <img :src="videoData.video.cover" alt="Video cover" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                <div class="absolute bottom-4 left-4 right-4">
                                    <div class="flex items-center gap-2 mb-2">
                                        <img :src="videoData.author.avatar" alt="Author" class="w-8 h-8 rounded-full">
                                        <span class="text-sm font-medium">{{ videoData.author.nickname }}</span>
                                    </div>
                                    <p class="text-sm text-gray-300 line-clamp-2">{{ videoData.title }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Video Info -->
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold mb-4">Информация о видео</h3>
                            
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                                <div class="bg-white/5 rounded-xl p-4">
                                    <i class="ri-play-circle-line text-purple-400 text-2xl mb-2"></i>
                                    <p class="text-2xl font-bold">{{ formatNumber(videoData.stats.plays) }}</p>
                                    <p class="text-gray-500 text-sm">Просмотров</p>
                                </div>
                                <div class="bg-white/5 rounded-xl p-4">
                                    <i class="ri-heart-line text-red-400 text-2xl mb-2"></i>
                                    <p class="text-2xl font-bold">{{ formatNumber(videoData.stats.likes) }}</p>
                                    <p class="text-gray-500 text-sm">Лайков</p>
                                </div>
                                <div class="bg-white/5 rounded-xl p-4">
                                    <i class="ri-chat-1-line text-green-400 text-2xl mb-2"></i>
                                    <p class="text-2xl font-bold">{{ formatNumber(videoData.stats.comments) }}</p>
                                    <p class="text-gray-500 text-sm">Комментариев</p>
                                </div>
                            </div>

                            <!-- Download Buttons -->
                            <div class="flex flex-wrap gap-3">
                                <a 
                                    v-if="videoData.video.no_watermark"
                                    :href="videoData.video.no_watermark"
                                    target="_blank"
                                    download
                                    class="btn-gradient px-6 py-3 rounded-xl font-semibold flex items-center gap-2"
                                >
                                    <i class="ri-download-line"></i>
                                    Без водяного знака
                                </a>
                                <a 
                                    v-if="videoData.video.watermark"
                                    :href="videoData.video.watermark"
                                    target="_blank"
                                    download
                                    class="px-6 py-3 rounded-xl font-semibold border border-white/20 hover:bg-white/10 transition-all flex items-center gap-2"
                                >
                                    <i class="ri-file-video-line"></i>
                                    С водяным знаком
                                </a>
                                <a 
                                    v-if="videoData.video.music"
                                    :href="videoData.video.music"
                                    target="_blank"
                                    download
                                    class="px-6 py-3 rounded-xl font-semibold border border-white/20 hover:bg-white/10 transition-all flex items-center gap-2"
                                >
                                    <i class="ri-music-line"></i>
                                    Аудио
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Features Section -->
                <div id="how-it-works" class="mb-16 slide-up" style="animation-delay: 0.3s">
                    <h3 class="text-3xl font-bold text-center mb-12">Как это работает</h3>
                    <div class="grid md:grid-cols-3 gap-8">
                        <div class="text-center">
                            <div class="w-16 h-16 rounded-2xl btn-gradient flex items-center justify-center mx-auto mb-4">
                                <span class="text-2xl font-bold">1</span>
                            </div>
                            <h4 class="text-xl font-semibold mb-2">Скопируйте ссылку</h4>
                            <p class="text-gray-400">Откройте TikTok и скопируйте ссылку на видео, которое хотите скачать</p>
                        </div>
                        <div class="text-center">
                            <div class="w-16 h-16 rounded-2xl btn-gradient flex items-center justify-center mx-auto mb-4">
                                <span class="text-2xl font-bold">2</span>
                            </div>
                            <h4 class="text-xl font-semibold mb-2">Вставьте ссылку</h4>
                            <p class="text-gray-400">Вставьте скопированную ссылку в поле ввода на нашем сайте</p>
                        </div>
                        <div class="text-center">
                            <div class="w-16 h-16 rounded-2xl btn-gradient flex items-center justify-center mx-auto mb-4">
                                <span class="text-2xl font-bold">3</span>
                            </div>
                            <h4 class="text-xl font-semibold mb-2">Скачайте видео</h4>
                            <p class="text-gray-400">Нажмите кнопку скачать и получите видео без водяного знака</p>
                        </div>
                    </div>
                </div>

                <!-- FAQ Section -->
                <div id="faq" class="slide-up" style="animation-delay: 0.4s">
                    <h3 class="text-3xl font-bold text-center mb-12">Частые вопросы</h3>
                    <div class="space-y-4">
                        <div v-for="(faq, index) in faqs" :key="index" class="glass-card rounded-2xl overflow-hidden">
                            <button 
                                @click="toggleFaq(index)"
                                class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-white/5 transition-colors"
                            >
                                <span class="font-medium">{{ faq.question }}</span>
                                <i :class="['ri-arrow-down-s-line transition-transform', faq.open ? 'rotate-180' : '']"></i>
                            </button>
                            <div v-show="faq.open" class="px-6 pb-4 text-gray-400">
                                {{ faq.answer }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="py-8 px-4 mt-16 border-t border-white/10">
            <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg btn-gradient flex items-center justify-center">
                        <i class="ri-download-2-fill text-sm"></i>
                    </div>
                    <span class="font-semibold gradient-text">vasar</span>
                </div>
                <p class="text-gray-500 text-sm">
                    © 2026 vasar. Все права защищены.
                </p>
                <div class="flex items-center gap-4">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="ri-github-line text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="ri-telegram-line text-xl"></i>
                    </a>
                </div>
            </div>
        </footer>
    </div>

    <script>
        const { createApp } = Vue;

        createApp({
            data() {
                return {
                    url: '',
                    loading: false,
                    error: '',
                    videoData: null,
                    faqs: [
                        {
                            question: 'Это бесплатно?',
                            answer: 'Да, наш сервис полностью бесплатный и не требует регистрации.',
                            open: false
                        },
                        {
                            question: 'В каком качестве скачивается видео?',
                            answer: 'Видео скачивается в оригинальном качестве, в котором оно загружено на TikTok.',
                            open: false
                        },
                        {
                            question: 'Можно ли скачать аудио из TikTok?',
                            answer: 'Да, вы можете скачать аудио дорожку отдельно от видео.',
                            open: false
                        },
                        {
                            question: 'Работает ли сервис с приватными видео?',
                            answer: 'Нет, сервис работает только с публичными видео TikTok.',
                            open: false
                        }
                    ]
                }
            },
            methods: {
                async downloadVideo() {
                    if (!this.url) return;

                    this.loading = true;
                    this.error = '';
                    this.videoData = null;

                    try {
                        const response = await fetch('/vasar/api/download', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({ url: this.url })
                        });

                        const data = await response.json();

                        if (data.success) {
                            this.videoData = data.data;
                        } else {
                            this.error = data.message || 'Произошла ошибка при обработке запроса';
                        }
                    } catch (err) {
                        this.error = 'Не удалось подключиться к серверу. Проверьте соединение и попробуйте снова';
                        console.error(err);
                    } finally {
                        this.loading = false;
                    }
                },
                formatNumber(num) {
                    if (num >= 1000000) {
                        return (num / 1000000).toFixed(1) + 'M';
                    }
                    if (num >= 1000) {
                        return (num / 1000).toFixed(1) + 'K';
                    }
                    return num.toString();
                },
                toggleFaq(index) {
                    this.faqs[index].open = !this.faqs[index].open;
                }
            }
        }).mount('#app');
    </script>
</body>
</html>
