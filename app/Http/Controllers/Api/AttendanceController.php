<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //index
    public function index()
    {
        $attendances = Attendance::all();
        return response([
            'message' => 'Attendance list',
            'data' => $attendances
        ], 200);
    }

    //store
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

        // $attendance->save();
        try {
            $attendance->save();
        } catch (\Exception $e) {
            return response([
                'message' => 'Failed to create Attendance',
                'error' => $e->getMessage(),
            ], 500);
        }

        return response([
            'message' => 'Attendance created successfully',
            'data' => $attendance,
        ], 201);
    }

    //show
    public function show($id)
    {
        $attendance = Attendance::find($id);
        if (!$attendance) {
            return response([
                'message' => 'Attendance not found',
            ], 404);
        }

        return response([
            'message' => 'Successfully retrieved attendance',
            'data' => $attendance,
        ], 200);
    }

    //update
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
            'total_duration' => 'nullable',
            'is_late' => 'nullable',
            'is_half_day' => 'nullable',
            'is_paid' => 'nullable',
            'status' => 'nullable',
            'reason' => 'nullable',
        ]);

        $attendance = Attendance::find($id);
        if (!$attendance) {
            return response([
                'message' => 'Attendance not found',
            ], 404);
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
        $attendance->is_late = $request->is_late;
        $attendance->is_half_day = $request->is_half_day;
        $attendance->is_paid = $request->is_paid;
        $attendance->status = $request->status;
        $attendance->reason = $request->reason;

        // $attendance->save();

        try {
            $attendance->save();
        } catch (\Exception $e) {
            return response([
                'message' => 'Failed to update Attendance',
                'error' => $e->getMessage(),
            ], 500);
        }

        return response([
            'message' => 'Attendance updated successfully',
            'data' => $attendance,
        ], 200);
    }

    //destroy
    public function destroy($id)
    {
        $attendance = Attendance::find($id);
        if (!$attendance) {
            return response([
                'message' => 'Attendance not found',
            ], 404);
        }

        $attendance->delete();
        return response([
            'message' => 'Attendance deleted successfully',
        ], 200);
    }
}
