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
            'cellphone_code' => 44,
            'cellphone' => '20 8759 9036'
        ]);
        $superAdmin->assignRole('Admin');

        $user = User::factory()->create([
            'name' => 'User',
            'email' => 'user@user.com',
            'reference' => 'user@user.com',
            'cellphone_code' => 44,
            'cellphone' => '20 8759 5496'
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'User1',
            'email' => 'user1@user.com',
            'reference' => 'user@user.com',
            'cellphone_code' => 44,
            'cellphone' => '20 8759 5496'
        ]);
        $user->assignRole('User');
        $user = User::factory()->create([
            'name' => 'User2',
            'email' => 'user2@user.com',
            'reference' => 'user@user.com',
            'cellphone_code' => 44,
            'cellphone' => '20 8759 5496'
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'Use3r',
            'email' => 'user3@user.com',
            'reference' => 'user@user.com',
            'cellphone_code' => 44,
            'cellphone' => '20 8759 5496'
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'User4',
            'email' => 'user4@user.com',
            'reference' => 'user@user.com',
            'cellphone_code' => 44,
            'cellphone' => '20 8759 5496'
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'User5',
            'email' => 'user5@user.com',
            'reference' => 'user@user.com',
            'cellphone_code' => 44,
            'cellphone' => '20 8759 5496'
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'User6',
            'email' => 'user6@user.com',
            'reference' => 'user@user.com',
            'cellphone_code' => 44,
            'cellphone' => '20 8759 5496'
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'User7',
            'email' => 'user7@user.com',
            'reference' => 'user@user.com',
            'cellphone_code' => 44,
            'cellphone' => '20 8759 5496'
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'User8',
            'email' => 'user8@user.com',
            'reference' => 'user@user.com',
            'cellphone_code' => 44,
            'cellphone' => '20 8759 5496'
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'User9',
            'email' => 'user9@user.com',
            'reference' => 'user@user.com',
            'cellphone_code' => 44,
            'cellphone' => '20 8759 5496'
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'User10',
            'email' => 'user10@user.com',
            'reference' => 'user1@user.com',
            'cellphone_code' => 44,
            'cellphone' => '20 8759 5496'
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'User11',
            'email' => 'user11@user.com',
            'reference' => 'user1@user.com',
            'cellphone_code' => 44,
            'cellphone' => '20 8759 5496'
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'User12',
            'email' => 'user12@user.com',
            'reference' => 'user1@user.com',
            'cellphone_code' => 44,
            'cellphone' => '20 8759 5496'
        ]);
        $user->assignRole('User');

        $user = User::factory()->create([
            'name' => 'User13',
            'email' => 'user13@user.com',
            'reference' => 'user2@user.com',
            'cellphone_code' => 44,
            'cellphone' => '20 8759 5496'
        ]);
        $user->assignRole('User');

    }
}
