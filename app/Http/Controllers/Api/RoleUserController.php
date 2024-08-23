<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RoleUser;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    public function index()
    {
        $roleUsers = RoleUser::all();
        return response([
            'message' => 'RoleUser list',
            'data' => $roleUsers
        ], 200);
    }

    public function store(Request $request)
    {
        //validate request
        $request->validate([
            'role_id' => 'required',
            'user_id' => 'required',
        ]);

        $user = $request->user();

        // Membuat instance RoleUser baru
        $roleUser = new RoleUser();
        $roleUser->role_id = $request->role_id;  // Menggunakan = untuk menetapkan nilai
        $roleUser->user_id = $request->user_id;  // Menggunakan user_id dari request
        $roleUser->save();

        // Mengembalikan respon dengan data yang baru dibuat
        return response([
            'message' => 'RoleUser created',
            'data' => $roleUser
        ], 201);
    }


    //show
    public function show($id)
    {
        $roleUser = RoleUser::find($id);
        if (!$roleUser) {
            return response([
                'message' => 'RoleUser not found'
            ], 404);
        }

        return response([
            //'message' => 'Role User ID ($id) details',
            'message' => "RoleUser_ID ($id) details", //dengan menggunakan "" maka $Id akan diganti dengan Idnya
            'data' => $roleUser
        ], 200);
    }

    //update
    public function update(Request $request, $id)
    {
        //validate request
        $request->validate([
            'role_id' => 'required',
            'user_id' => 'required',
        ]);

        $roleUser = RoleUser::find($id);
        if (!$roleUser) {
            return response([
                'message' => 'RoleUser not found'
            ], 404);
        }

        $roleUser->role_id = $request->role_id;
        $roleUser->user_id = $request->user_id;
        $roleUser->save();

        return response([
            'message' => 'RoleUser updated',
            'data' => $roleUser
        ], 200);
    }

    //destroy
    public function destroy($id)
    {
        $roleUser = RoleUser::find($id);
        if (!$roleUser) {
            return response([
                'message' => 'Role User not found'
            ], 404);
        }

        $roleUser->delete();

        return response([
            'message' => 'Role User deleted'
        ], 200);
    }
}
