<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // crate a department
        // \App\Models\Department::create([
        //     'company_id' => 1,
        //     'created_by' => 1,
        //     'name' => 'IT',
        //     'description' => 'Information Technology',
        // ]);


        $departments = [
            ['name' => 'Information Technology', 'description' => 'Bertanggung jawab untuk mengelola infrastruktur teknologi informasi.'],
            ['name' => 'Human Resources', 'description' => 'Mengelola sumber daya manusia dan kesejahteraan karyawan.'],
            ['name' => 'Finance', 'description' => 'Bertanggung jawab untuk pengelolaan keuangan perusahaan.'],
            ['name' => 'Marketing', 'description' => 'Mengembangkan dan melaksanakan strategi pemasaran.'],
            ['name' => 'Sales', 'description' => 'Bertanggung jawab untuk menjual produk atau layanan perusahaan.'],
            ['name' => 'Operations', 'description' => 'Mengelola operasi sehari-hari perusahaan.'],
            ['name' => 'Customer Service', 'description' => 'Menyediakan dukungan dan layanan kepada pelanggan.'],
            ['name' => 'Research and Development', 'description' => 'Bertanggung jawab untuk inovasi produk dan pengembangan teknologi baru.'],
            ['name' => 'Legal', 'description' => 'Mengelola aspek hukum perusahaan.'],
            ['name' => 'Administration', 'description' => 'Mendukung operasional perusahaan dengan tugas administrasi.'],
            ['name' => 'Procurement', 'description' => 'Mengelola proses pengadaan barang dan jasa.'],
            ['name' => 'Public Relations', 'description' => 'Mengelola hubungan perusahaan dengan publik.'],
            ['name' => 'Quality Assurance', 'description' => 'Memastikan kualitas produk dan layanan sesuai standar.'],
            ['name' => 'Compliance', 'description' => 'Memastikan kepatuhan perusahaan terhadap peraturan.'],
            ['name' => 'Business Development', 'description' => 'Mengidentifikasi peluang bisnis baru dan pengembangan kemitraan.'],
        ];

        foreach ($departments as $department) {
            Department::create([
                'company_id' => 1, // Sesuaikan dengan ID perusahaan Anda
                'created_by' => 1, // Sesuaikan dengan ID user yang membuat data ini
                'name' => $department['name'],
                'description' => $department['description'],
            ]);
        }
    }
}
