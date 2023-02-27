<?php

namespace Database\Seeders;

use App\Models\Administrator;
use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $admin = Administrator::first();
       $department = DB::table('departments')->insert([
            [
                "id"    => Str::uuid(),
                "name"  => "Faculty of Science and Technology",
                "curriculum"  => "Bachelor of Science in Computer Science & Engineering",
                "curriculum_short_name"  => "cse",
                "total_credit"  => 148,
                "added_by"  => $admin->id
            ],
            [
                "id"    => Str::uuid(),
                "name"  => "Faculty of Arts and Social Sciences",
                "curriculum"  => "Bachelor of Laws (LL.B.)",
                "curriculum_short_name"  => "law",
                "total_credit"  => 130,
                "added_by"  => $admin->id
            ]
            
            
        ]);
    }
}
