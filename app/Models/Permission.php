<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name',
        'description',
        'module_name',
    ];

    public function roles()
    {
        //return $this->belongsToMany(Role::class, 'permission_role');
        return $this->belongsToMany(Role::class, 'permission_roles');
    }
}


// Catatan:
// Nama tabel pivot yang Anda gunakan adalah permission_roles, sedangkan di model Anda sebelumnya menggunakan 'permission_role'. Untuk konsistensi, sebaiknya Anda pastikan nama tabelnya sama baik di migrasi maupun di model.
// Jika Anda memutuskan untuk menggunakan permission_roles, maka di model Permission dan Role, Anda perlu mengganti nama tabel pivot menjadi permission_roles:
