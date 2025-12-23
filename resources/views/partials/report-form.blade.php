<div class="max-w-2xl mx-auto">
    <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-400 rounded">
        <div class="flex items-start gap-3">
            <svg class="w-6 h-6 text-green-500 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <div>
                <h2 class="text-lg font-semibold text-green-900 mb-1">熊の目撃情報を通報</h2>
                <p class="text-green-800 text-sm">
                    熊を目撃した場合は、速やかに安全な場所に避難してから通報してください。
                </p>
            </div>
        </div>
    </div>

    <form action="{{ route('bear.report.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <!-- 目撃個体数 -->
        <div>
            <label class="block mb-2 text-gray-700 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span class="font-medium">目撃個体数</span>
            </label>
            <input type="number" name="number" min="1" required
                   value="{{ old('number') }}"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400 focus:border-transparent"
                   placeholder="例: 1">
            @error('number')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- 場所 -->
        <div>
            <label class="block mb-2 text-gray-700 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="font-medium">場所</span>
            </label>
            <input type="text" name="place" required
                   value="{{ old('place') }}"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400 focus:border-transparent"
                   placeholder="例: 〇〇町△△地区、××公園付近">
            @error('place')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- 時間 -->
        <div>
            <label class="block mb-2 text-gray-700 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">目撃時刻</span>
            </label>
            <input type="datetime-local" name="sighting_time"
                   value="{{ old('sighting_time') }}"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400 focus:border-transparent">
            <p class="mt-1 text-sm text-gray-500">
                空欄の場合は現在時刻が記録されます
            </p>
            @error('sighting_time')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- 状況 -->
        <div>
            <label class="block mb-2 text-gray-700 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span class="font-medium">状況の詳細</span>
            </label>
            <textarea name="text" required rows="5"
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400 focus:border-transparent resize-none"
                      placeholder="例: 成獣1頭が北方向に移動していった。体長は約1.5m。攻撃的な様子はなし。">{{ old('text') }}</textarea>
            @error('text')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- 送信ボタン -->
        <button type="submit"
                class="w-full bg-green-400 hover:bg-green-500 text-white font-semibold py-4 rounded-lg transition-colors flex items-center justify-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
            </svg>
            通報を送信
        </button>
    </form>
</div>
