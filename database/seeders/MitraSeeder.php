<?php

namespace Database\Seeders;

use App\Models\Mitra;
use App\Models\User;
use Illuminate\Database\Seeder;

class MitraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::insert([
            'name' => 'Sella',
            'email' => 'admin@soyamilk.com',
            'password' => 'admin',
            'role' => 'admin'
        ]);

        $mitra = Mitra::insert([
            'user_id' => 1,
            'nama' => 'Sella',
            'email' => 'admin@soyamilk.com',
            'password' => 'admin',
            'no_telp' => '081234567890',
            'jenis_kelamin' => 'perempuan',
            'alamat' => 'Jember'
        ]);
    }
}
