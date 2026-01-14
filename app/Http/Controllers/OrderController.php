<?php
namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = $orders ?? [];
        $chatThreads = $chatThreads ?? [];
        $chatMessages = $chatMessages ?? [];

    $appData = [
        'orders' => $orders,
        'chatThreads' => $chatThreads,
        'chatMessages' => $chatMessages,
    ];

    return view('order', compact('appData'));

        // $orders = $orders ?? [];
        // $chatThreads = $chatThreads ?? [];
        // $chatMessages = $chatMessages ?? [];
        // // 駆除依頼（ダミー）
        // $orders = [
        //     [
        //         'id' => 1,
        //         'user_id' => 1,
        //         'number' => 2,
        //         'place' => '○○町△△地区 山林付近',
        //         'text' => '朝の散歩中に体長1.5m程度の熊2頭を目撃。',
        //         'money' => 50000,
        //         'created_at' => '2024-12-23 06:30:00',
        //         'updated_at' => '2024-12-23 06:30:00',
        //         'check' => 0,
        //         'latitude' => 35.6895,
        //         'longitude' => 139.6917,
        //         'urgency' => 'high',
        //         'status' => 'pending',
        //         'municipality' => '○○市自治体',
        //     ],
        //     [
        //         'id' => 2,
        //         'user_id' => 1,
        //         'number' => 1,
        //         'place' => '××地区 国道123号線沿い',
        //         'text' => 'ゴミ集積所が荒らされていました。',
        //         'money' => 30000,
        //         'created_at' => '2024-12-22 18:20:00',
        //         'updated_at' => '2024-12-22 18:20:00',
        //         'check' => 0,
        //         'latitude' => 35.6912,
        //         'longitude' => 139.6945,
        //         'urgency' => 'medium',
        //         'status' => 'accepted',
        //         'municipality' => '○○市自治体',
        //     ],
        // ];

        // // チャットスレッド
        // $chatThreads = [
        //     [
        //         'id' => 'T001',
        //         'orderId' => 1,
        //         'title' => '依頼 #1 - ○○町△△地区 山林付近',
        //         'lastMessage' => 'ご確認よろしくお願いいたします。',
        //         'lastMessageTime' => '2024-12-23 10:30',
        //         'unreadCount' => 2,
        //     ],
        // ];

        // // チャットメッセージ
        // $chatMessages = [
        //     'T001' => [
        //         [
        //             'id' => 'M001',
        //             'sender' => '○○市自治体',
        //             'senderType' => 'municipality',
        //             'message' => '熊の目撃情報があります。',
        //             'timestamp' => '2024-12-23 07:00',
        //         ],
        //     ],
        // ];

        // return view('order', compact(
        //     'orders',
        //     'chatThreads',
        //     'chatMessages'
        // ));
    }
}
