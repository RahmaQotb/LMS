<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء مستخدم مدير
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // كلمة المرور: password
            'is_admin' => 1, // مستخدم مدير
        ]);

        // إنشاء مستخدم عادي
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'), // كلمة المرور: password
            'is_admin' => 0, // مستخدم عادي
        ]);

        // إنشاء 10 مستخدمين عشوائيين
        User::factory(10)->create();
    }
}