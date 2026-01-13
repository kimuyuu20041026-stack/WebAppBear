<div class="grid grid-cols-1 md:grid-cols-3 gap-4 h-[600px]">
    <!-- スレッド一覧 -->
    <div class="border border-gray-200 rounded-lg overflow-hidden">
        <div class="bg-green-600 text-white p-4">
            <h3 class="font-bold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span>チャット一覧</span>
            </h3>
        </div>
        <div class="overflow-y-auto h-[calc(100%-60px)]">
            <template x-for="thread in chatThreads" :key="thread.id">
                <button @click="selectedThread = thread" :class="selectedThread?.id === thread.id ? 'bg-green-50' : ''" class="w-full p-4 border-b border-gray-200 text-left hover:bg-gray-50 transition-colors">
                    <div class="flex items-start justify-between mb-2">
                        <span class="text-sm font-medium text-gray-900" x-text="thread.title"></span>
                        <template x-if="thread.unreadCount > 0">
                            <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full" x-text="thread.unreadCount"></span>
                        </template>
                    </div>
                    <p class="text-xs text-gray-600 line-clamp-1 mb-1" x-text="thread.lastMessage"></p>
                    <p class="text-xs text-gray-500" x-text="thread.lastMessageTime"></p>
                </button>
            </template>
        </div>
    </div>

    <!-- メッセージエリア -->
    <div class="md:col-span-2 border border-gray-200 rounded-lg overflow-hidden flex flex-col">
        <template x-if="selectedThread">
            <div class="flex flex-col h-full">
                <div class="bg-green-600 text-white p-4">
                    <h3 class="font-bold mb-1" x-text="selectedThread.title"></h3>
                    <p class="text-xs text-green-100" x-text="selectedThread.participants.join(' • ')"></p>
                </div>

                <div class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50">
                    <template x-for="message in chatMessages[selectedThread.id] || []" :key="message.id">
                        <div :class="message.senderType === 'municipality' ? 'flex justify-end' : 'flex justify-start'">
                            <div :class="{
                                'bg-green-600 text-white': message.senderType === 'municipality',
                                'bg-blue-100 text-gray-900': message.senderType === 'hunter',
                                'bg-white text-gray-900': message.senderType === 'resident'
                            }" class="max-w-[70%] rounded-lg p-3 shadow-sm">
                                <div class="flex items-center gap-2 mb-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span class="text-xs opacity-80" x-text="message.sender"></span>
                                </div>
                                <p class="text-sm mb-1" x-text="message.message"></p>
                                <p class="text-xs opacity-70 text-right" x-text="message.timestamp"></p>
                            </div>
                        </div>
                    </template>
                </div>

                <div class="border-t border-gray-200 p-4 bg-white">
                    <div class="flex gap-2">
                        <input type="text" x-model="newMessage" @keyup.enter="sendChatMessage()" placeholder="メッセージを入力..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        <button @click="sendChatMessage()" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            <span>送信</span>
                        </button>
                    </div>
                </div>
            </div>
        </template>

        <template x-if="!selectedThread">
            <div class="flex items-center justify-center h-full text-gray-500">
                チャットを選択してください
            </div>
        </template>
    </div>
</div>
