<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{

    //deklarasikan pakeGenerikData agar bisa dipake berulang2
    protected function pakeGenerikData()
    {
        $columns = ['id', 'company_id', 'name', 'description']; // Kolom yang ingin ditampilkan
        $title = 'Departments';
        $routePrefix = 'departments'; // Prefix route

        return compact('columns', 'title', 'routePrefix');
    }


    public function index(Request $request)
    {

        // $data = Department::orderBy('id', 'asc')->paginate(10);
        // $columns = ['id', 'company_id', 'name', 'description']; //, 'created_at', 'updated_at']; // Kolom yang ingin ditampilkan
        // $title = 'Departments';
        // $routePrefix = 'departments'; // Prefix route
        // return view('pages.departments.index', compact('data', 'columns', 'title', 'routePrefix'));


        //cara 2, pakai sebuah function yang kita sebut getCommonData
        // $data = Department::orderBy('id', 'asc')->paginate(10);
        // $commonData = $this->pakeGenerikData();
        // return view('pages.departments.index', array_merge($commonData, compact('data')));

        //cara 3, agar bisa di search
        // $query = $request->input('query');
        $query = $request->input('query'); // Ambil nilai dari input pencarian
        $commonData = $this->pakeGenerikData();

        $data = Department::query()
            ->when($query, function ($queryBuilder) use ($commonData, $query) {
                $queryBuilder->where(function ($subQuery) use ($commonData, $query) {
                    foreach ($commonData['columns'] as $column) {
                        $subQuery->orWhere($column, 'LIKE', "%{$query}%");
                    }
                });
            })
            ->orderBy('id', 'asc')
            ->paginate(10);

        // dd($data);

        return view('pages.departments.index', array_merge($commonData, compact('data')));
    }

    // Method untuk menampilkan halaman form data baru
    public function create()
    {
        //return view('pages.departments.create');

        $commonData = $this->pakeGenerikData();

        // Kembalikan view dengan data yang diperlukan
        return view('pages.departments.create', $commonData);
    }

    // Method untuk menyimpan data ke database
    public function store(Request $request)
    {
        //validate request
        $request->validate([
            'name' => 'required',
        ]);

        $user = $request->user();

        $department = new Department();
        $department->company_id = 1;
        $department->created_by = $user->id;
        $department->name = $request->name;
        $department->description = $request->description;
        $department->save();


        // Redirect ke halaman daftar absensi dengan pesan sukses
        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }


    public function show($id)
    {
        // $Department = Department::find($id);
        // return view('pages.departments.show', compact('Department'));

        // Ambil item berdasarkan ID
        $item = Department::findOrFail($id);

        // Ambil data generik seperti kolom dan judul
        $commonData = $this->pakeGenerikData();

        // Kembalikan view dengan data yang diperlukan
        return view('pages.departments.show', array_merge($commonData, compact('item')));
    }


    public function edit($id)
    {
        // $Department = Department::find($id);
        // return view('pages.departments.edit', compact('Department'));

        $item = Department::findOrFail($id);
        $commonData = $this->pakeGenerikData();
        return view('pages.departments.edit', array_merge($commonData, compact('item')));
    }


    public function update(Request $request, $id)
    {
        //validate request
        $request->validate([
            'name' => 'required',
        ]);

        $department = Department::find($id);
        if (!$department) {
            return response([
                'message' => 'Department not found'
            ], 404);
        }

        $department->name = $request->name;
        $department->description = $request->description;
        $department->save();

        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }


    public function destroy($id)
    {
        $Department = Department::find($id);

        if (!$Department) {
            return redirect()->route('departments.index')->with('error', 'Department not found.');
        }

        $Department->delete();

        // Redirect ke halaman daftar absensi dengan pesan sukses
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}
