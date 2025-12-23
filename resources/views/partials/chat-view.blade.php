<div class="flex flex-col h-[600px]" x-data="{ inputText: '' }">
    <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-400 rounded">
        <p class="text-green-900 text-sm">
            自治体職員とのチャット。通報に関する質問や追加情報の共有ができます。
        </p>
    </div>

    <!-- メッセージエリア -->
    <div class="flex-1 overflow-y-auto p-4 bg-gray-50 rounded-lg border border-gray-200 mb-4 space-y-4">
        @forelse(($messages ?? []) as $message)
            <div class="flex {{ $message->sender_type === 'resident' ? 'justify-end' : 'justify-start' }}">
                <div class="flex gap-3 max-w-[70%] {{ $message->sender_type === 'resident' ? 'flex-row-reverse' : 'flex-row' }}">
                    <!-- アバター -->
                    <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 {{ $message->sender_type === 'resident' ? 'bg-green-400 text-white' : 'bg-blue-400 text-white' }}">
                        @if($message->sender_type === 'resident')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        @endif
                    </div>

                    <!-- メッセージバブル -->
                    <div>
                        <div class="p-3 rounded-lg {{ $message->sender_type === 'resident' ? 'bg-green-400 text-white' : 'bg-white text-gray-900 border border-gray-200' }}">
                            <p>{{ $message->message }}</p>
                        </div>
                        <p class="text-xs text-gray-500 mt-1 px-1">
                            {{ $message->created_at->format('H:i') }}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500 py-8">
                メッセージはまだありません
            </div>
        @endforelse
    </div>

    <!-- 入力エリア -->
    <form action="{{ route('bear.chat.send') }}" method="POST" class="flex gap-2">
        @csrf
        <input type="text" name="message" x-model="inputText" required
               placeholder="メッセージを入力..."
               class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400 focus:border-transparent">
        <button type="submit"
                class="bg-green-400 hover:bg-green-500 text-white font-semibold px-6 py-3 rounded-lg transition-colors flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
            </svg>
            送信
        </button>
    </form>
</div>
