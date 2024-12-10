<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin              = new Admin;
        $admin->first_name  = '翟';
        $admin->last_name   = '宇鑫';
        $admin->first_alias = 'zhai';
        $admin->last_alias  = 'yuxin';
        $admin->email       = 'zhaiyuxin103@hotmail.com';
        $admin->phone       = '18816545428';
        $admin->password    = Hash::make('Aa@123321');
        $admin->birthday    = '1996-10-03';
        $admin->save();
    }
}
