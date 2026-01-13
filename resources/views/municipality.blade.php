<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>熊出没通報システム - 自治体管理画面</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="min-h-screen bg-gray-50" x-data="municipalityApp()">
    <!-- ヘッダー -->
    <header class="bg-green-600 text-white p-4 shadow-md">
        <div class="max-w-7xl mx-auto flex items-center gap-3">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <div>
                <h1 class="text-2xl font-bold">熊出没通報システム - 自治体管理画面</h1>
                <p class="text-green-100 text-sm">Bear Sighting Management System</p>
            </div>
        </div>
    </header>

    <!-- メインコンテンツ -->
    <main class="max-w-7xl mx-auto p-4">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- タブナビゲーション -->
            <nav class="flex border-b border-gray-200">
                <button @click="activeTab = 'reports'" 
                        :class="activeTab === 'reports' ? 'bg-green-100 text-green-700 border-b-2 border-green-600' : 'text-gray-600 hover:bg-gray-50'"
                        class="flex-1 flex items-center justify-center gap-2 p-4 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <span>通報一覧</span>
                </button>
                <button @click="activeTab = 'hunting'" 
                        :class="activeTab === 'hunting' ? 'bg-green-100 text-green-700 border-b-2 border-green-600' : 'text-gray-600 hover:bg-gray-50'"
                        class="flex-1 flex items-center justify-center gap-2 p-4 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    <span>駆除依頼</span>
                </button>
                <button @click="activeTab = 'chat'" 
                        :class="activeTab === 'chat' ? 'bg-green-100 text-green-700 border-b-2 border-green-600' : 'text-gray-600 hover:bg-gray-50'"
                        class="flex-1 flex items-center justify-center gap-2 p-4 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <span>チャット</span>
                </button>
                <button @click="activeTab = 'map'" 
                        :class="activeTab === 'map' ? 'bg-green-100 text-green-700 border-b-2 border-green-600' : 'text-gray-600 hover:bg-gray-50'"
                        class="flex-1 flex items-center justify-center gap-2 p-4 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>マップ</span>
                </button>
            </nav>

            <!-- タブコンテンツ -->
            <div class="p-6">
                <!-- 通報一覧 -->
                <div x-show="activeTab === 'reports'" x-cloak>
                    @include('partials.municipality-reports')
                </div>

                <!-- 駆除依頼 -->
                <div x-show="activeTab === 'hunting'" x-cloak>
                    @include('partials.municipality-hunting')
                </div>

                <!-- チャット -->
                <div x-show="activeTab === 'chat'" x-cloak>
                    @include('partials.municipality-chat')
                </div>

                <!-- マップ -->
                <div x-show="activeTab === 'map'" x-cloak>
                    @include('partials.municipality-map')
                </div>
            </div>
        </div>
    </main>

    <style>
        [x-cloak] { display: none !important; }
    </style>

    <script>
        function municipalityApp() {
            return {
                activeTab: 'reports',
                
                // 通報関連
                reports: [
                    {
                        id: 'R001',
                        reporterName: '山田太郎',
                        reporterContact: '090-1234-5678',
                        location: '○○町△△地区 山林付近',
                        latitude: 35.6895,
                        longitude: 139.6917,
                        datetime: '2024-12-23 06:30',
                        description: '朝の散歩中に体長1.5m程度の熊を目撃しました。人を見て山の方へ逃げて行きました。',
                        urgency: 'high',
                        status: 'pending',
                        createdAt: '2024-12-23 06:45'
                    },
                    {
                        id: 'R002',
                        reporterName: '佐藤花子',
                        reporterContact: '080-9876-5432',
                        location: '××地区 国道123号線沿い',
                        latitude: 35.6912,
                        longitude: 139.6945,
                        datetime: '2024-12-22 18:20',
                        description: 'ゴミ集積所が荒らされており、熊の足跡を確認しました。',
                        urgency: 'medium',
                        status: 'confirmed',
                        createdAt: '2024-12-22 18:35'
                    },
                    {
                        id: 'R003',
                        reporterName: '鈴木一郎',
                        reporterContact: '090-1111-2222',
                        location: '△△町□□地区 農地',
                        latitude: 35.6850,
                        longitude: 139.6880,
                        datetime: '2024-12-21 15:45',
                        description: '畑のトウモロコシが食い荒らされていました。熊の可能性が高いです。',
                        urgency: 'low',
                        status: 'in-progress',
                        createdAt: '2024-12-21 16:00'
                    }
                ],
                selectedReport: null,
                filterReportStatus: 'all',

                // 駆除依頼関連
                huntingRequests: [
                    {
                        id: 'HR001',
                        reportId: 'R001',
                        hunterGroup: '○○地区猟友会',
                        targetLocation: '○○町△△地区 山林付近',
                        latitude: 35.6895,
                        longitude: 139.6917,
                        urgency: 'high',
                        requestedDate: '2024-12-23',
                        description: '体長1.5m程度の熊の目撃情報に基づく駆除依頼。住宅地に近いため早急な対応が必要です。',
                        status: 'sent',
                        createdAt: '2024-12-23 07:00'
                    },
                    {
                        id: 'HR002',
                        reportId: 'R003',
                        hunterGroup: '△△地区猟友会',
                        targetLocation: '△△町□□地区 農地',
                        latitude: 35.6850,
                        longitude: 139.6880,
                        urgency: 'medium',
                        requestedDate: '2024-12-22',
                        description: '農作物被害の調査および必要に応じた駆除の依頼。',
                        status: 'accepted',
                        createdAt: '2024-12-21 16:30',
                        acceptedAt: '2024-12-22 08:00'
                    }
                ],
                selectedRequest: null,
                showCreateRequestForm: false,
                filterRequestStatus: 'all',

                // チャット関連
                chatThreads: [
                    {
                        id: 'T001',
                        title: '山田太郎さん - 通報R001',
                        participants: ['山田太郎 (住民)', '自治体担当'],
                        lastMessage: 'ありがとうございます。安心しました。',
                        lastMessageTime: '2024-12-23 08:15',
                        unreadCount: 0
                    },
                    {
                        id: 'T002',
                        title: '○○地区猟友会 - 依頼HR001',
                        participants: ['○○地区猟友会', '自治体担当'],
                        lastMessage: '本日午後より現地調査を開始します。',
                        lastMessageTime: '2024-12-23 09:30',
                        unreadCount: 2
                    }
                ],
                selectedThread: null,
                chatMessages: {
                    'T001': [
                        { id: 'M001', sender: '山田太郎', senderType: 'resident', message: '今朝、熊を目撃しました。とても怖かったです。', timestamp: '2024-12-23 06:50' },
                        { id: 'M002', sender: '自治体担当', senderType: 'municipality', message: '通報ありがとうございます。詳細を確認させていただきました。猟友会に駆除依頼を出す手配を進めております。', timestamp: '2024-12-23 07:30' },
                        { id: 'M003', sender: '山田太郎', senderType: 'resident', message: 'ありがとうございます。安心しました。', timestamp: '2024-12-23 08:15' }
                    ],
                    'T002': [
                        { id: 'M004', sender: '自治体担当', senderType: 'municipality', message: '○○地区で熊の目撃情報がありました。現地確認と必要に応じた駆除をお願いします。', timestamp: '2024-12-23 07:00' },
                        { id: 'M005', sender: '○○地区猟友会', senderType: 'hunter', message: '了解しました。メンバーに連絡を取り、体制を整えます。', timestamp: '2024-12-23 07:45' },
                        { id: 'M006', sender: '○○地区猟友会', senderType: 'hunter', message: '本日午後より現地調査を開始します。', timestamp: '2024-12-23 09:30' }
                    ]
                },
                newMessage: '',

                // マップ関連
                mapMarkers: [
                    { id: 'R001', type: 'report', title: '熊目撃通報', location: '○○町△△地区 山林付近', latitude: 35.6895, longitude: 139.6917, status: '未確認', urgency: '高', date: '2024-12-23 06:30' },
                    { id: 'R002', type: 'report', title: 'ゴミ集積所荒らし', location: '××地区 国道123号線沿い', latitude: 35.6912, longitude: 139.6945, status: '確認済', urgency: '中', date: '2024-12-22 18:20' },
                    { id: 'HR001', type: 'hunting', title: '駆除依頼エリア', location: '○○町△△地区 山林付近', latitude: 35.6895, longitude: 139.6917, status: '送信済', urgency: '高', date: '2024-12-23' }
                ],
                filterMapType: 'all',
                selectedMarker: null,

                // メソッド
                getStatusConfig(status) {
                    const configs = {
                        'pending': { label: '未確認', color: 'bg-yellow-100 text-yellow-800 border-yellow-300' },
                        'confirmed': { label: '確認済', color: 'bg-blue-100 text-blue-800 border-blue-300' },
                        'in-progress': { label: '対応中', color: 'bg-purple-100 text-purple-800 border-purple-300' },
                        'completed': { label: '対応完了', color: 'bg-green-100 text-green-800 border-green-300' },
                        'false-alarm': { label: '誤報', color: 'bg-gray-100 text-gray-800 border-gray-300' },
                        'draft': { label: '下書き', color: 'bg-gray-100 text-gray-800 border-gray-300' },
                        'sent': { label: '送信済', color: 'bg-blue-100 text-blue-800 border-blue-300' },
                        'accepted': { label: '受理', color: 'bg-purple-100 text-purple-800 border-purple-300' },
                        'rejected': { label: '却下', color: 'bg-red-100 text-red-800 border-red-300' }
                    };
                    return configs[status] || { label: status, color: 'bg-gray-100 text-gray-800' };
                },

                getUrgencyConfig(urgency) {
                    const configs = {
                        'low': { label: '低', color: 'bg-gray-100 text-gray-800' },
                        'medium': { label: '中', color: 'bg-yellow-100 text-yellow-800' },
                        'high': { label: '高', color: 'bg-orange-100 text-orange-800' },
                        'critical': { label: '緊急', color: 'bg-red-100 text-red-800' }
                    };
                    return configs[urgency] || { label: urgency, color: 'bg-gray-100 text-gray-800' };
                },

                get filteredReports() {
                    return this.filterReportStatus === 'all' 
                        ? this.reports 
                        : this.reports.filter(r => r.status === this.filterReportStatus);
                },

                get filteredRequests() {
                    return this.filterRequestStatus === 'all'
                        ? this.huntingRequests
                        : this.huntingRequests.filter(r => r.status === this.filterRequestStatus);
                },

                get filteredMarkers() {
                    return this.filterMapType === 'all'
                        ? this.mapMarkers
                        : this.mapMarkers.filter(m => m.type === this.filterMapType);
                },

                selectReport(report) {
                    this.selectedReport = report;
                },

                updateReportStatus(reportId, newStatus) {
                    const report = this.reports.find(r => r.id === reportId);
                    if (report) {
                        report.status = newStatus;
                    }
                },

                sendChatMessage() {
                    if (!this.selectedThread || !this.newMessage.trim()) return;
                    
                    if (!this.chatMessages[this.selectedThread.id]) {
                        this.chatMessages[this.selectedThread.id] = [];
                    }
                    
                    this.chatMessages[this.selectedThread.id].push({
                        id: 'M' + Date.now(),
                        sender: '自治体担当',
                        senderType: 'municipality',
                        message: this.newMessage,
                        timestamp: new Date().toLocaleString('ja-JP')
                    });
                    
                    this.newMessage = '';
                }
            }
        }
    </script>
</body>
</html>
