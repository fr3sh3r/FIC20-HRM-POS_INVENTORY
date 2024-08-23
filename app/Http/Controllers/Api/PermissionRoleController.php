<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PermissionRole;
use Illuminate\Http\Request;

class PermissionRoleController extends Controller
{
    //index
    public function index()
    {
        $permissionRoles = PermissionRole::all();
        return response([
            'message' => 'Permission Role relationship List',
            'data' => $permissionRoles
        ], 200);
    }

    public function store(Request $request)
    {
        //validate request
        $request->validate([
            'role_id' => 'required',
            'permission_id' => 'required',
        ]);

        //$user = $request->user();

        // Membuat instance PermissionRole baru
        $permissionRole = new PermissionRole();
        $permissionRole->role_id = $request->role_id;  // Menggunakan = untuk menetapkan nilai
        $permissionRole->permission_id = $request->permission_id;  // Menggunakan permission_id dari request
        $permissionRole->save();

        // Mengembalikan respon dengan data yang baru dibuat
        return response([
            'message' => 'PermissionRole Relationship created',
            'data' => $permissionRole
        ], 201);
    }


    //show
    public function show($id)
    {
        $permissionRole = PermissionRole::find($id);
        if (!$permissionRole) {
            return response([
                'message' => 'PermissionRole Relationship is not found'
            ], 404);
        }

        return response([
            //'message' => 'Role User ID ($id) details',
            'message' => "PermissionRole_ID ($id) details", //dengan menggunakan "" maka $Id akan diganti dengan Idnya
            'data' => $permissionRole
        ], 200);
    }

    //update
    public function update(Request $request, $id)
    {
        //validate request
        $request->validate([
            'role_id' => 'required',
            'permission_id' => 'required',
        ]);

        $permissionRole = PermissionRole::find($id);
        if (!$permissionRole) {
            return response([
                'message' => 'PermissionRole not found'
            ], 404);
        }

        $permissionRole->role_id = $request->role_id;
        $permissionRole->permission_id = $request->permission_id;
        $permissionRole->save();

        return response([
            'message' => 'PermissionRole updated',
            'data' => $permissionRole
        ], 200);
    }

    //destroy
    public function destroy($id)
    {
        $permissionRole = PermissionRole::find($id);
        if (!$permissionRole) {
            return response([
                'message' => 'Permission Role Relationship is not found'
            ], 404);
        }

        $permissionRole->delete();

        return response([
            'message' => 'Permission Role Relatioship was deleted'
        ], 200);
    }
}
