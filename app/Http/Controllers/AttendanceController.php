<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $attendances = DB::table('attendances')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('pages.attendances.index', compact('attendances'));
    }

    // Method untuk menampilkan halaman form data baru
    public function create()
    {
        return view('pages.attendances.create');
    }

    // Method untuk menyimpan data ke database
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'user_id' => 'required',
            'is_holiday' => 'nullable',
            'is_leave' => 'nullable',
            'leave_id' => 'nullable',
            'holiday_id' => 'nullable',
            'clock_in_date_time' => 'required',
            'clock_out_date_time' => 'nullable',
            'total_duration' => 'nullable',
            'is_late' => 'nullable',
            'is_half_day' => 'nullable',
            'is_paid' => 'nullable',
            'status' => 'nullable',
            'reason' => 'nullable',
        ]);

        $attendance = new Attendance();
        $attendance->company_id = 1;
        $attendance->user_id = $request->user_id;
        $attendance->date = $request->date;
        $attendance->is_holiday = $request->is_holiday;
        $attendance->is_leave = $request->is_leave;
        $attendance->leave_id = $request->leave_id;
        $attendance->holiday_id = $request->holiday_id;
        $attendance->clock_in_date_time = $request->clock_in_date_time;
        $attendance->clock_out_date_time = $request->clock_out_date_time;
        $attendance->total_duration = $request->total_duration;
        $attendance->is_late = $request->is_late;
        $attendance->is_half_day = $request->is_half_day;
        $attendance->is_paid = $request->is_paid;
        $attendance->status = $request->status;
        $attendance->reason = $request->reason;

        // Redirect ke halaman daftar absensi dengan pesan sukses
        return redirect()->route('attendances.index')->with('success', 'Attendance created successfully.');
    }


    public function show($id)
    {
        $attendance = Attendance::find($id);
        return view('pages.attendances.show', compact('attendance'));
    }


    public function edit($id)
    {
        $attendance = Attendance::find($id);
        return view('pages.attendances.edit', compact('attendance'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required',
            'user_id' => 'required',
            'is_holiday' => 'nullable',
            'is_leave' => 'nullable',
            'leave_id' => 'nullable',
            'holiday_id' => 'nullable',
            'clock_in_date_time' => 'required',
            'clock_out_date_time' => 'nullable',
            'total_duration' => 'nullable|integer',
            'is_late' => 'nullable|boolean',
            'is_half_day' => 'nullable|boolean',
            'is_paid' => 'nullable|boolean',
            'status' => 'nullable',
            'reason' => 'nullable',
        ]);

        $attendance = Attendance::find($id);
        if (!$attendance) {
            return response([
                'message' => 'Attendance not found',
            ], 404);
        }


        // Perhitungan durasi total
        $clockIn = $request->input('clock_in_date_time');
        $clockOut = $request->input('clock_out_date_time');

        if ($clockIn && $clockOut) {
            $clockInDate = new \DateTime($clockIn);
            $clockOutDate = new \DateTime($clockOut);

            // Pastikan clockOut setelah clockIn
            if ($clockOutDate >= $clockInDate) {
                $diffInSec = $clockOutDate->getTimestamp() - $clockInDate->getTimestamp();
                $totalDuration = floor($diffInSec / 60); // Konversi detik ke menit
            } else {
                $totalDuration = 0;
            }

            $request->merge(['total_duration' => $totalDuration]);
        }


        $attendance->company_id = 1;
        $attendance->user_id = $request->user_id;
        $attendance->date = $request->date;
        $attendance->is_holiday = $request->is_holiday;
        $attendance->is_leave = $request->is_leave;
        $attendance->leave_id = $request->leave_id;
        $attendance->holiday_id = $request->holiday_id;
        $attendance->clock_in_date_time = $request->clock_in_date_time;
        $attendance->clock_out_date_time = $request->clock_out_date_time;
        $attendance->total_duration = $request->total_duration;
        $attendance->is_late = $request->is_late ?? 0;
        $attendance->is_half_day = $request->is_half_day ?? 0;
        $attendance->is_paid = $request->is_paid ?? 1;
        $attendance->status = $request->status;
        $attendance->reason = $request->reason;



        $attendance->save();

        return redirect()->route('attendances.index')->with('success', 'Attendance updated successfully.');
    }


    public function destroy($id)
    {
        $attendance = Attendance::find($id);

        if (!$attendance) {
            return redirect()->route('attendances.index')->with('error', 'Attendance not found.');
        }

        $attendance->delete();

        // Redirect ke halaman daftar absensi dengan pesan sukses
        return redirect()->route('attendances.index')->with('success', 'Attendance deleted successfully.');
    }
}
