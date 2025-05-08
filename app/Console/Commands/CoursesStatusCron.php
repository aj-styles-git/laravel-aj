<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\courses\Course;
use Carbon\Carbon;

class CoursesStatusCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cstatus:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change the status of the courses if they have expired running etc.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {

            // Get the current date and time
            $now = Carbon::now();

            // Fetch all courses from the database
            $courses = Course::whereNotIn('status', [0, 2,3])->get();


 

            foreach ($courses as $course) {
                $start_date = Carbon::parse($course->start_date);
                $end_date = Carbon::parse($course->end_date);

                if ($now->lt($start_date)) {
                    $status = 5;
                } elseif ($now->gte($start_date) && $now->lte($end_date)) {
                    $status = 4;
                } else {
                    $status = 6;
                }
             
                // Update the course status in the database
                $course->update(['status' => $status]);
            }

            $this->info('Course status updated successfully!');
        } catch (\Exception $e) {
            saveAppLog("Running the cron for course ");

        }
    }
}
