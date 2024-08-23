<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    //index
    public function index()
    {
        $leave = Leave::all();
        return response([
            'message' => 'Successfully retrieved leaves',
            'data' => $leave,
        ], 200);
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'leave_type_id' => 'required',
            'company_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'is_half_day' => 'required',
            'total_days' => 'required',
            'is_paid' => 'required',
            'reason' => 'required',

        ]);

        $leave = new Leave();
        $leave->user_id = $request->user_id;
        $leave->leave_type_id = $request->leave_type_id;
        $leave->company_id = $request->company_id;
        $leave->start_date = $request->start_date;
        $leave->end_date = $request->end_date;
        $leave->is_half_day = $request->is_half_day;
        // $leave->total_days = $request->total_days;$leave->is_paid = $request->is_paid;
        $leave->reason = $request->reason;
        $leave->status = 'pending';

        //improvisasi dari ChatGPT
        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = \Carbon\Carbon::parse($request->end_date);
        $leave->total_days = $endDate->diffInDays($startDate) + 1; // Include the end date in the count


        //$leave->save();

        //altenative Save sekalian Error Trap Message
        try {
            $leave->save();
        } catch (\Exception $e) {
            return response([
                'message' => 'Failed to create leave',
                'error' => $e->getMessage(),
            ], 500);
        }

        // Return success response
        return response([
            'message' => 'Leave created successfully',
            'data' => $leave,
        ], 201);
    }

    //show
    public function show($id)
    {
        $leave = Leave::find($id);
        if (!$leave) {
            return response([
                'message' => 'Leave not found',
            ], 404);
        }

        return response([
            'message' => 'Successfully retrieved leave',
            'data' => $leave,
        ], 200);
    }

    //update
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'leave_type_id' => 'required|integer|exists:leave_types,id',
            'company_id' => 'required|integer|exists:companies,id', // Validate company_id
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'is_half_day' => 'required|boolean',
            'total_days' => 'nullable|integer|min:1', // Make it nullable if recalculated
            'is_paid' => 'required|boolean',
            'reason' => 'required|string|max:255',
            'status' => 'required|string|in:pending,approved,rejected', // CASE SENSITIVE  Assuming status has specific values
        ]);

        // Find the leave record by ID
        $leave = Leave::find($id);
        if (!$leave) {
            return response([
                'message' => 'Leave not found',
            ], 404);
        }

        // Update leave record fields
        $leave->user_id = $request->user_id;
        $leave->leave_type_id = $request->leave_type_id;
        $leave->company_id = $request->company_id;
        $leave->start_date = $request->start_date;
        $leave->end_date = $request->end_date;
        $leave->is_half_day = $request->is_half_day;
        $leave->is_paid = $request->is_paid;
        $leave->reason = $request->reason;
        $leave->status = $request->status;

        // Recalculate total_days if not provided
        if (!$request->filled('total_days')) {
            $startDate = \Carbon\Carbon::parse($request->start_date);
            $endDate = \Carbon\Carbon::parse($request->end_date);
            $leave->total_days = $endDate->diffInDays($startDate) + 1; // Include the end date in the count
        } else {
            $leave->total_days = $request->total_days;
        }

        // Save the updated leave record and handle potential errors
        try {
            $leave->save();
        } catch (\Exception $e) {
            return response([
                'message' => 'Failed to update leave',
                'error' => $e->getMessage(),
            ], 500);
        }

        // Return success response
        return response([
            'message' => 'Leave updated successfully',
            'data' => $leave,
        ], 200);
    }


    //destroy
    public function destroy($id)
    {
        $leave = Leave::find($id);
        if (!$leave) {
            return response([
                'message' => 'Leave not found',
            ], 404);
        }

        $leave->delete();

        return response([
            'message' => 'Leave deleted successfully',
        ], 200);
    }
}
