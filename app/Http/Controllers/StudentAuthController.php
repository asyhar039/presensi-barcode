<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentAuthController extends Controller
{
    public function showLogin()
    {
        return view('student.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nis' => 'required|string',
            'password' => 'required|string',
        ]);

        $student = Student::where('nis', $request->nis)->first();

        if (! $student) {
            return back()->withErrors(['nis' => 'NIS tidak ditemukan'])->withInput();
        }

        // compute expected password: first name + two-digit day of birth
        $firstName = explode(' ', trim($student->name))[0];
        // @var \Illuminate\Support\Carbon|null $student->birth_date
        $day = $student->birth_date ? $student->birth_date->format('d') : '';
        $expected = strtolower($firstName) . $day;

        if ($request->password !== $expected) {
            return back()->withErrors(['password' => 'Password salah'])->withInput();
        }

        // store in session
        session(['student_id' => $student->id]);
        return redirect('/');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('student_id');
        return redirect('/login');
    }
}
