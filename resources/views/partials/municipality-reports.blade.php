<div>
    <!-- 通報一覧表示 -->
    <template x-if="!selectedReport">
        <div>
            <div class="mb-6 flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-900">住民からの通報一覧</h2>
                <div class="flex gap-2">
                    <select x-model="filterReportStatus" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="all">すべて</option>
                        <option value="pending">未確認</option>
                        <option value="confirmed">確認済</option>
                        <option value="in-progress">対応中</option>
                        <option value="completed">対応完了</option>
                        <option value="false-alarm">誤報</option>
                    </select>
                </div>
            </div>

            <div class="space-y-4">
                <template x-for="report in filteredReports" :key="report.id">
                    <div @click="selectReport(report)" class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow cursor-pointer">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-start gap-3 flex-1">
                                <div class="mt-1">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="font-medium text-gray-900" x-text="'通報ID: ' + report.id"></span>
                                        <span class="px-2 py-1 rounded text-xs" :class="getUrgencyConfig(report.urgency).color" x-text="'緊急度: ' + getUrgencyConfig(report.urgency).label"></span>
                                        <span class="px-2 py-1 rounded text-xs border" :class="getStatusConfig(report.status).color" x-text="getStatusConfig(report.status).label"></span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2 text-sm mb-2">
                                        <div>
                                            <span class="text-gray-600">通報者:</span>
                                            <span class="ml-2 text-gray-900" x-text="report.reporterName"></span>
                                        </div>
                                        <div>
                                            <span class="text-gray-600">目撃日時:</span>
                                            <span class="ml-2 text-gray-900" x-text="report.datetime"></span>
                                        </div>
                                        <div class="col-span-2">
                                            <span class="text-gray-600">場所:</span>
                                            <span class="ml-2 text-gray-900" x-text="report.location"></span>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-700 line-clamp-2" x-text="report.description"></p>
                                </div>
                            </div>
                            <button class="ml-4 p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="text-xs text-gray-500 mt-2" x-text="'通報受付: ' + report.createdAt"></div>
                    </div>
                </template>

                <template x-if="filteredReports.length === 0">
                    <div class="text-center py-12 text-gray-500">
                        該当する通報がありません
                    </div>
                </template>
            </div>
        </div>
    </template>

    <!-- 通報詳細表示 -->
    <template x-if="selectedReport">
        <div>
            <div class="mb-6 flex items-center justify-between">
                <button @click="selectedReport = null" class="flex items-center gap-2 text-green-600 hover:text-green-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>一覧に戻る</span>
                </button>
            </div>

            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4" x-text="'通報詳細 - ' + selectedReport.id"></h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- 基本情報 -->
                    <div class="space-y-4">
                        <div class="bg-white rounded-lg p-4">
                            <h3 class="font-bold text-gray-900 mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                通報者情報
                            </h3>
                            <div class="space-y-2 text-sm">
                                <div>
                                    <span class="text-gray-600">氏名:</span>
                                    <span class="ml-2 text-gray-900" x-text="selectedReport.reporterName"></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <span class="text-gray-900" x-text="selectedReport.reporterContact"></span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg p-4">
                            <h3 class="font-bold text-gray-900 mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                目撃情報
                            </h3>
                            <div class="space-y-2 text-sm">
                                <div>
                                    <span class="text-gray-600">場所:</span>
                                    <span class="ml-2 text-gray-900" x-text="selectedReport.location"></span>
                                </div>
                                <div>
                                    <span class="text-gray-600">座標:</span>
                                    <span class="ml-2 text-gray-900" x-text="selectedReport.latitude + ', ' + selectedReport.longitude"></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-gray-900" x-text="selectedReport.datetime"></span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg p-4">
                            <h3 class="font-bold text-gray-900 mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                ステータス管理
                            </h3>
                            <select @change="updateReportStatus(selectedReport.id, $event.target.value)" :value="selectedReport.status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                                <option value="pending">未確認</option>
                                <option value="confirmed">確認済</option>
                                <option value="in-progress">対応中</option>
                                <option value="completed">対応完了</option>
                                <option value="false-alarm">誤報</option>
                            </select>
                        </div>
                    </div>

                    <!-- 詳細内容 -->
                    <div class="space-y-4">
                        <div class="bg-white rounded-lg p-4">
                            <h3 class="font-bold text-gray-900 mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                詳細説明
                            </h3>
                            <p class="text-sm text-gray-700 whitespace-pre-wrap" x-text="selectedReport.description"></p>
                        </div>

                        <div class="bg-white rounded-lg p-4">
                            <h3 class="font-bold text-gray-900 mb-3">位置情報</h3>
                            <div class="bg-gray-200 rounded-lg h-48 flex items-center justify-center">
                                <div class="text-center text-gray-600">
                                    <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <p class="text-sm">地図表示エリア</p>
                                    <p class="text-xs mt-1" x-text="selectedReport.latitude + ', ' + selectedReport.longitude"></p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg p-4">
                            <h3 class="font-bold text-gray-900 mb-3">アクション</h3>
                            <div class="space-y-2">
                                <button class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                    猟友会に駆除依頼を作成
                                </button>
                                <button class="w-full px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                    通報者に連絡
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
