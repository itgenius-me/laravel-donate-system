<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        // create users
        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'reference' => 'admin@admin.com',
        ]);
        $superAdmin->assignRole('Admin');

        $user = User::factory()->create([
            'name' => 'B',
            'email' => 'b@user.com',
            'reference' => 'admin@admin.com',
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'C',
            'email' => 'c@user.com',
            'reference' => 'admin@admin.com',
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'D',
            'email' => 'd@user.com',
            'reference' => 'admin@admin.com',
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'E',
            'email' => 'e@user.com',
            'reference' => 'admin@admin.com',
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'F',
            'email' => 'f@user.com',
            'reference' => 'admin@admin.com',
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'G',
            'email' => 'g@user.com',
            'reference' => 'b@user.com',
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'H',
            'email' => 'h@user.com',
            'reference' => 'b@user.com',
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'I',
            'email' => 'i@user.com',
            'reference' => 'd@user.com',
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'J',
            'email' => 'j@user.com',
            'reference' => 'd@user.com',
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'K',
            'email' => 'k@user.com',
            'reference' => 'f@user.com',
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'L',
            'email' => 'l@user.com',
            'reference' => 'i@user.com',
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'M',
            'email' => 'm@user.com',
            'reference' => 'i@user.com',
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'N',
            'email' => 'n@user.com',
            'reference' => 'i@user.com',
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'O',
            'email' => 'o@user.com',
            'reference' => 'i@user.com',
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'P',
            'email' => 'p@user.com',
            'reference' => 'i@user.com',
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'Q',
            'email' => 'q@user.com',
            'reference' => 'j@user.com',
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'R',
            'email' => 'r@user.com',
            'reference' => 'o@user.com',
        ]);
        $user->assignRole('User');
        
        $user = User::factory()->create([
            'name' => 'S',
            'email' => 's@user.com',
            'reference' => 'p@user.com',
        ]);
        $user->assignRole('User');
        
        $user = User::factory()->create([
            'name' => 'T',
            'email' => 't@user.com',
            'reference' => 'p@user.com',
        ]);
        $user->assignRole('User');
    }
}
