<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\AttendanceSession;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    // ===============================
    // GURU MEMBUAT SESI PRESENSI
    // ===============================
    public function createSession(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'class_id'   => 'required|exists:classes,id'
        ]);

        $session = AttendanceSession::create([
            'subject_id'   => $request->subject_id,
            'class_id'     => $request->class_id,
            'session_code' => Str::random(10),
            'date'         => today(),
            'start_time'   => now(),
            'end_time'     => now()->addMinutes(30),
            'is_active'    => true
        ]);

        return response()->json([
            'message' => 'Session berhasil dibuat',
            'data'    => $session
        ]);
    }

    // ===============================
    // SISWA SCAN BARCODE
    // ===============================
    public function scan(Request $request)
    {
        $request->validate([
            'student_id'   => 'required|exists:students,id',
            'session_code' => 'required'
        ]);

        $student = Student::findOrFail($request->student_id);

        $session = AttendanceSession::where('session_code', $request->session_code)
            ->where('is_active', true)
            ->first();

        if (!$session) {
            return response()->json([
                'message' => 'Session tidak ditemukan atau tidak aktif'
            ], 404);
        }

        // Cek waktu sesi
        if (now()->gt($session->end_time)) {
            return response()->json([
                'message' => 'Sesi sudah berakhir'
            ], 400);
        }

        // Cegah double scan
        $alreadyScan = Attendance::where('student_id', $student->id)
            ->where('attendance_session_id', $session->id)
            ->exists();

        if ($alreadyScan) {
            return response()->json([
                'message' => 'Anda sudah melakukan presensi'
            ], 400);
        }

        // Tentukan status hadir / terlambat
        $status = now()->gt(Carbon::parse($session->start_time)->addMinutes(10))
            ? 'terlambat'
            : 'hadir';

        $attendance = Attendance::create([
            'student_id' => $student->id,
            'attendance_session_id' => $session->id,
            'status' => $status,
            'scan_time' => now()
        ]);

        return response()->json([
            'message' => 'Presensi berhasil',
            'data'    => $attendance
        ]);
    }
}
