<?php

namespace Database\Factories;

use App\Models\Administrator;
use App\Models\Department;
use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faculty>
 */
class FacultyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Faculty::class;
   

    public function definition()
    {
        $admin = Administrator::first();
        $department = Department::first();
        return [
            'id'         =>Str::uuid(),
            'first_name' => $this->faker->name(),
            'last_name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'mobile' => $this->faker->numerify('###-###-####'),
            'password' => bcrypt(12345678),
            'department_id'      => $department->id,
            'added_by'  => $admin->id
        ];
    }
}
