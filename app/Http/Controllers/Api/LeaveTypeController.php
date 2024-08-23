<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    //index
    public function index()
    {
        $leaveTypes = LeaveType::all();
        return response([
            'message' => 'Leave Type List',
            'data' => $leaveTypes
        ], 200);
    }

    public function store(Request $request)
    {

        /**
         *  $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
         *  $table->string('name');
         *   $table->boolean('is_paid')->default(1);
         *   $table->integer('total_leaves')->default(0);
         *   $table->integer('max_leave_per_month')->nullable();
         *   $table->foreignId('created_by')->constrained('users')->onDelete('cascade');

         */
        //validate request
        $request->validate([
            'name' => 'required',
            'is_paid' => 'required',
            'total_leaves' => 'required',
            'max_leave_per_month' => 'nullable',
        ]);


        $user = $request->user();

        $leaveType = new LeaveType();
        $leaveType->company_id = 1;
        $leaveType->name = $request->name;
        $leaveType->is_paid = $request->is_paid;
        $leaveType->total_leaves = $request->total_leaves;
        $leaveType->max_leave_per_month = $request->max_leave_per_month;
        $leaveType->created_by = $request->user()->id;
        $leaveType->save();

        return response([
            'message' => 'Leave Type created',
            'data' => $leaveType
        ], 201);
    }

    //show
    public function show($id)
    {
        $leaveType = LeaveType::find($id);
        if (!$leaveType) {
            return response([
                'message' => 'Leave type not found',
            ], 404);
        }

        return response([
            'message' => 'Successfully retrieved leave type',
            'data' => $leaveType,
        ], 200);
    }

    //update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'is_paid' => 'required',
            'total_leaves' => 'required',
            'max_leave_per_month' => 'nullable',
        ]);

        $leaveType = LeaveType::find($id);
        if (!$leaveType) {
            return response([
                'message' => 'Leave type not found',
            ], 404);
        }

        $leaveType->name = $request->name;
        $leaveType->is_paid = $request->is_paid;
        $leaveType->total_leaves = $request->total_leaves;
        $leaveType->max_leave_per_month = $request->max_leave_per_month;
        $leaveType->save();

        return response([
            'message' => 'Leave type updated successfully',
            'data' => $leaveType,
        ], 200);
    }

    //destroy
    public function destroy($id)
    {
        $leaveType = LeaveType::find($id);
        if (!$leaveType) {
            return response([
                'message' => 'Leave type not found',
            ], 404);
        }

        $leaveType->delete();

        return response([
            'message' => 'Leave type deleted successfully',
        ], 200);
    }
}
