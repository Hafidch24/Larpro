<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate([
            'email' => 'admin@gmail.com',
        ], [
            'name' => 'Admin',
            'password' => Hash::make('password123'),
            'is_admin' => true,
        ]);

        // إذا كان المستخدم موجودًا مسبقًا، قم بتحديثه
        $user = User::where('email', 'admin@gmail.com')->first();
        if ($user) {
            $user->update([
                'name' => 'Admin',
                'password' => Hash::make('password123'),
                'is_admin' => true,
            ]);
        }

        $this->command->info('تم إنشاء/تحديث حساب المشرف بنجاح!');
    }

    
}