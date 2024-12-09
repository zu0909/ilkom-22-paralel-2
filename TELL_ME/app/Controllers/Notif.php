<?php

namespace App\Controllers;
use App\Models\NotificationModel;

class Notif extends BaseController
{
    public function index()
    {
        // Ambil ID pengguna dari session
        $userId = session()->get('user_id');

        // Inisialisasi model notifikasi
        $notificationModel = new NotificationModel();

        // Ambil notifikasi untuk pengguna
        $data['notifications'] = $notificationModel->where('user_id', $userId)->findAll();

        return view('notif/index', $data);
    }

    public function markAsRead($notificationId)
    {
        // Inisialisasi model notifikasi
        $notificationModel = new NotificationModel();

        // Update status notifikasi menjadi dibaca
        $notificationModel->update($notificationId, ['is_read' => 1]);

        // Redirect kembali ke halaman notifikasi
        return redirect()->to('/notif/index')->with('success', 'Notification marked as read.');
    }

    public function delete($notificationId)
    {
        // Inisialisasi model notifikasi
        $notificationModel = new NotificationModel();

        // Hapus notifikasi
        $notificationModel->delete($notificationId);

        // Redirect kembali ke halaman notifikasi
        return redirect()->to('/notif/index')->with('success', 'Notification deleted successfully.');
    }
}