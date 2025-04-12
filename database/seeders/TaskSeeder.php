<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use Carbon\Carbon;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $tasks = [
            [
                'user_id' => 1,
                'title' => 'Complete project report',
                'description' => 'Finish the quarterly project report and submit to manager',
                'status' => '1',
                'due_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'order' => 1,
            ],
            [
                'user_id' => 1,
                'title' => 'Buy groceries',
                'description' => 'Milk, eggs, bread, fruits and vegetables',
                'status' => '2',
                'due_date' => Carbon::now()->addDays(1)->format('Y-m-d'),
                'order' => 2,
            ],
            [
                'user_id' => 1,
                'title' => 'Gym workout',
                'description' => 'Cardio and weight training session',
                'status' => '1',
                'due_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'order' => 3,
            ],
            [
                'user_id' => 1,
                'title' => 'Call mom',
                'description' => 'Check on mom and discuss family gathering',
                'status' => '1',
                'due_date' => Carbon::now()->addDays(1)->format('Y-m-d'),
                'order' => 4,
            ],
            [
                'user_id' => 1,
                'title' => 'Team meeting',
                'description' => 'Weekly team sync about project progress',
                'status' => '2',
                'due_date' => Carbon::now()->addHours(5)->format('Y-m-d'),
                'order' => 5,
            ],
            [
                'user_id' => 1,
                'title' => 'Movie night',
                'description' => 'Watch the new released movie with friends',
                'status' => '1',
                'due_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'order' => 6,
            ],
            [
                'user_id' => 1,
                'title' => 'Study for exam',
                'description' => 'Prepare for the upcoming mathematics exam',
                'status' => '1',
                'due_date' => Carbon::now()->addDays(7)->format('Y-m-d'),
                'order' => 7,
            ],
            [
                'user_id' => 1,
                'title' => 'Business proposal',
                'description' => 'Draft the business proposal for new client',
                'status' => '2',
                'due_date' => Carbon::now()->addDays(4)->format('Y-m-d'),
                'order' => 8,
            ],
            [
                'user_id' => 1,
                'title' => 'Dentist appointment',
                'description' => 'Regular dental checkup',
                'status' => '2',
                'due_date' => Carbon::now()->subDays(1)->format('Y-m-d'),
                'order' => 9,
            ],
            [
                'user_id' => 1,
                'title' => 'Friend\'s birthday',
                'description' => 'Buy gift and attend birthday party',
                'status' => '1',
                'due_date' => Carbon::now()->addDays(10)->format('Y-m-d'),
                'order' => 10,
            ],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}