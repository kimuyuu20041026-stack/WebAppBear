<div class="space-y-8">
    <!-- 対応中 -->
    <div>
        <div class="flex items-center gap-2 mb-4">
            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h2 class="text-xl font-semibold text-gray-900">対応中の通報</h2>
            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">
                {{ count($pendingReports ?? []) }}件
            </span>
        </div>

        @forelse(($pendingReports ?? []) as $report)
            <div class="space-y-3">
                <div class="p-5 bg-green-100 border-l-4 border-green-400 rounded-lg">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            <h3 class="font-semibold text-gray-900">{{ $report->place }}</h3>
                        </div>
                        <span class="bg-green-400 text-white px-3 py-1 rounded-full text-sm font-medium">
                            対応中
                        </span>
                    </div>

                    <p class="text-gray-700 mb-3">{{ $report->text }}</p>

                    <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            </svg>
                            <span>目撃数: {{ $report->number }}頭</span>
                        </div>
                        <div class="flex items-center gap-1">
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
                対応中の通報はありません
            </div>
        @endforelse
    </div>

    <!-- 完了 -->
    <div>
        <div class="flex items-center gap-2 mb-4">
            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h2 class="text-xl font-semibold text-gray-900">完了した通報</h2>
            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">
                {{ count($completedReports ?? []) }}件
            </span>
        </div>

        @forelse(($completedReports ?? []) as $report)
            <div class="space-y-3">
                <div class="p-5 bg-white border border-gray-200 rounded-lg">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            </svg>
                            <h3 class="font-semibold text-gray-900">{{ $report->place }}</h3>
                        </div>
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            完了
                        </span>
                    </div>

                    <p class="text-gray-700 mb-3">{{ $report->text }}</p>

                    <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            </svg>
                            <span>目撃数: {{ $report->number }}頭</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>通報: {{ $report->created_at->format('Y年m月d日 H:i') }}</span>
                        </div>
                        @if($report->updated_at && $report->updated_at != $report->created_at)
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>完了: {{ $report->updated_at->format('Y年m月d日 H:i') }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="p-8 bg-gray-50 rounded-lg text-center text-gray-500">
                完了した通報はありません
            </div>
        @endforelse
    </div>
</div>
