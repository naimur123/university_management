<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $department = Department::first();
        DB::table('courses')->insert([
            [
                "id"    => Str::uuid(),
                "code" =>"MAT1102",
                "course_name" =>"DIFFERENTIAL CALCULUS & CO-ORDINATE GEOMETRY",
                "prereq"      =>"N/A",
                "credit"      => 3,
                "sem"      => 1,
                "department_id"      => $department->id,
            ],
            [
                "id"    => Str::uuid(),
                "code" =>"PHY 1101",
                "course_name" =>"PHYSICS 1",
                "prereq"      =>"N/A",
                "credit"      => 3,
                "sem"      => 1,
                "department_id"      => $department->id,
            ],
            [
                "id"    => Str::uuid(),
                "code" =>"PHY 1102",
                "course_name" =>"PHYSICS 1 LAB",
                "prereq"      =>"N/A",
                "credit"      => 1,
                "sem"      => 1,
                "department_id"      => $department->id,
            ],
            [
                "id"    => Str::uuid(),
                "code" =>"ENG 1101",
                "course_name" =>"ENGLISH READING SKILLS & PUBLIC SPEAKING",
                "prereq"      =>"N/A",
                "credit"      => 3,
                "sem"      => 1,
                "department_id"      => $department->id,
            ],
            [
                "id"    => Str::uuid(),
                "code" =>"CSC 1101",
                "course_name" =>"INTRODUCTION TO COMPUTER STUDIES",
                "prereq"      =>"N/A",
                "credit"      => 1,
                "sem"      => 1,
                "department_id"      => $department->id,
            ],
            [
                "id"    => Str::uuid(),
                "code" =>"CSC 1103",
                "course_name" =>"INTRODUCTION TO PROGRAMMING LAB",
                "prereq"      =>"N/A",
                "credit"      => 1,
                "sem"      => 1,
                "department_id"      => $department->id,
            ],
            [
                "id"    => Str::uuid(),
                "code" =>"CSC 1102",
                "course_name" =>"INTRODUCTION TO PROGRAMMING",
                "prereq"      =>"N/A",
                "credit"      => 1,
                "sem"      => 1,
                "department_id"      => $department->id,
            ],
            

        ]);
    }
}
