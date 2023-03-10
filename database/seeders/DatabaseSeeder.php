<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\College;
use App\Models\Competency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        College::create([
            'college_name' => 'Institute of Computer Studies',
            'supervisor' => 3,
            'coordinator' => 2
        ]);
        College::create([
            'college_name' => 'College of Arts and Sciences'
        ]);
        College::create([
            'college_name' => 'College of Engineering'
        ]);
        College::create([
            'college_name' => 'College of Business and Public Administration'
        ]);
        User::create([
            'name' => 'Mam Joff',
            'role_as' => 3,
            'teacher' => 'Yes',
            'position' => 'LND Officer',
            'email' => 'mamJoff@gmail.com',
            'yearJoined' => fake()->date(),
            'yearinPosition' => fake()->date(),
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password
        ]);
        User::create([
            'college_id' => 1,
            'name' => 'Bryan Arellano',
            'role_as' => 1,
            'teacher' => 'Yes',
            'position' => 'LND Coordinator',
            'email' => 'bryanArellano@gmail.com',
            'yearJoined' => fake()->date(),
            'yearinPosition' => fake()->date(),
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password
        ]);
        User::create([
            'college_id' => 1,
            'name' => 'Mam Jo',
            'role_as' => 2,
            'teacher' => 'Yes',
            'position' => 'Supervisor',
            'email' => 'mamJo@gmail.com',
            'yearJoined' => fake()->date(),
            'yearinPosition' => fake()->date(),
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password
        ]);
        User::create([
            'college_id' => 1,
            'name' => 'Clerk Name',
            'role_as' => 4,
            'teacher' => 'Yes',
            'position' => 'Clerk',
            'email' => 'clerk@gmail.com',
            'yearJoined' => fake()->date(),
            'yearinPosition' => fake()->date(),
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password
        ]);
         

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

         Competency::create([
             'competency_group' => 'Core', 
             'competency_name' => 'Exemplifying integrity and professionalism',
             'teaching' => 1,
             'nonteaching' => 1,
         ]);
         Competency::create([
            'competency_group' => 'Core', 
            'competency_name' => 'Delivering services excellent',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Core', 
            'competency_name' => 'Solving Problems and Making Decisions',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Core', 
            'competency_name' => 'Thinking Strategically and Creatively',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Core', 
            'competency_name' => 'Initiatives for Improvement',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Core', 
            'competency_name' => 'Customer Focus',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);



        //Functional

        Competency::create([
            'competency_group' => 'Functional', 
            'competency_name' => 'ICT Skills/Computer Skills',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);

        Competency::create([
            'competency_group' => 'Functional', 
            'competency_name' => 'Teaching for Independent Training',
            'teaching' => 1,
            'nonteaching' => 0,
        ]);
        Competency::create([
            'competency_group' => 'Functional', 
            'competency_name' => 'Managing Conducive Learning Environment',
            'teaching' => 1,
            'nonteaching' => 0,
        ]);
        Competency::create([
            'competency_group' => 'Functional', 
            'competency_name' => 'Searching for New Knowledge',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Functional', 
            'competency_name' => 'Transferring New Knowledge to Beneficiaries',
            'teaching' => 1,
            'nonteaching' => 0,
        ]);
        Competency::create([
            'competency_group' => 'Functional', 
            'competency_name' => 'Communication Skills',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Functional', 
            'competency_name' => 'Written Communication/Writing Skills',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Functional', 
            'competency_name' => 'Attention to Detail',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Functional', 
            'competency_name' => 'Result Orientation',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Functional', 
            'competency_name' => 'Presentation Skills',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Functional', 
            'competency_name' => 'Policy Interpretation and Implementation',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Functional', 
            'competency_name' => 'Leading Self',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Functional', 
            'competency_name' => 'Leading Others',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Functional', 
            'competency_name' => 'Data Management and Process Knowledge',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Functional', 
            'competency_name' => 'Technical Learning',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Functional', 
            'competency_name' => 'Organizational Skills',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Functional', 
            'competency_name' => 'Planning',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Functional', 
            'competency_name' => 'Intellectual Acumen',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);

        //Leadership
        Competency::create([
            'competency_group' => 'Leadership', 
            'competency_name' => 'Managing Performance and Coaching for Results',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Leadership', 
            'competency_name' => 'Leading/Managing Change',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Leadership', 
            'competency_name' => 'Building Collaborative and Inclusive Working Relationship',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);
        Competency::create([
            'competency_group' => 'Leadership', 
            'competency_name' => 'Creating and Nurturing a High Performance Organization',
            'teaching' => 1,
            'nonteaching' => 1,
        ]);

        //\App\Models\Idp::factory(10)->create();

    }
}
