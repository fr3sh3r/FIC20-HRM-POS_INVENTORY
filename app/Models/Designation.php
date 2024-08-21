<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'department_id', //bedanya dengan adalah ada field ini di tabel Designation
        'name',
        'created_by',
        'description', // Tambahan karena di seeder ada description
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
