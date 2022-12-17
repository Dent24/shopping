<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manage = Role::create([
            'name' => 'manage',
        ]);

        $user = User::find(1);
        $user->roles()->attach($manage);

        Role::create([
            'name' => 'customer',
        ]);
    }
}
