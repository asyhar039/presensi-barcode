<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AttendanceSession;
use App\Helpers\QrCodeHelper;

class AttendanceViewController extends Controller
{
    public function index()
    {
        // redirect to login if student not authenticated
        if (! session()->has('student_id')) {
            return redirect('/login');
        }

        $session = AttendanceSession::latest()->first();
        $qrCode = $session ? QrCodeHelper::generate($session->session_code) : null;

        return view('qr', compact('session', 'qrCode'));
    }
}
