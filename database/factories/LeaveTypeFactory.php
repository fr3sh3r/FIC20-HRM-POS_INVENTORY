<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeaveType>
 */
class LeaveTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Daftar jenis cuti dengan status pembayaran
        $LeavesKu = [
            'Annual Leave' => ['Total Leaves' => 12, 'Max Leave per Month' => 1, 'Paid' => 1],
            'Sick Leave' => ['Total Leaves' => 6, 'Max Leave per Month' => null, 'Paid' => 1],
            'Maternity Leave' => ['Total Leaves' => 90, 'Max Leave per Month' => null, 'Paid' => 1],
            'Paternity Leave' => ['Total Leaves' => 5, 'Max Leave per Month' => null, 'Paid' => 1],
            'Bereavement Leave' => ['Total Leaves' => 3, 'Max Leave per Month' => null, 'Paid' => 1],
            'Marriage Leave' => ['Total Leaves' => 3, 'Max Leave per Month' => null, 'Paid' => 1],
            'Study Leave' => ['Total Leaves' => 5, 'Max Leave per Month' => 2, 'Paid' => 1],
            'Kesehatan pribadi' => ['Total Leaves' => 8, 'Max Leave per Month' => 2, 'Paid' => 0],
            'Kesehatan keluarga' => ['Total Leaves' => 5, 'Max Leave per Month' => 2, 'Paid' => 0],
            'Pendidikan atau pelatihan' => ['Total Leaves' => 15, 'Max Leave per Month' => 4, 'Paid' => 0],
            'Perjalanan pribadi' => ['Total Leaves' => 5, 'Max Leave per Month' => 2, 'Paid' => 0],
            'Masalah pribadi atau keluarga' => ['Total Leaves' => 7, 'Max Leave per Month' => 3, 'Paid' => 0],
            'Pengembangan diri' => ['Total Leaves' => 12, 'Max Leave per Month' => 2, 'Paid' => 0],
            'Relawan' => ['Total Leaves' => 2, 'Max Leave per Month' => 1, 'Paid' => 0],
            'Proses hukum' => ['Total Leaves' => 6, 'Max Leave per Month' => 3, 'Paid' => 0],
        ];

        static $index = 0; // Menyimpan indeks saat ini

        $keys = array_keys($LeavesKu);
        $count = count($keys);

        if ($count === 0) {
            throw new \Exception('Leave types array is empty');
        }

        // Menghindari index yang melebihi batas
        $leaveName = $keys[$index % $count];
        $index++;

        $leaveDetails = $LeavesKu[$leaveName];

        return [
            'company_id' => 1, // Ganti dengan ID perusahaan yang sesuai
            'name' => $leaveName,
            'is_paid' => $leaveDetails['Paid'], // Menentukan apakah cuti dibayar atau tidak
            'total_leaves' => $leaveDetails['Total Leaves'],
            'max_leave_per_month' => $leaveDetails['Max Leave per Month'],
            'created_by' => 1, // Ganti dengan ID user yang sesuai
        ];
    }
}
