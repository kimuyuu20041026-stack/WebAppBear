<div>
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-bold text-gray-900">出没・依頼マップ</h2>
        <div class="flex gap-2">
            <button @click="filterMapType = 'all'" :class="filterMapType === 'all' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'" class="px-4 py-2 rounded-lg transition-colors">
                すべて
            </button>
            <button @click="filterMapType = 'report'" :class="filterMapType === 'report' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'" class="px-4 py-2 rounded-lg transition-colors">
                通報のみ
            </button>
            <button @click="filterMapType = 'hunting'" :class="filterMapType === 'hunting' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'" class="px-4 py-2 rounded-lg transition-colors">
                駆除依頼のみ
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- 地図エリア -->
        <div class="lg:col-span-2">
            <div class="bg-gray-100 rounded-lg p-8 h-[600px] relative">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="text-center text-gray-600">
                        <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <p class="font-medium mb-2">地図表示エリア</p>
                        <p class="text-sm">マーカークリックで詳細を表示</p>
                    </div>
                </div>

                <!-- マーカー表示のシミュレーション -->
                <div class="relative h-full">
                    <template x-for="(marker, index) in filteredMarkers" :key="marker.id">
                        <button @click="selectedMarker = marker" :class="marker.type === 'report' ? 'text-red-600' : 'text-blue-600'" class="absolute hover:scale-125 transition-transform" :style="`top: ${20 + (index * 15) % 60}%; left: ${15 + (index * 20) % 60}%`">
                            <svg class="w-8 h-8 drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <template x-if="marker.type === 'report'">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </template>
                                <template x-if="marker.type === 'hunting'">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </template>
                            </svg>
                        </button>
                    </template>
                </div>
            </div>

            <!-- 凡例 -->
            <div class="mt-4 flex gap-4 text-sm">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <span class="font-medium">通報地点</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    <span class="font-medium">駆除依頼地点</span>
                </div>
            </div>
        </div>

        <!-- マーカー一覧 -->
        <div class="border border-gray-200 rounded-lg overflow-hidden">
            <div class="bg-green-600 text-white p-4">
                <h3 class="font-bold">マーカー一覧</h3>
                <p class="text-xs text-green-100 mt-1" x-text="filteredMarkers.length + '件'"></p>
            </div>
            <div class="overflow-y-auto h-[calc(600px-60px)]">
                <template x-for="marker in filteredMarkers" :key="marker.id">
                    <button @click="selectedMarker = marker" :class="selectedMarker?.id === marker.id ? 'bg-green-50' : ''" class="w-full p-4 border-b border-gray-200 text-left hover:bg-gray-50 transition-colors">
                        <div class="flex items-start gap-3">
                            <svg :class="marker.type === 'report' ? 'text-red-600' : 'text-blue-600'" class="w-5 h-5 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <template x-if="marker.type === 'report'">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </template>
                                <template x-if="marker.type === 'hunting'">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </template>
                            </svg>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-sm font-medium text-gray-900" x-text="marker.id"></span>
                                    <span class="text-xs px-2 py-0.5 bg-gray-100 text-gray-700 rounded" x-text="marker.type === 'report' ? '通報' : '駆除'"></span>
                                </div>
                                <p class="text-sm text-gray-700 mb-1" x-text="marker.title"></p>
                                <p class="text-xs text-gray-600 mb-1" x-text="marker.location"></p>
                                <div class="flex gap-2 text-xs text-gray-500">
                                    <span x-text="'緊急度: ' + marker.urgency"></span>
                                    <span>•</span>
                                    <span x-text="marker.status"></span>
                                </div>
                            </div>
                        </div>
                    </button>
                </template>
            </div>
        </div>
    </div>

    <!-- 選択中のマーカー詳細（モーダル） -->
    <template x-if="selectedMarker">
        <div x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-green-200 bg-opacity-40 flex items-center justify-center p-4 z-50" @click.self="selectedMarker = null">
            <div x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="bg-white rounded-lg p-6 max-w-md w-full shadow-xl">
                <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg :class="selectedMarker.type === 'report' ? 'text-red-600' : 'text-blue-600'" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <template x-if="selectedMarker.type === 'report'">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </template>
                        <template x-if="selectedMarker.type === 'hunting'">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </template>
                    </svg>
                    <span x-text="selectedMarker.title"></span>
                </h3>
                <div class="space-y-3 mb-6">
                    <div>
                        <span class="text-sm text-gray-600">ID:</span>
                        <span class="ml-2 text-sm font-medium text-gray-900" x-text="selectedMarker.id"></span>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">場所:</span>
                        <span class="ml-2 text-sm text-gray-900" x-text="selectedMarker.location"></span>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">座標:</span>
                        <span class="ml-2 text-sm text-gray-900" x-text="selectedMarker.latitude + ', ' + selectedMarker.longitude"></span>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">ステータス:</span>
                        <span class="ml-2 text-sm text-gray-900" x-text="selectedMarker.status"></span>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">緊急度:</span>
                        <span class="ml-2 text-sm text-gray-900" x-text="selectedMarker.urgency"></span>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">日時:</span>
                        <span class="ml-2 text-sm text-gray-900" x-text="selectedMarker.date"></span>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button @click="selectedMarker = null" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        閉じる
                    </button>
                    <button class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        詳細を見る
                    </button>
                </div>
            </div>
        </div>
    </template>
</div>