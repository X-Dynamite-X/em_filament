<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Employee::create([
            "country_id" => "1",
            "state_id" => "1",
            "city_id" => "1",
            "department_id" => "1",
            "user_id" => "1",
            "team_id" => "1",

            "address" =>
            "Deleniti eius et voluptas cupiditate distinctio Anim cumque ut doloremque aute cumque",
            "zip_code" => "90013",
            "date_of_birth" => date("2003-08-27"), // تم تصحيح التنسيق هنا
            "date_hired" => date("1995-03-31"), // تم تصحيح التنسيق هنا

        ]);
        Employee::create([
            "country_id" => "1",
            "state_id" => "1",
            "city_id" => "1",
            "department_id" => "1",
            "user_id" => "2",
            "team_id" => "2",

            "address" =>
            "Deleniti eius et voluptas cupiditate distinctio Anim cumque ut doloremque aute cumque",
            "zip_code" => "90013",
            "date_of_birth" => date("2003-08-27"), // تم تصحيح التنسيق هنا
            "date_hired" => date("1995-03-31"), // تم تصحيح التنسيق هنا
        ]);
    }
}
