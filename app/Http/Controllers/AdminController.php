<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\AttendanceSession;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (! session()->has('admin_id')) {
            return redirect('/admin/login');
        }

        $students = Student::all();
        return view('admin.dashboard', compact('students'));
    }

    public function uploadStudents(Request $request)
    {
        if (! session()->has('admin_id')) {
            return redirect('/admin/login');
        }

        $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $path = $request->file('file')->getRealPath();
        if (($handle = fopen($path, 'r')) !== false) {
            // assuming header row: nis,name,class,birth_date
            $header = fgetcsv($handle);
            while (($data = fgetcsv($handle)) !== false) {
                $row = array_combine($header, $data);
                if ($row) {
                    Student::updateOrCreate(
                        ['nis' => $row['nis']],
                        [
                            'name' => $row['name'],
                            'class' => $row['class'],
                            'birth_date' => $row['birth_date'],
                        ]
                    );
                }
            }
            fclose($handle);
        }

        return redirect('/admin/dashboard')->with('status', 'Data siswa berhasil diunggah.');
    }

    public function showQrGenerator()
    {
        if (! session()->has('admin_id')) {
            return redirect('/admin/login');
        }

        return view('admin.qr-generator');
    }

    public function generateQrCode(Request $request)
    {
        if (! session()->has('admin_id')) {
            return redirect('/admin/login');
        }

        $request->validate([
            'time_limit' => 'required|integer|min:5|max:120',
        ]);

        // create a new attendance session
        $sessionCode = Str::random(10);
        $timeLimit = (int) $request->time_limit;
        $session = AttendanceSession::create([
            'session_code' => $sessionCode,
            'date' => today(),
            'start_time' => now(),
            'end_time' => now()->addMinutes($timeLimit),
            'is_active' => true,
        ]);

        // create QR code data with date, day, and time limit info
        $date = Carbon::now();
        $dayName = $date->isoFormat('dddd'); // e.g., "Monday"
        $dateFormatted = $date->format('Y-m-d');

        // encode session code as the QR content
        $qrContent = $sessionCode;

        // prepare data for the view
        $qrData = [
            'session_code' => $sessionCode,
            'date' => $dateFormatted,
            'day' => $dayName,
            'time_limit' => $timeLimit,
            'start_time' => $session->start_time->format('H:i:s'),
            'end_time' => $session->end_time->format('H:i:s'),
        ];

        return view('admin.qr-display', compact('qrContent', 'qrData'));
    }
}
