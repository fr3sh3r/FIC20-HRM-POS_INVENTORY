<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // Method untuk menampilkan daftar pengguna
    public function index(Request $request)
    {
        // Mengambil daftar pengguna dengan pagination dan filter berdasarkan nama jika ada
        $users = DB::table('users')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('pages.users.index', compact('users'));
    }

    // Method untuk menampilkan halaman form pembuatan pengguna baru
    public function create()
    {
        return view('pages.users.create');
    }

    // Method untuk menyimpan pengguna baru ke database
    public function store(Request $request)
    {
        // Validasi input
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

        // Membuat instance User baru
        $userNa = new User();
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

        // Menyimpan pengguna baru ke database
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

        // Redirect ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Method untuk menampilkan detail pengguna
    public function show($id)
    {
        $user = User::find($id);
        return view('pages.users.show', compact('user'));
    }

    // Method untuk menampilkan form edit pengguna
    public function edit($id)
    {
        $user = User::find($id);
        return view('pages.users.edit', compact('user'));
    }

    // Method untuk memperbarui pengguna
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Validasi input
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

        // Mengupdate pengguna dengan data baru
        $user->update($request->all() + ['updated_by' =>  $request->user()->id]);

        // Mengupdate password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        // Redirect ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Method untuk menghapus pengguna
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }

        $user->delete();

        // Redirect ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
