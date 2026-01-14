<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>熊出没駆除システム - 猟友会管理画面</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
        .order-details {
            display: none;
        }
        .order-details.active {
            display: block;
        }
        .line-clamp-1 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1;
        }
        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }
    </style>
</head>
<body class="min-h-screen bg-gray-50">
    <!-- ヘッダー -->
    <header class="bg-green-600 text-white p-4 shadow-md">
        <div class="max-w-7xl mx-auto flex items-center gap-3">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <div>
                <h1 class="text-2xl font-bold">熊出没駆除システム - 猟友会管理画面</h1>
                <p class="text-green-100 text-sm">Hunter Association Management System</p>
            </div>
        </div>
    </header>

    <!-- メインコンテンツ -->
    <main class="max-w-7xl mx-auto p-4">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- タブナビゲーション -->
            <nav class="flex border-b border-gray-200">
                <button onclick="switchTab('orders')" id="tab-orders" class="flex-1 flex items-center justify-center gap-2 p-4 transition-colors bg-green-100 text-green-700 border-b-2 border-green-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span>駆除依頼一覧</span>
                </button>
                <button onclick="switchTab('map')" id="tab-map" class="flex-1 flex items-center justify-center gap-2 p-4 transition-colors text-gray-600 hover:bg-gray-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>マップ</span>
                </button>
                <button onclick="switchTab('chat')" id="tab-chat" class="flex-1 flex items-center justify-center gap-2 p-4 transition-colors text-gray-600 hover:bg-gray-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <span>チャット</span>
                </button>
                <button onclick="switchTab('report')" id="tab-report" class="flex-1 flex items-center justify-center gap-2 p-4 transition-colors text-gray-600 hover:bg-gray-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>対応報告</span>
                </button>
            </nav>

            <!-- タブコンテンツ -->
            <div class="p-6">
                <!-- 駆除依頼一覧タブ -->
                <div id="content-orders" class="tab-content active">
                    <div class="mb-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">駆除依頼一覧</h2>
                        
                        <!-- フィルター -->
                        <div class="flex gap-4 items-center mb-4">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                                <span class="text-sm text-gray-600">フィルター:</span>
                            </div>
                            <select id="filter-status" onchange="filterOrders()" class="px-3 py-1.5 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                                <option value="all">全てのステータス</option>
                                <option value="pending">未対応</option>
                                <option value="accepted">受理</option>
                                <option value="in-progress">対応中</option>
                                <option value="completed">完了</option>
                                <option value="rejected">辞退</option>
                            </select>
                            <select id="filter-urgency" onchange="filterOrders()" class="px-3 py-1.5 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                                <option value="all">全ての緊急度</option>
                                <option value="low">低</option>
                                <option value="medium">中</option>
                                <option value="high">高</option>
                                <option value="critical">緊急</option>
                            </select>
                        </div>

                        <!-- 統計情報 -->
                        <div class="grid grid-cols-4 gap-4 mb-6">
                            <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                                <div class="text-2xl font-bold text-yellow-700" id="stat-pending">0</div>
                                <div class="text-sm text-yellow-600">未対応</div>
                            </div>
                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                <div class="text-2xl font-bold text-blue-700" id="stat-accepted">0</div>
                                <div class="text-sm text-blue-600">受理済み</div>
                            </div>
                            <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                                <div class="text-2xl font-bold text-purple-700" id="stat-in-progress">0</div>
                                <div class="text-sm text-purple-600">対応中</div>
                            </div>
                            <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                                <div class="text-2xl font-bold text-green-700" id="stat-completed">0</div>
                                <div class="text-sm text-green-600">完了</div>
                            </div>
                        </div>
                    </div>

                    <!-- 依頼リスト -->
                    <div id="orders-list" class="space-y-4"></div>
                </div>

                <!-- マップタブ -->
                <div id="content-map" class="tab-content">
                    <div class="mb-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-2">依頼地点マップ</h2>
                        <p class="text-sm text-gray-600">各駆除依頼の発生地点を地図上で確認できます</p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-2">
                            <div class="bg-gray-100 rounded-lg border-2 border-gray-300 relative overflow-hidden" style="height: 600px;">
                                <div id="map-canvas" class="absolute inset-0 bg-gradient-to-br from-green-50 to-blue-50">
                                    <div class="absolute inset-0" style="background-image: linear-gradient(rgba(0,0,0,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(0,0,0,0.05) 1px, transparent 1px); background-size: 50px 50px;"></div>
                                    
                                    <div class="absolute top-4 right-4 bg-white p-3 rounded-lg shadow-md">
                                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                        </svg>
                                        <div class="text-xs text-center mt-1 text-gray-500">N</div>
                                    </div>

                                    <div class="absolute bottom-4 left-4 bg-white px-3 py-2 rounded-lg shadow-md">
                                        <div class="text-xs text-gray-600">縮尺: 1:50000</div>
                                        <div class="mt-1 flex items-center gap-2">
                                            <div class="h-1 w-16 bg-gray-800"></div>
                                            <span class="text-xs text-gray-600">1km</span>
                                        </div>
                                    </div>

                                    <div class="absolute top-4 left-4 bg-white p-3 rounded-lg shadow-md">
                                        <div class="text-xs font-bold text-gray-800 mb-2">緊急度</div>
                                        <div class="space-y-1">
                                            <div class="flex items-center gap-2">
                                                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                                <span class="text-xs text-gray-600">緊急</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <div class="w-3 h-3 bg-orange-500 rounded-full"></div>
                                                <span class="text-xs text-gray-600">高</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                                <span class="text-xs text-gray-600">中</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <div class="w-3 h-3 bg-gray-500 rounded-full"></div>
                                                <span class="text-xs text-gray-600">低</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <div class="flex items-start gap-2">
                                    <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div class="text-sm text-blue-800">
                                        <p class="font-medium mb-1">マップについて</p>
                                        <p class="text-blue-700">この地図は駆除依頼の発生地点を視覚的に表示しています。実際の運用ではGoogle Maps APIやMapbox等の地図サービスと連携します。マーカーをクリックすると詳細情報が表示されます。</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="lg:col-span-1">
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200" style="max-height: 600px; overflow-y: auto;">
                                <h3 class="font-bold text-gray-800 mb-4">依頼一覧</h3>
                                <div id="map-order-list" class="space-y-3"></div>
                            </div>

                            <div id="map-order-detail" class="mt-4 bg-white rounded-lg p-4 border-2 border-green-500" style="display: none;"></div>
                        </div>
                    </div>
                </div>

                <!-- チャットタブ -->
                <div id="content-chat" class="tab-content">
                    <div class="mb-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-2">自治体とのチャット</h2>
                        <p class="text-sm text-gray-600">各駆除依頼について自治体担当者とリアルタイムでコミュニケーションできます</p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-1">
                            <div class="bg-gray-50 rounded-lg border border-gray-200 p-4" style="height: 600px; overflow-y: auto;">
                                <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    チャットスレッド
                                </h3>
                                <div id="chat-threads" class="space-y-2"></div>
                            </div>
                        </div>

                        <div class="lg:col-span-2">
                            <div id="chat-messages-container" class="bg-white rounded-lg border border-gray-200 flex flex-col" style="height: 600px;">
                                <div class="flex-1 flex items-center justify-center">
                                    <div class="text-center text-gray-500">
                                        <svg class="w-12 h-12 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                        <p class="text-lg font-medium">チャットスレッドを選択してください</p>
                                        <p class="text-sm mt-2">左側のリストから確認したいチャットを選択してください</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="text-sm text-blue-800">
                                <p class="font-medium mb-1">チャット機能について</p>
                                <p class="text-blue-700">このチャットは各駆除依頼ごとに自治体担当者とコミュニケーションを取るための機能です。現地の状況報告、追加情報の確認、対応状況の共有などにご活用ください。</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 対応報告タブ -->
                <div id="content-report" class="tab-content">
                    <div class="mb-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-2">対応結果報告</h2>
                        <p class="text-sm text-gray-600">駆除作業完了後、詳細な報告書を作成・提出します</p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-1">
                            <div class="bg-gray-50 rounded-lg border border-gray-200 p-4" style="height: 600px; overflow-y: auto;">
                                <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    報告可能な依頼
                                </h3>
                                <div id="report-order-list" class="space-y-2"></div>
                            </div>
                        </div>

                        <div class="lg:col-span-2">
                            <div id="report-form-container" class="bg-gray-50 rounded-lg border border-gray-200 flex items-center justify-center" style="height: 600px;">
                                <div class="text-center text-gray-500">
                                    <svg class="w-12 h-12 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <p class="text-lg font-medium">報告する依頼を選択してください</p>
                                    <p class="text-sm mt-2">左側のリストから対応完了した依頼を選択してください</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <div class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-yellow-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <div class="text-sm text-yellow-800">
                                <p class="font-medium mb-1">報告書提出について</p>
                                <p class="text-yellow-700">駆除作業完了後は必ず報告書を提出してください。報酬の支払いには報告書の提出が必要です。可能な限り現場写真も添付してください。</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
    // Blade → JS データ受け渡し（Bladeはここだけ）
    window.APP_DATA = @json($appData);
</script>

@verbatim
<script>
    // =========================
    // CSRF トークン（Ajax用）
    // =========================
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute('content');

    // =========================
    // Laravel → JS データ受け取り
    // =========================
    const orders = window.APP_DATA.orders ?? [];
    const chatThreads = window.APP_DATA.chatThreads ?? [];
    const chatMessages = window.APP_DATA.chatMessages ?? {};

    // =========================
    // 状態管理用変数
    // =========================
    let selectedChatThread = null;
    let selectedOrderId = null;
    let currentTab = 'orders';

    console.log('orders', orders);
    console.log('chatThreads', chatThreads);
    console.log('chatMessages', chatMessages);

    // =========================
    // タブ切り替え
    // =========================
    function switchTab(tab) {
        currentTab = tab;

        document.querySelectorAll('.tab-content').forEach(el => {
            el.classList.remove('active');
        });

        document.querySelectorAll('nav button').forEach(btn => {
            btn.classList.remove('bg-green-100', 'text-green-700', 'border-green-600');
            btn.classList.add('text-gray-600');
        });

        document.getElementById(`content-${tab}`).classList.add('active');
        document.getElementById(`tab-${tab}`).classList.add(
            'bg-green-100',
            'text-green-700',
            'border-b-2',
            'border-green-600'
        );
    }

    // =========================
    // 駆除依頼一覧 描画
    // =========================
    function renderOrders(list) {
        const container = document.getElementById('orders-list');
        container.innerHTML = '';

        if (!list || !list.length) {
            container.innerHTML = '<p class="text-gray-500">依頼がありません</p>';
            return;
        }

        list.forEach(order => {
            const div = document.createElement('div');
            div.className = 'bg-white border rounded-lg p-4 shadow-sm';
            div.innerHTML = `
                <div class="flex justify-between items-center">
                    <h3 class="font-bold text-gray-800">依頼 #${order.id}</h3>
                    <span class="text-sm text-gray-500">${order.status ?? ''}</span>
                </div>
                <p class="text-sm text-gray-600 mt-2">${order.place ?? ''}</p>
                <p class="text-sm mt-1">${order.text ?? ''}</p>
            `;
            container.appendChild(div);
        });
    }

    // =========================
    // フィルター処理
    // =========================
    function filterOrders() {
        const status = document.getElementById('filter-status').value;
        const urgency = document.getElementById('filter-urgency').value;

        let filtered = [...orders];

        if (status !== 'all') {
            filtered = filtered.filter(o => o.status === status);
        }

        if (urgency !== 'all') {
            filtered = filtered.filter(o => o.urgency === urgency);
        }

        renderOrders(filtered);
        updateStats(filtered);
    }

    // =========================
    // 統計情報更新
    // =========================
    function updateStats(list) {
        const count = status =>
            list.filter(o => o.status === status).length;

        document.getElementById('stat-pending').textContent = count('pending');
        document.getElementById('stat-accepted').textContent = count('accepted');
        document.getElementById('stat-in-progress').textContent = count('in-progress');
        document.getElementById('stat-completed').textContent = count('completed');
    }

    // =========================
    // チャットスレッド描画
    // =========================
    function renderChatThreads() {
        const container = document.getElementById('chat-threads');
        container.innerHTML = '';

        chatThreads.forEach(thread => {
            const div = document.createElement('div');
            div.className = 'p-3 border rounded cursor-pointer hover:bg-gray-100';
            div.innerHTML = `
                <div class="font-bold text-sm">${thread.title}</div>
                <div class="text-xs text-gray-500">${thread.lastMessage}</div>
            `;
            div.onclick = () => openChat(thread.id);
            container.appendChild(div);
        });
    }

    // =========================
    // チャット表示
    // =========================
    function openChat(threadId) {
        selectedChatThread = threadId;
        const messages = chatMessages[threadId] || [];

        const container = document.getElementById('chat-messages-container');
        container.innerHTML = `
            <div class="flex-1 p-4 overflow-y-auto space-y-2"></div>
        `;

        const body = container.querySelector('div');

        messages.forEach(msg => {
            const div = document.createElement('div');
            div.className = msg.senderType === 'hunter'
                ? 'text-right'
                : 'text-left';

            div.innerHTML = `
                <div class="inline-block px-3 py-2 rounded-lg ${
                    msg.senderType === 'hunter'
                        ? 'bg-green-500 text-white'
                        : 'bg-gray-200'
                }">
                    <p class="text-sm">${msg.message}</p>
                </div>
            `;
            body.appendChild(div);
        });
    }

    // =========================
    // 初期化
    // =========================
    document.addEventListener('DOMContentLoaded', () => {
        renderOrders(orders);
        updateStats(orders);
        renderChatThreads();
    });
</script>
@endverbatim
    

</body>
</html>
