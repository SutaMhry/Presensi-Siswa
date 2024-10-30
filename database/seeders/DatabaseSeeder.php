<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Classroom;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'telp' => '081234567890',
        //     'address' => 'Sukoreno',
        // ]);

        // Classroom::create([
        //     'name' => 'XII RPL 1',
        //     'hmteacher_id' => 1,
        // ]);
        // Classroom::create([
        //     'name' => 'XII RPL 2',
        //     'code' => 'abbddff',
        //     'hmteacher' => 'Setyo Puji',
        // ]);

        User::create([
            'name' => 'Admin Maharaya',
            'email' => 'admin@gmail.com',
            'password' => 'admin',
            'role' => 'admin',
            'telp' => '081234435665',
            'address' => 'Semboro',
        ]);

        // User::create([
        //     'name' => 'Ms, Fara',
        //     'nip' => '199205142023052008',
        //     'birth' => '1995-01-01',
        //     'email' => 'msfara@gmail.com',
        //     'password' => '123',
        //     'role' => 'teacher',
        //     'telp' => '081233445566',
        //     'address' => 'Umbulsari',
        // ]);

        // User::create([
        //     'name' => 'Petit Maharaya Suta',
        //     'nisn' => '12345678',
        //     'birth' => '2002-01-01',
        //     'classroom_id' => 1,
        //     'email' => 'blablabla@gmail.com',
        //     'password' => '123',
        //     'role' => 'student',
        //     'telp' => '081234567890',
        //     'address' => 'Sukoreno',
        // ]);
        // User::create([
        //     'name' => 'Suta Maharaya Petit',
        //     'nisn' => '12345678',
        //     'birth' => '1995-01-01',
        //     'classroom_id' => 1,
        //     'email' => 'blablabla1@gmail.com',
        //     'password' => 'petit1234',
        //     'role' => 'student',
        //     'telp' => '081234567890',
        //     'address' => 'Sukoreno',
        // ]);

        // Classroom::create([
            
        // ])
    }
}
