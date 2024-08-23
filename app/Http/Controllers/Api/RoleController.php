<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //index
    public function index()
    {

        // $roles = Role::orderBy('display_name', 'asc')
        // ->orderBy('description', 'asc')
        // ->paginate(10);

        $roles = Role::all();  //$Roles = list semua ROLE di tabel Roles
        return response([
            'message' => 'Roles List',
            'data' => $roles
        ], 200);
    }

    //Store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required', //field name di table Roles -->nama Role
        ]);

        $role = new Role();
        $role->company_id = 1;
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();

        return response([
            'message' => 'Role created',
            'data' => $role
        ], 201);
    }

    public function show($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response([
                'message' => 'Role not found'
            ], 404);
        }

        return response([
            'message' => 'Role details',
            'data' => $role
        ], 200);
    }

    //update
    public function update(Request $request, $id)
    {
        //validate request
        // list permission
        //Misal
        //Jika kita mengirimkan request untuk memperbarui Role dengan id tertentu:
        //tadinya Manager Role punya permission 1,2,5,6,7 dan ingin diganti menjadi 1,2,3, maka pake SYNC

        //     {
        //          "name": "manager",
        //          "display_name": "Manager",
        //          "description": "Manager Role",
        //          "permissionIds": [1, 2, 3]
        //      }

        $request->validate([
            'name' => 'required',
            'permissionIds' => 'required|array',
        ]);

        $role = Role::find($id);
        if (!$role) {
            return response([
                'message' => 'Role not found'
            ], 404);
        }

        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();

        //SYNC
        // sync() memastikan hanya permissions yang ada dalam array permissionIds yang dihubungkan dengan Role,
        // menggantikan semua hubungan sebelumnya.
        $role->permissions()->sync($request->permissionIds);


        return response([
            'message' => 'Role updated',
            'data' => $role
        ], 200);
    }

    //destroy
    public function destroy($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response([
                'message' => 'Role not found'
            ], 404);
        }

        $role->delete();

        return response([
            'message' => 'Role deleted'
        ], 200);
    }
}
