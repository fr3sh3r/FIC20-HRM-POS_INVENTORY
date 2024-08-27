<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\basicSalary;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class basicSalaryController extends Controller
{
    public function index(Request $request)
    {


        $data = BasicSalary::orderBy('id', 'asc')->paginate(10);
        $columns = ['id', 'company_id', 'user_id', 'basic_salary', 'created_at', 'updated_at']; // Kolom yang ingin ditampilkan
        $title = 'Daftar Gaji';
        $routePrefix = 'basic-salaries'; // Prefix route


        // return view('pages.basicSalaries.index', compact('basicSalaries'));
        return view('pages.basic-salaries.index', compact('data', 'columns', 'title', 'routePrefix'));
    }

    // Method untuk menampilkan halaman form data baru
    public function create()
    {
        return view('pages.basicSalaries.create');
    }

    // Method untuk menyimpan data ke database
    public function store(Request $request)
    {
        //validate request
        $request->validate([
            //jika company_id dinamis artinya ada bbrp company maka harus divalidasi dulu
            //'company_id' => 'required|exists:companies,id',
            'basic_salary' => 'required',
            'user_id' => 'required',
        ]);

        $user = $request->user();

        $basicSalary = new BasicSalary();
        //$basicSalary->company_id = $request->company_id; // Mengambil company_id dari request
        $basicSalary->company_id = 1;
        $basicSalary->user_id = $request->user_id;
        $basicSalary->basic_salary = $request->basic_salary;
        $basicSalary->save();

        // Redirect ke halaman daftar absensi dengan pesan sukses
        return redirect()->route('basicSalaries.index')->with('success', 'basicSalary created successfully.');
    }


    public function show($id)
    {
        $basicSalary = basicSalary::find($id);
        return view('pages.basicSalaries.show', compact('basicSalary'));
    }


    public function edit($id)
    {
        $basicSalary = basicSalary::find($id);
        return view('pages.basicSalaries.edit', compact('basicSalary'));
    }


    public function update(Request $request, $id)
    {
        //validate request
        $request->validate([
            'basic_salary' => 'required',
            'user_id' => 'required',
        ]);

        $basicSalary = BasicSalary::find($id);
        if (!$basicSalary) {
            return response([
                'message' => 'Basic Salary not found'
            ], 404);
        }

        $basicSalary->basic_salary = $request->basic_salary;
        $basicSalary->user_id = $request->user_id;
        $basicSalary->save();

        return redirect()->route('basicSalaries.index')->with('success', 'basicSalary updated successfully.');
    }


    public function destroy($id)
    {
        $basicSalary = basicSalary::find($id);

        if (!$basicSalary) {
            return redirect()->route('basicSalaries.index')->with('error', 'basicSalary not found.');
        }

        $basicSalary->delete();

        // Redirect ke halaman daftar absensi dengan pesan sukses
        return redirect()->route('basicSalaries.index')->with('success', 'basicSalary deleted successfully.');
    }
}
