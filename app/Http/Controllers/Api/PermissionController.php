<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    //index
    public function index()
    {
        $permissions = Permission::all();
        return response([
            'message' => 'Permission List',
            'data' => $permissions
        ], 200);
    }


    public function store(Request $request)
    {
        //validate request
        $request->validate([
            'name' => 'required',
            'display_name' => 'required',
            'description' => 'required',
            'module_name' => 'required'
        ]);

        //tidak perlu
        //$user = $request->user();

        $permission = new Permission();
        $permission->name = $request->name;
        $permission->display_name = $request->display_name;
        $permission->description = $request->description;
        $permission->module_name = $request->module_name;
        $permission->save();

        return response([
            'message' => 'Permission created',
            'data' => $permission
        ], 201);
    }

    //show
    public function show($id)
    {
        $permission = Permission::find($id);
        if (!$permission) {
            return response([
                'message' => 'Permission not found'
            ], 404);
        }

        return response([
            'message' => 'Permission details',
            'data' => $permission
        ], 200);
    }


    public function update(Request $request, $id)
    {
        //validate request
        $request->validate([
            'name' => 'required',
            'display_name' => 'required',
            'description' => 'required',
            'module_name' => 'required'
        ]);

        //tidak perlu
        //$user = $request->user();
        $permission = Permission::find($id);
        if (!$permission) {
            return response([
                'message' => 'Permission not found'
            ], 404);
        }

        //// $permission = new Permission(); //jamgam membuat instance baru
        $permission->name = $request->name;
        $permission->display_name = $request->display_name;
        $permission->description = $request->description;
        $permission->module_name = $request->module_name;
        $permission->save();

        return response([
            'message' => 'Permission updated',
            'data' => $permission
        ], 200);  //update pake code 200
    }

    //destroy
    public function destroy($id)
    {
        $permission = permission::find($id);
        if (!$permission) {
            return response([
                'message' => 'Permission not found'
            ], 404);
        }

        $permission->delete();

        return response([
            'message' => 'Permission deleted'
        ], 200);
    }
}
