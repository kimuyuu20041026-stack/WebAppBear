<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BearReport;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    /**
     * 住民用UI画面を表示
     */
    public function index()
    {
        $user = Auth::user();
        
        // 最近7日間の通報情報
        $recentReports = BearReport::where('created_at', '>=', now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->get();
        
        // ユーザーの通報（対応中）
        $pendingReports = BearReport::where('user_id', $user->id)
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();
        
        // ユーザーの通報（完了）
        $completedReports = BearReport::where('user_id', $user->id)
            ->where('status', 'completed')
            ->orderBy('updated_at', 'desc')
            ->get();
        
        // チャットメッセージ（仮）
        $messages = [];
        
        return view('resident-ui', compact(
            'recentReports',
            'pendingReports',
            'completedReports',
            'messages'
        ));
    }
    
    /**
     * 通報を保存
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'number' => 'required|integer|min:1',
            'place' => 'required|string|max:255',
            'text' => 'required|string',
            'sighting_time' => 'nullable|date',
        ]);
        
        $report = new BearReport();
        $report->user_id = Auth::id();
        $report->number = $validated['number'];
        $report->place = $validated['place'];
        $report->text = $validated['text'];
        $report->status = 'pending';
        
        // 目撃時刻が指定されていない場合は現在時刻
        if (!empty($validated['sighting_time'])) {
            $report->sighting_time = $validated['sighting_time'];
        } else {
            $report->sighting_time = now();
        }
        
        $report->save();
        
        return redirect()->back()->with('success', '通報を受け付けました。自治体職員が確認次第、対応いたします。');
    }
    
    /**
     * チャットメッセージを送信
     */
    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);
        
        // TODO: チャット機能の実装
        // ChatMessageモデルに保存
        
        return redirect()->back()->with('success', 'メッセージを送信しました。');
    }
}
