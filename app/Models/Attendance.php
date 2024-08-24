<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'leave_id',
        'leave_type_id',
        'holiday_id',
        'date',
        'is_holiday',
        'is_leave',
        'clock_in_date_time',
        'clock_out_date_time',
        'total_duration',
        'is_late',
        'is_half_day',
        'is_paid',
        'status',
        'reason'
    ];

//Tidak semua foreignId dalam tabel harus dibuatkan fungsi tersendiri di dalam model,
//tetapi jika Anda ingin membuat relasi antar model,
//maka Anda perlu mendefinisikan fungsi relasi di dalam model untuk setiap foreignId
//yang merepresentasikan hubungan antar tabel.

// Apa itu Fungsi Relasi?
// Fungsi relasi di dalam model digunakan untuk mendefinisikan bagaimana model tersebut
//berhubungan dengan model lain. Laravel menyediakan beberapa tipe relasi, seperti :
//hasOne, hasMany, belongsTo, belongsToMany, dll.


    // Definisikan relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Definisikan relasi ke Company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Definisikan relasi ke Leave
    public function leave()
    {
        return $this->belongsTo(Leave::class);
    }

    // Definisikan relasi ke LeaveType
    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }

    // Definisikan relasi ke Holiday
    public function holiday()
    {
        return $this->belongsTo(Holiday::class);
    }

}

/**
 * Kegunaan Fungsi Relasi:
 *Dengan mendefinisikan fungsi relasi,
 *Anda dapat dengan mudah mengakses data terkait dari model yang berbeda.

 *Contohnya:
 *
 * Mengambil user terkait dengan attendance tertentu
 *$attendance = Attendance::find(1);
 *$user = $attendance->user;
 *
 *Mengambil nama perusahaan dari attendance tertentu
 *$companyName = $attendance->company->name;
 *
 *Apakah Harus Membuat Fungsi Relasi untuk Setiap foreignId?
 *Tidak harus, tetapi sangat dianjurkan untuk memudahkan akses dan manipulasi data terkait.
 *Jika Anda tidak membuat fungsi relasi, Anda tetap bisa mengakses ID secara langsung,
 *tetapi Anda kehilangan kemampuan untuk dengan mudah mengakses model yang terkait.
 *
 *Jadi, meskipun tidak wajib,
 *mendefinisikan fungsi relasi untuk setiap foreignId di model Anda
 *sangat disarankan untuk menjaga kemudahan dan konsistensi
 *dalam pengelolaan relasi antar model.
 *
 *
 *
 *
 */


