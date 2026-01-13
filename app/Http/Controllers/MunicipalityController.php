<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MunicipalityController extends Controller
{
    public function index()
    {
        // サンプルデータ（実際はデータベースから取得）
        $reports = [
            [
                'id' => 'R001',
                'reporterName' => '山田太郎',
                'reporterContact' => '090-1234-5678',
                'location' => '○○町△△地区 山林付近',
                'latitude' => 35.6895,
                'longitude' => 139.6917,
                'datetime' => '2024-12-23 06:30',
                'description' => '朝の散歩中に体長1.5m程度の熊を目撃しました。人を見て山の方へ逃げて行きました。',
                'urgency' => 'high',
                'status' => 'pending',
                'createdAt' => '2024-12-23 06:45'
            ],
            [
                'id' => 'R002',
                'reporterName' => '佐藤花子',
                'reporterContact' => '080-9876-5432',
                'location' => '××地区 国道123号線沿い',
                'latitude' => 35.6912,
                'longitude' => 139.6945,
                'datetime' => '2024-12-22 18:20',
                'description' => 'ゴミ集積所が荒らされており、熊の足跡を確認しました。',
                'urgency' => 'medium',
                'status' => 'confirmed',
                'createdAt' => '2024-12-22 18:35'
            ],
            [
                'id' => 'R003',
                'reporterName' => '鈴木一郎',
                'reporterContact' => '090-1111-2222',
                'location' => '△△町□□地区 農地',
                'latitude' => 35.6850,
                'longitude' => 139.6880,
                'datetime' => '2024-12-21 15:45',
                'description' => '畑のトウモロコシが食い荒らされていました。熊の可能性が高いです。',
                'urgency' => 'low',
                'status' => 'in-progress',
                'createdAt' => '2024-12-21 16:00'
            ]
        ];

        $huntingRequests = [
            [
                'id' => 'HR001',
                'reportId' => 'R001',
                'hunterGroup' => '○○地区猟友会',
                'targetLocation' => '○○町△△地区 山林付近',
                'latitude' => 35.6895,
                'longitude' => 139.6917,
                'urgency' => 'high',
                'requestedDate' => '2024-12-23',
                'description' => '体長1.5m程度の熊の目撃情報に基づく駆除依頼。住宅地に近いため早急な対応が必要です。',
                'status' => 'sent',
                'createdAt' => '2024-12-23 07:00'
            ],
            [
                'id' => 'HR002',
                'reportId' => 'R003',
                'hunterGroup' => '△△地区猟友会',
                'targetLocation' => '△△町□□地区 農地',
                'latitude' => 35.6850,
                'longitude' => 139.6880,
                'urgency' => 'medium',
                'requestedDate' => '2024-12-22',
                'description' => '農作物被害の調査および必要に応じた駆除の依頼。',
                'status' => 'accepted',
                'createdAt' => '2024-12-21 16:30',
                'acceptedAt' => '2024-12-22 08:00'
            ]
        ];

        $chatThreads = [
            [
                'id' => 'T001',
                'title' => '山田太郎さん - 通報R001',
                'participants' => ['山田太郎 (住民)', '自治体担当'],
                'lastMessage' => 'ありがとうございます。安心しました。',
                'lastMessageTime' => '2024-12-23 08:15',
                'unreadCount' => 0
            ],
            [
                'id' => 'T002',
                'title' => '○○地区猟友会 - 依頼HR001',
                'participants' => ['○○地区猟友会', '自治体担当'],
                'lastMessage' => '本日午後より現地調査を開始します。',
                'lastMessageTime' => '2024-12-23 09:30',
                'unreadCount' => 2
            ]
        ];

        $chatMessages = [
            'T001' => [
                ['id' => 'M001', 'sender' => '山田太郎', 'senderType' => 'resident', 'message' => '今朝、熊を目撃しました。とても怖かったです。', 'timestamp' => '2024-12-23 06:50'],
                ['id' => 'M002', 'sender' => '自治体担当', 'senderType' => 'municipality', 'message' => '通報ありがとうございます。詳細を確認させていただきました。猟友会に駆除依頼を出す手配を進めております。', 'timestamp' => '2024-12-23 07:30'],
                ['id' => 'M003', 'sender' => '山田太郎', 'senderType' => 'resident', 'message' => 'ありがとうございます。安心しました。', 'timestamp' => '2024-12-23 08:15']
            ],
            'T002' => [
                ['id' => 'M004', 'sender' => '自治体担当', 'senderType' => 'municipality', 'message' => '○○地区で熊の目撃情報がありました。現地確認と必要に応じた駆除をお願いします。', 'timestamp' => '2024-12-23 07:00'],
                ['id' => 'M005', 'sender' => '○○地区猟友会', 'senderType' => 'hunter', 'message' => '了解しました。メンバーに連絡を取り、体制を整えます。', 'timestamp' => '2024-12-23 07:45'],
                ['id' => 'M006', 'sender' => '○○地区猟友会', 'senderType' => 'hunter', 'message' => '本日午後より現地調査を開始します。', 'timestamp' => '2024-12-23 09:30']
            ]
        ];

        $mapMarkers = [
            ['id' => 'R001', 'type' => 'report', 'title' => '熊目撃通報', 'location' => '○○町△△地区 山林付近', 'latitude' => 35.6895, 'longitude' => 139.6917, 'status' => '未確認', 'urgency' => '高', 'date' => '2024-12-23 06:30'],
            ['id' => 'R002', 'type' => 'report', 'title' => 'ゴミ集積所荒らし', 'location' => '××地区 国道123号線沿い', 'latitude' => 35.6912, 'longitude' => 139.6945, 'status' => '確認済', 'urgency' => '中', 'date' => '2024-12-22 18:20'],
            ['id' => 'HR001', 'type' => 'hunting', 'title' => '駆除依頼エリア', 'location' => '○○町△△地区 山林付近', 'latitude' => 35.6895, 'longitude' => 139.6917, 'status' => '送信済', 'urgency' => '高', 'date' => '2024-12-23']
        ];

        return view('municipality', compact('reports', 'huntingRequests', 'chatThreads', 'chatMessages', 'mapMarkers'));
    }

    public function updateReportStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,in-progress,completed,false-alarm'
        ]);

        // ここでデータベースを更新
        // Report::where('id', $id)->update(['status' => $validated['status']]);

        return response()->json(['success' => true, 'message' => 'ステータスを更新しました']);
    }

    public function storeHuntingRequest(Request $request)
    {
        $validated = $request->validate([
            'reportId' => 'required|string',
            'hunterGroup' => 'required|string',
            'urgency' => 'required|in:low,medium,high,critical',
            'requestedDate' => 'required|date',
            'targetLocation' => 'required|string',
            'description' => 'required|string'
        ]);

        // ここでデータベースに保存
        // HuntingRequest::create($validated);

        return response()->json(['success' => true, 'message' => '駆除依頼を作成しました']);
    }

    public function sendMessage(Request $request, $threadId)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        // ここでデータベースに保存
        // ChatMessage::create([
        //     'thread_id' => $threadId,
        //     'sender' => '自治体担当',
        //     'sender_type' => 'municipality',
        //     'message' => $validated['message'],
        //     'timestamp' => now()
        // ]);

        return response()->json([
            'success' => true, 
            'message' => [
                'id' => 'M' . time(),
                'sender' => '自治体担当',
                'senderType' => 'municipality',
                'message' => $validated['message'],
                'timestamp' => now()->format('Y-m-d H:i')
            ]
        ]);
    }
}
