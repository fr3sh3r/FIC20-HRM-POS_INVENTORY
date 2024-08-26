<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // index
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }



    //store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
            // Validasi lainnya sesuai kebutuhan...
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Ambil user yang sedang terautentikasi
        $user = $request->user();

        $userNa = new User();
        $userNa->company_id = 1;
        $userNa->name = $request->name;
        $userNa->email = $request->email;
        $userNa->password = Hash::make($request->password);
        $userNa->username = $request->username;
        $userNa->company_id = $request->company_id;
        $userNa->role_id = $request->role_id;
        $userNa->is_superadmin = $request->is_superadmin;
        $userNa->user_type = $request->user_type;
        $userNa->login_enabled = $request->login_enabled;
        $userNa->profile_image = $request->profile_image;
        $userNa->status = $request->status;
        $userNa->phone = $request->phone;
        $userNa->address = $request->address;
        $userNa->department_id = $request->department_id;
        $userNa->designation_id = $request->designation_id;
        $userNa->shift_id = $request->shift_id;
        $userNa->created_by = $request->user()->id; // User ID dari yang membuat record


        try {
            $userNa->save();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create User',
                'error' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'message' => 'User created successfully',
            'data' => $userNa,
        ], 201);
    }



    //show
    // GET /api/users/{id}
    public function show($id)
    {
        $userNa = User::find($id);
        if (!$userNa) {
            return response([
                'message' => 'User not found',
            ], 404);
        }

        return response([
            'message' => 'Successfully retrieved User',
            'data' => $userNa,
        ], 200);
    }



    //update
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:8',
            'role_id' => 'sometimes|exists:roles,id',
            // Validasi lainnya sesuai kebutuhan...
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user->update($request->all() + ['updated_by' =>  $request->user()->id]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return response()->json($user);
    }



    //destroy
    public function destroy(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->update(['deleted_by' =>  $request->user()->id]);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}


