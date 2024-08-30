<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Holiday;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class HolidayController extends Controller
{

    //deklarasikan pakeGenerikData agar bisa dipake berulang2
    protected function pakeGenerikData()
    {
        $columns = ['id', 'company_id', 'name', 'date', 'is_weekend'];

        $title = 'Holidays';
        $routePrefix = 'holidays'; // Prefix route

        return compact('columns', 'title', 'routePrefix');
    }


    public function index(Request $request)
    {

        // $data = Holiday::orderBy('id', 'asc')->paginate(10);
        // $columns = ['id', 'company_id', 'name', 'description']; //, 'created_at', 'updated_at']; // Kolom yang ingin ditampilkan
        // $title = 'Holidays';
        // $routePrefix = 'Holidays'; // Prefix route
        // return view('pages.holidays.index', compact('data', 'columns', 'title', 'routePrefix'));


        //cara 2, pakai sebuah function yang kita sebut getCommonData
        // $data = Holiday::orderBy('id', 'asc')->paginate(10);
        // $commonData = $this->pakeGenerikData();
        // return view('pages.holidays.index', array_merge($commonData, compact('data')));

        //cara 3, agar bisa di search
        // $query = $request->input('query');
        $query = $request->input('query'); // Ambil nilai dari input pencarian
        $commonData = $this->pakeGenerikData();

        $data = Holiday::query()
            ->when($query, function ($queryBuilder) use ($commonData, $query) {
                $queryBuilder->where(function ($subQuery) use ($commonData, $query) {
                    foreach ($commonData['columns'] as $column) {
                        $subQuery->orWhere($column, 'LIKE', "%{$query}%");
                    }
                });
            })
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('pages.holidays.index', array_merge($commonData, compact('data')));
    }

    // Method untuk menampilkan halaman form data baru
    public function create()
    {
        //return view('pages.holidays.create');

        $commonData = $this->pakeGenerikData();

        // Kembalikan view dengan data yang diperlukan
        return view('pages.holidays.create', $commonData);
    }

    // Method untuk menyimpan data ke database
    public function store(Request $request)
    {

        //============= ambil ini dari controller ============
        // dari Validasi request sampai dengan ->save();
        //validate request
        $request->validate([
            'name' => 'required',
            'month' => 'required',
            'year' => 'required',
            'date' => 'required',
            'is_weekend' => 'required',
        ]);

        // Mendapatkan pengguna saat ini
        $user = $request->user();

        $holiday = new Holiday();
        $holiday->company_id = 1;
        $holiday->created_by = $user->id;
        $holiday->name = $request->name;
        $holiday->month = $request->month;
        $holiday->year = $request->year;
        $holiday->date = $request->date;
        $holiday->is_weekend = $request->is_weekend;
        $holiday->save();




        //===============samakan dengan controller STORE



        // Redirect ke halaman daftar absensi dengan pesan sukses
        return redirect()->route('holidays.index')->with('success', 'Holiday created successfully.');
    }


    public function show($id)
    {
        // $Holiday = Holiday::find($id);
        // return view('pages.holidays.show', compact('Holiday'));

        // Ambil item berdasarkan ID
        $item = Holiday::findOrFail($id);

        // Ambil data generik seperti kolom dan judul
        $commonData = $this->pakeGenerikData();

        // Kembalikan view dengan data yang diperlukan
        return view('pages.holidays.show', array_merge($commonData, compact('item')));
    }


    public function edit($id)
    {
        // $Holiday = Holiday::find($id);
        // return view('pages.holidays.edit', compact('Holiday'));

        $item = Holiday::findOrFail($id);
        $commonData = $this->pakeGenerikData();
        return view('pages.holidays.edit', array_merge($commonData, compact('item')));
    }


    public function update(Request $request, $id)
    {
        //============= ambil ini dari controller UPDATE ============
        // dari Validasi request sampai dengan ->save();
        //validate request
        $request->validate([
            'name' => 'required',
            'month' => 'required',
            'year' => 'required',
            'date' => 'required',
            'is_weekend' => 'required',
        ]);

        $holiday = Holiday::find($id);
        if (!$holiday) {
            return response([
                'message' => 'Holiday not found'
            ], 404);
        }

        $holiday->name = $request->name;
        $holiday->month = $request->month;
        $holiday->year = $request->year;
        $holiday->date = $request->date;
        $holiday->is_weekend = $request->is_weekend;
        $holiday->save();




        //===============samakan dengan controller UPDATE

        return redirect()->route('holidays.index')->with('success', 'Holiday updated successfully.');
    }


    public function destroy($id)
    {
        $Holiday = Holiday::find($id);

        if (!$Holiday) {
            return redirect()->route('holidays.index')->with('error', 'Holiday not found.');
        }

        $Holiday->delete();

        // Redirect ke halaman daftar absensi dengan pesan sukses
        return redirect()->route('holidays.index')->with('success', 'Holiday deleted successfully.');
    }
}
