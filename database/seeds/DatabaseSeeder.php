<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(StudentSeeder::class);
    }
}

class StudentSeeder extends Seeder {
    public function run() {
        DB::table('sinh_vien')->insert([
            'username' => '16022075',
            'password' => bcrypt('16022075'),
            'ho_ten' => 'Đoàn Trung Hiếu',
            'email' => '16022075@vnu.edu.vn',
            'lop_khoa_hoc' => 'k61t'
        ]);
    }
}

class TeacherSeeder extends Seeder {
    public function run() {
        DB::table('giang_vien')->insert([
            'username' => 'thuyhq',
            'password' => bcrypt('thuyhq'),
            'ho_ten' => 'Hà Quang Thụy',
            'email' => 'thuyhq@vnu.edu.vn',
        ]);
    }
}