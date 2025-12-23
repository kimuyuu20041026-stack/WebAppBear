<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold text-gray-900">熊の出没マップ</h2>
        <div class="flex items-center gap-2 text-sm text-gray-600">
            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <span>過去7日間の通報: {{ count($recentReports ?? []) }}件</span>
        </div>
    </div>

    <!-- 簡易マップ表示 -->
    <div class="relative bg-gradient-to-br from-green-100 to-green-200 rounded-lg h-96 overflow-hidden border-2 border-gray-300">
        <div class="absolute inset-0 flex items-center justify-center text-gray-500">
            <div class="text-center">
                <svg class="w-12 h-12 mx-auto mb-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <p class="font-medium">地図表示エリア</p>
                <p class="text-sm">(実装時にマップライブラリを統合)</p>
            </div>
        </div>

        <!-- マーカー表示のイメージ -->
        @foreach(($recentReports ?? []) as $index => $report)
            <div class="absolute" style="left: {{ 30 + ($index * 25) }}%; top: {{ 40 + ($index * 10) }}%;">
                <div class="relative group cursor-pointer">
                    <div class="bg-red-600 text-white rounded-full p-2 shadow-lg animate-pulse">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <!-- ツールチップ -->
                    <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 hidden group-hover:block w-48 bg-white p-3 rounded-lg shadow-xl border border-gray-200 z-10">
                        <p class="text-sm font-medium mb-1">{{ $report->place }}</p>
                        <p class="text-xs text-gray-600">{{ $report->number }}頭目撃</p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $report->created_at->format('Y/m/d H:i') }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- 通報リスト -->
    <div>
        <h3 class="text-lg font-semibold mb-4 text-gray-900">最近の通報</h3>
        <div class="space-y-3">
            @forelse(($recentReports ?? []) as $report)
                <div class="p-4 bg-white border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                    <div class="flex items-start gap-3">
                        <div class="bg-red-100 p-2 rounded-full">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-start justify-between mb-2">
                                <div>
                                    <h4 class="font-medium text-gray-900">{{ $report->place }}</h4>
                                    <p class="text-sm text-gray-600 mt-1">{{ $report->text }}</p>
                                </div>
                                <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm whitespace-nowrap ml-2">
                                    {{ $report->number }}頭
                                </span>
                            </div>
                            <div class="flex items-center gap-2 text-xs text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ $report->created_at->format('Y年m月d日 H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-8 bg-gray-50 rounded-lg text-center text-gray-500">
                    通報はありません
                </div>
            @endforelse
        </div>
    </div>
</div>
