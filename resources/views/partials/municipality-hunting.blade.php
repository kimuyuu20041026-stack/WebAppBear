<div>
    <!-- 依頼一覧表示 -->
    <template x-if="!selectedRequest && !showCreateRequestForm">
        <div>
            <div class="mb-6 flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-900">駆除依頼管理</h2>
                <div class="flex gap-2">
                    <select x-model="filterRequestStatus" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="all">すべて</option>
                        <option value="draft">下書き</option>
                        <option value="sent">送信済</option>
                        <option value="accepted">受理</option>
                        <option value="in-progress">対応中</option>
                        <option value="completed">完了</option>
                        <option value="rejected">却下</option>
                    </select>
                    <button @click="showCreateRequestForm = true" class="flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>新規依頼作成</span>
                    </button>
                </div>
            </div>

            <div class="space-y-4">
                <template x-for="request in filteredRequests" :key="request.id">
                    <div @click="selectedRequest = request" class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow cursor-pointer">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-start gap-3 flex-1">
                                <div class="mt-1">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="font-medium text-gray-900" x-text="'依頼ID: ' + request.id"></span>
                                        <span class="text-gray-600 text-sm" x-text="'(通報: ' + request.reportId + ')'"></span>
                                        <span class="px-2 py-1 rounded text-xs" :class="getUrgencyConfig(request.urgency).color" x-text="'緊急度: ' + getUrgencyConfig(request.urgency).label"></span>
                                        <span class="px-2 py-1 rounded text-xs border" :class="getStatusConfig(request.status).color" x-text="getStatusConfig(request.status).label"></span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2 text-sm mb-2">
                                        <div>
                                            <span class="text-gray-600">依頼先:</span>
                                            <span class="ml-2 text-gray-900" x-text="request.hunterGroup"></span>
                                        </div>
                                        <div>
                                            <span class="text-gray-600">希望日:</span>
                                            <span class="ml-2 text-gray-900" x-text="request.requestedDate"></span>
                                        </div>
                                        <div class="col-span-2">
                                            <span class="text-gray-600">場所:</span>
                                            <span class="ml-2 text-gray-900" x-text="request.targetLocation"></span>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-700 line-clamp-2" x-text="request.description"></p>
                                </div>
                            </div>
                            <button class="ml-4 p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="text-xs text-gray-500 mt-2 flex gap-4">
                            <span x-text="'作成: ' + request.createdAt"></span>
                            <template x-if="request.acceptedAt">
                                <span x-text="'受理: ' + request.acceptedAt"></span>
                            </template>
                        </div>
                    </div>
                </template>

                <template x-if="filteredRequests.length === 0">
                    <div class="text-center py-12 text-gray-500">
                        該当する駆除依頼がありません
                    </div>
                </template>
            </div>
        </div>
    </template>

    <!-- 依頼詳細表示 -->
    <template x-if="selectedRequest">
        <div>
            <div class="mb-6 flex items-center justify-between">
                <button @click="selectedRequest = null" class="flex items-center gap-2 text-green-600 hover:text-green-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>一覧に戻る</span>
                </button>
            </div>

            <div class="bg-gray-50 rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4" x-text="'駆除依頼詳細 - ' + selectedRequest.id"></h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="bg-white rounded-lg p-4">
                            <h3 class="font-bold text-gray-900 mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                依頼情報
                            </h3>
                            <div class="space-y-2 text-sm">
                                <div>
                                    <span class="text-gray-600">依頼先:</span>
                                    <span class="ml-2 text-gray-900" x-text="selectedRequest.hunterGroup"></span>
                                </div>
                                <div>
                                    <span class="text-gray-600">関連通報:</span>
                                    <span class="ml-2 text-gray-900" x-text="selectedRequest.reportId"></span>
                                </div>
                                <div>
                                    <span class="text-gray-600">希望対応日:</span>
                                    <span class="ml-2 text-gray-900" x-text="selectedRequest.requestedDate"></span>
                                </div>
                                <div>
                                    <span class="text-gray-600">ステータス:</span>
                                    <span class="ml-2" :class="getStatusConfig(selectedRequest.status).color" x-text="getStatusConfig(selectedRequest.status).label"></span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg p-4">
                            <h3 class="font-bold text-gray-900 mb-3">アクション</h3>
                            <div class="space-y-2">
                                <button class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                    猟友会にメッセージを送る
                                </button>
                                <button class="w-full px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                    依頼内容を編集
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="bg-white rounded-lg p-4">
                            <h3 class="font-bold text-gray-900 mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                依頼内容
                            </h3>
                            <p class="text-sm text-gray-700 whitespace-pre-wrap" x-text="selectedRequest.description"></p>
                        </div>

                        <div class="bg-white rounded-lg p-4">
                            <h3 class="font-bold text-gray-900 mb-3">位置情報</h3>
                            <div class="bg-gray-200 rounded-lg h-48 flex items-center justify-center">
                                <div class="text-center text-gray-600">
                                    <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    </svg>
                                    <p class="text-sm">地図表示エリア</p>
                                    <p class="text-xs mt-1" x-text="selectedRequest.latitude + ', ' + selectedRequest.longitude"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <!-- 新規作成フォーム -->
    <template x-if="showCreateRequestForm">
        <div>
            <div class="mb-6 flex items-center justify-between">
                <button @click="showCreateRequestForm = false" class="flex items-center gap-2 text-green-600 hover:text-green-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>戻る</span>
                </button>
            </div>

            <div class="bg-gray-50 rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">新規駆除依頼の作成</h2>

                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                関連通報ID <span class="text-red-500">*</span>
                            </label>
                            <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="R001">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                依頼先猟友会 <span class="text-red-500">*</span>
                            </label>
                            <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                                <option value="">選択してください</option>
                                <option value="○○地区猟友会">○○地区猟友会</option>
                                <option value="△△地区猟友会">△△地区猟友会</option>
                                <option value="××地区猟友会">××地区猟友会</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                緊急度 <span class="text-red-500">*</span>
                            </label>
                            <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                                <option value="low">低</option>
                                <option value="medium" selected>中</option>
                                <option value="high">高</option>
                                <option value="critical">緊急</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                希望対応日 <span class="text-red-500">*</span>
                            </label>
                            <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            対象地域 <span class="text-red-500">*</span>
                        </label>
                        <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="○○町△△地区 山林付近">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            依頼内容 <span class="text-red-500">*</span>
                        </label>
                        <textarea rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="熊の目撃情報、被害状況、対応の要望などを詳しく記載してください"></textarea>
                    </div>

                    <div class="flex gap-4">
                        <button type="button" @click="showCreateRequestForm = false" class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            キャンセル
                        </button>
                        <button type="button" class="flex-1 px-6 py-3 border border-green-600 text-green-600 rounded-lg hover:bg-green-50 transition-colors">
                            下書き保存
                        </button>
                        <button type="submit" class="flex-1 px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            <span>送信する</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>
