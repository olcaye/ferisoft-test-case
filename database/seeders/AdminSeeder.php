<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole  = Role::firstOrCreate(['name' => 'admin']);
        $editorRole = Role::firstOrCreate(['name' => 'editor']);

        $admin = User::firstOrCreate(['email' => 'admin@admin.com'],
            [
                'name'     => 'Olcay E.',
                'password' => Hash::make('password123'),
            ]);

        if (!$admin->roles()->where('name', 'admin')->exists()) {
            $admin->roles()->attach($adminRole);
        }

        $editor = User::firstOrCreate(['email' => 'editor@editor.com'],
            [
                'name'     => 'Bilge E.',
                'password' => Hash::make('password123'),
            ]);

        if (!$editor->roles()->where('name', 'editor')->exists()) {
            $editor->roles()->attach($editorRole);
        }

        echo 'success';
    }
}
