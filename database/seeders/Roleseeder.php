<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Roleseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Defining Roles
        Role::create(['name' => 'patient']);
        Role::create(['name' => 'driver']);
        Role::create(['name' => 'admin']);
    }
}
