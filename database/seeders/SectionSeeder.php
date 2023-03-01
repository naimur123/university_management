<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $section = DB::table('sections')->insert([
            [
                "id"    => Str::uuid(),
                "name"  => "A",
                "reserved"  => false
               
            ],
            [
                "id"    => Str::uuid(),
                "name"  => "B",
                "reserved"  => false
                
            ],
            [
                "id"    => Str::uuid(),
                "name"  => "C",
                "reserved"  => false
                
            ],
            [
                "id"    => Str::uuid(),
                "name"  => "D",
                "reserved"  => false
                
            ],
            [
                "id"    => Str::uuid(),
                "name"  => "E",
                "reserved"  => false
                
            ],
            [
                "id"    => Str::uuid(),
                "name"  => "F",
                "reserved"  => false
                
            ],
            [
                "id"    => Str::uuid(),
                "name"  => "G",
                "reserved"  => false
                
            ],
            [
                "id"    => Str::uuid(),
                "name"  => "H",
                "reserved"  => false
                
            ],
            [
                "id"    => Str::uuid(),
                "name"  => "I",
                "reserved"  => false
                
            ],
            [
                "id"    => Str::uuid(),
                "name"  => "J",
                "reserved"  => false
                
            ],
            [
                "id"    => Str::uuid(),
                "name"  => "K",
                "reserved"  => true
                
            ],
            [
                "id"    => Str::uuid(),
                "name"  => "L",
                "reserved"  => true
                
            ],
            
            
        ]);
    }
}
