<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DesignationController extends Controller
{

    //deklarasikan pakeGenerikData agar bisa dipake berulang2
    protected function pakeGenerikData()
    {
        $columns = ['id', 'company_id', 'name', 'description']; // Kolom yang ingin ditampilkan
        $title = 'Designations';
        $routePrefix = 'designations'; // Prefix route

        return compact('columns', 'title', 'routePrefix');
    }


    public function index(Request $request)
    {

        // $data = Designation::orderBy('id', 'asc')->paginate(10);
        // $columns = ['id', 'company_id', 'name', 'description']; //, 'created_at', 'updated_at']; // Kolom yang ingin ditampilkan
        // $title = 'Designations';
        // $routePrefix = 'designations'; // Prefix route
        // return view('pages.designations.index', compact('data', 'columns', 'title', 'routePrefix'));


        //cara 2, pakai sebuah function yang kita sebut getCommonData
        // $data = Designation::orderBy('id', 'asc')->paginate(10);
        // $commonData = $this->pakeGenerikData();
        // return view('pages.designations.index', array_merge($commonData, compact('data')));

        //cara 3, agar bisa di search
        // $query = $request->input('query');
        $query = $request->input('query'); // Ambil nilai dari input pencarian
        $commonData = $this->pakeGenerikData();

        $data = Designation::query()
            ->when($query, function ($queryBuilder) use ($commonData, $query) {
                $queryBuilder->where(function ($subQuery) use ($commonData, $query) {
                    foreach ($commonData['columns'] as $column) {
                        $subQuery->orWhere($column, 'LIKE', "%{$query}%");
                    }
                });
            })
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('pages.designations.index', array_merge($commonData, compact('data')));
    }

    // Method untuk menampilkan halaman form data baru
    public function create()
    {
        //return view('pages.designations.create');

        $commonData = $this->pakeGenerikData();

        // Kembalikan view dengan data yang diperlukan
        return view('pages.designations.create', $commonData);
    }

    // Method untuk menyimpan data ke database
    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'name' => 'required',
        ]);

        // Mendapatkan pengguna saat ini
        $user = $request->user();

        // Membuat objek Designation baru
        $designation = new Designation();
        $designation->company_id = 1;
        $designation->created_by = $user->id;
        $designation->name = $request->name;
        $designation->description = $request->description;
        $designation->save();
        // Redirect ke halaman daftar absensi dengan pesan sukses
        return redirect()->route('designations.index')->with('success', 'Designation created successfully.');
    }


    public function show($id)
    {
        // $Designation = Designation::find($id);
        // return view('pages.designations.show', compact('Designation'));

        // Ambil item berdasarkan ID
        $item = Designation::findOrFail($id);

        // Ambil data generik seperti kolom dan judul
        $commonData = $this->pakeGenerikData();

        // Kembalikan view dengan data yang diperlukan
        return view('pages.designations.show', array_merge($commonData, compact('item')));
    }


    public function edit($id)
    {
        // $Designation = Designation::find($id);
        // return view('pages.designations.edit', compact('Designation'));

        $item = Designation::findOrFail($id);
        $commonData = $this->pakeGenerikData();
        return view('pages.designations.edit', array_merge($commonData, compact('item')));
    }


    public function update(Request $request, $id)
    {
        //validate request
        $request->validate([
            'name' => 'required',
        ]);

        $user = $request->user();

        $designation = Designation::find($id);
        if (!$designation) {
            return response([
                'message' => 'Designation not found'
            ], 404);
        }

        $designation->name = $request->name;
        $designation->description = $request->description;
        $designation->save();

        return redirect()->route('designations.index')->with('success', 'Designation updated successfully.');
    }


    public function destroy($id)
    {
        $Designation = Designation::find($id);

        if (!$Designation) {
            return redirect()->route('designations.index')->with('error', 'Designation not found.');
        }

        $Designation->delete();

        // Redirect ke halaman daftar absensi dengan pesan sukses
        return redirect()->route('designations.index')->with('success', 'Designation deleted successfully.');
    }
}
