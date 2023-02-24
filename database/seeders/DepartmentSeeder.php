<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $department = DB::table('departments')->insert([
            [
                "name"  => "Faculty of Science and Technology",
                "curriculum"  => "Bachelor of Science in Computer Science & Engineering",
                "total_credit"  => 148,
                "added_by"  => 1
            ],
            [
                "name"  => "Faculty of Arts and Social Sciences",
                "curriculum"  => "Bachelor of Laws (LL.B.)",
                "total_credit"  => 130,
                "added_by"  => 1
            ]
            
            
        ]);
    }
}
