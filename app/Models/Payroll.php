<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'month',
        'year',
        'basic_salary',
        'net_salary',
        'total_days',
        'working_days',
        'present_days',
        'total_office_time',
        'total_worked_time',
        'half_day',
        'late_days',
        'paid_leaves',
        'unpaid_leaves',
        'holiday_count',
        'payment_date',
        'status',
    ];

    /*=================== Sementara tidak dipakai ==========
    protected $casts = [
        'basic_salary' => 'decimal:2',
        'net_salary' => 'decimal:2',
        'payment_date' => 'date',
        'total_days' => 'integer',
        'working_days' => 'integer',
        'present_days' => 'integer',
        'total_office_time' => 'integer',
        'total_worked_time' => 'integer',
        'half_day' => 'integer',
        'late_days' => 'integer',
        'paid_leaves' => 'integer',
        'unpaid_leaves' => 'integer',
        'holiday_count' => 'integer',
    ];


    protected $attributes = [
        'status' => 'generated',
    ];

    =============================*/

    // Penjelasan:

    // $fillable: Menentukan kolom mana yang dapat diisi secara massal (mass-assignable).
    // $casts: Mengatur casting otomatis dari tipe data saat diambil dari atau disimpan ke database.
    // $attributes: Menyediakan nilai default untuk kolom status.

    //  Penjelasan:
    // 'decimal:2': Atribut basic_salary dan net_salary akan secara otomatis dikonversi
    //ke tipe decimal dengan 2 angka desimal.
    // 'date': Atribut payment_date akan secara otomatis di-cast sebagai objek Carbon (tanggal).
    // 'integer': Atribut seperti total_days, working_days, dan lain-lain akan di-cast menjadi
    //tipe data integer.



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}



// Relasi: Payroll memiliki relasi belongsTo dengan model User dan Company,
//sesuai dengan foreign key yang ada pada migration.

//Protected $CAST
//protected $casts adalah properti pada model Laravel ]
//yang digunakan untuk menentukan bagaimana atribut model harus dikonversi (di-cast)
//ke tipe data tertentu ketika diakses atau disimpan.
//Dengan menggunakan $casts, Anda dapat memastikan bahwa atribut tertentu
//diinterpretasikan sebagai tipe data yang tepat tanpa harus melakukannya secara manual
//setiap kali atribut tersebut diakses.

// Manfaat:
// Konsistensi Data: Memastikan bahwa data selalu dalam format yang diharapkan saat disimpan atau
//diambil dari database.
// Mengurangi Kesalahan: Menghindari kesalahan yang mungkin terjadi
//karena data tidak di-cast dengan benar.
// Kemudahan Penggunaan: Laravel akan secara otomatis menangani casting ini di balik layar,
//sehingga Anda tidak perlu melakukan konversi manual di setiap tempat dalam kode Anda.


//protected $attributes adalah properti pada model Laravel yang digunakan untuk
//menetapkan nilai default bagi atribut tertentu pada model ketika model tersebut diinisialisasi.
//Ini berarti, jika Anda membuat instance baru dari model tersebut tanpa menetapkan nilai
//untuk atribut yang ditentukan di dalam $attributes, maka atribut tersebut akan secara otomatis
//diisi dengan nilai default yang Anda tentukan.

// Penjelasan:
// 'status' => 'generated': Artinya, setiap kali Anda membuat instance baru dari model tersebut dan Anda tidak menetapkan nilai untuk atribut status, Laravel akan secara otomatis menetapkan nilai 'generated' untuk atribut status.

// Manfaat:
// Mengatur Nilai Default: Anda dapat menetapkan nilai default untuk atribut-atribut tertentu
//tanpa harus menyetelnya secara manual setiap kali Anda membuat instance baru dari model tersebut.
// Konsistensi: Memastikan bahwa atribut-atribut yang memerlukan nilai default selalu memiliki nilai
// tersebut, yang dapat mencegah kesalahan atau ketidakcocokan data.
// Kemudahan Penggunaan: Mengurangi jumlah kode yang perlu ditulis saat membuat instance baru dari model.
