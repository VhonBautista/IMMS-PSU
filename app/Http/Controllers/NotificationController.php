<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index() {
        $user = Auth::user();
        $unreadNotifications = $user->unreadNotifications;
        $readNotifications = $user->readNotifications;
    
        return view('notification', compact('unreadNotifications', 'readNotifications'));
    }

    public function markAsRead(Request $request, $id) {
        $notification = $request->user()->notifications()->find($id);
    
        if ($notification) {
            $notification->markAsRead();
            return response()->json(['success' => true]);
        }
    
        return response()->json(['success' => false, 'message' => 'Notification not found.']);
    }

    public function markAllAsRead(Request $request) {
        $request->user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    }
}
