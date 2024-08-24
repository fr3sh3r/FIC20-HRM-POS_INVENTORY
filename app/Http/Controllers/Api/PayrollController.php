<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payroll;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    //index
    public function index()
    {
        $payrolls = Payroll::all();
        return response([
            'message' => 'Payroll list',
            'data' => $payrolls
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'company_id' => 'required|exists:companies,id',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer',
            'basic_salary' => 'required|numeric',
            'net_salary' => 'required|numeric',
            'total_days' => 'required|integer',
            'working_days' => 'required|integer',
            'present_days' => 'required|integer',
            'total_office_time' => 'required|integer',
            'total_worked_time' => 'required|integer',
            'half_day' => 'nullable|integer',
            'late_days' => 'nullable|integer',
            'paid_leaves' => 'nullable|integer',
            'unpaid_leaves' => 'nullable|integer',
            'holiday_count' => 'nullable|integer',
            'payment_date' => 'nullable|date',
            'status' => 'nullable|string',
        ]);

        $payroll = new Payroll();
        $payroll->user_id = $request->user_id;
        $payroll->company_id = $request->company_id;
        $payroll->month = $request->month;
        $payroll->year = $request->year;
        $payroll->basic_salary = $request->basic_salary;
        $payroll->net_salary = $request->net_salary;
        $payroll->total_days = $request->total_days;
        $payroll->working_days = $request->working_days;
        $payroll->present_days = $request->present_days;
        $payroll->total_office_time = $request->total_office_time;
        $payroll->total_worked_time = $request->total_worked_time;
        $payroll->half_day = $request->half_day;
        $payroll->late_days = $request->late_days;
        $payroll->paid_leaves = $request->paid_leaves;
        $payroll->unpaid_leaves = $request->unpaid_leaves;
        $payroll->holiday_count = $request->holiday_count;
        $payroll->payment_date = $request->payment_date;
        $payroll->status = $request->status ?? 'generated';

        try {
            $payroll->save();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create Payroll',
                'error' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'message' => 'Payroll created successfully',
            'data' => $payroll,
        ], 201);
    }


    public function show($id)
    {
        try {
            $payroll = Payroll::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Payroll not found',
                'error' => $e->getMessage(),
            ], 404);
        }

        return response()->json(
            [
                'message' => 'Payroll retrieved successfully',
                'data' => $payroll,
            ],
            200
        );
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'company_id' => 'required|exists:companies,id',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer',
            'basic_salary' => 'required|numeric',
            'net_salary' => 'required|numeric',
            'total_days' => 'required|integer',
            'working_days' => 'required|integer',
            'present_days' => 'required|integer',
            'total_office_time' => 'required|integer',
            'total_worked_time' => 'required|integer',
            'half_day' => 'nullable|integer',
            'late_days' => 'nullable|integer',
            'paid_leaves' => 'nullable|integer',
            'unpaid_leaves' => 'nullable|integer',
            'holiday_count' => 'nullable|integer',
            'payment_date' => 'nullable|date',
            'status' => 'nullable|string',
        ]);

        $payroll = Payroll::findOrFail($id);

        try {
            $payroll->update([
                'user_id' => $request->user_id,
                'company_id' => $request->company_id,
                'month' => $request->month,
                'year' => $request->year,
                'basic_salary' => $request->basic_salary,
                'net_salary' => $request->net_salary,
                'total_days' => $request->total_days,
                'working_days' => $request->working_days,
                'present_days' => $request->present_days,
                'total_office_time' => $request->total_office_time,
                'total_worked_time' => $request->total_worked_time,
                'half_day' => $request->half_day,
                'late_days' => $request->late_days,
                'paid_leaves' => $request->paid_leaves,
                'unpaid_leaves' => $request->unpaid_leaves,
                'holiday_count' => $request->holiday_count,
                'payment_date' => $request->payment_date,
                'status' => $request->status ?? 'generated',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update Payroll',
                'error' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'message' => 'Payroll updated successfully',
            'data' => $payroll,
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $payroll = Payroll::findOrFail($id);

        try {
            $payroll->delete();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete Payroll',
                'error' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'message' => 'Payroll deleted successfully',
        ], 200);
    }
}
