<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();
        return response()->json(['notifications' => $notifications]);
    }

    public function markAsRead(Request $request, $notificationId)
    {
        $notification = Notification::findOrFail($notificationId);
        $notification->update(['status' => true]); // Assuming 'status' indicates read status
        return response()->json(['message' => 'Notification marked as read']);
    }
    
    public function markMultipleAsRead(Request $request)
    {
        $notificationIds = $request->input('ids');
        Notification::whereIn('id', $notificationIds)->update(['status' => true]);
        return response()->json(['message' => 'Notifications marked as read']);
    }
    
    public function delete(Notification $notification)
    {
        $notification->delete();
        return response()->json(['message' => 'Notification deleted']);
    }

    public function getUnreadNotifications()
    {
        $unreadNotifications = Notification::where('status', false)->get();
        return response()->json(['notifications' => $unreadNotifications]);
    }

    public function getUnreadNotificationsCount()
    {
        $unreadNotificationsCount = Notification::where('status', false)->count();
        return response()->json(['count' => $unreadNotificationsCount]);
    }
}
