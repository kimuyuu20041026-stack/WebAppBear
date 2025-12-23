<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>熊出没通報システム - 住民用</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="min-h-screen bg-gray-50" x-data="{ activeTab: 'map' }">
    <!-- ヘッダー -->
    <header class="bg-green-400 text-white p-4 shadow-md">
        <div class="max-w-6xl mx-auto flex items-center gap-3">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <h1 class="text-2xl font-bold">熊出没通報システム</h1>
        </div>
    </header>

    <!-- メインコンテンツ -->
    <main class="max-w-6xl mx-auto p-4">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- タブナビゲーション -->
            <nav class="flex border-b border-gray-200">
                <button @click="activeTab = 'map'" 
                        :class="activeTab === 'map' ? 'bg-green-100 text-green-700 border-b-2 border-green-400' : 'text-gray-600 hover:bg-gray-50'"
                        class="flex-1 flex items-center justify-center gap-2 p-4 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>出没マップ</span>
                </button>
                <button @click="activeTab = 'chat'" 
                        :class="activeTab === 'chat' ? 'bg-green-100 text-green-700 border-b-2 border-green-400' : 'text-gray-600 hover:bg-gray-50'"
                        class="flex-1 flex items-center justify-center gap-2 p-4 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <span>チャット</span>
                </button>
                <button @click="activeTab = 'status'" 
                        :class="activeTab === 'status' ? 'bg-green-100 text-green-700 border-b-2 border-green-400' : 'text-gray-600 hover:bg-gray-50'"
                        class="flex-1 flex items-center justify-center gap-2 p-4 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <span>ステータス</span>
                </button>
                <button @click="activeTab = 'report'" 
                        :class="activeTab === 'report' ? 'bg-green-100 text-green-700 border-b-2 border-green-400' : 'text-gray-600 hover:bg-gray-50'"
                        class="flex-1 flex items-center justify-center gap-2 p-4 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <span>通報する</span>
                </button>
            </nav>

            <!-- タブコンテンツ -->
            <div class="p-6">
                <!-- 出没マップ -->
                <div x-show="activeTab === 'map'" x-cloak>
                    @include('partials.map-view')
                </div>

                <!-- チャット -->
                <div x-show="activeTab === 'chat'" x-cloak>
                    @include('partials.chat-view')
                </div>

                <!-- ステータス -->
                <div x-show="activeTab === 'status'" x-cloak>
                    @include('partials.status-view')
                </div>

                <!-- 通報フォーム -->
                <div x-show="activeTab === 'report'" x-cloak>
                    @include('partials.report-form')
                </div>
            </div>
        </div>
    </main>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</body>
</html>
