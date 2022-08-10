<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    //For Sitmap 
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        //Add
         $schedule->call(function () {
            Log::info('[MainSite ADD] '.date("l jS \of F Y h:i:s A"));
            SitemapController::sitemapAdd();
        })->everyMinute();        
        //Update
         $schedule->call(function () {
            Log::info('[MainSite Update] '.date("l jS \of F Y h:i:s A"));
            SitemapController::sitemapUpdate();
        })->everyMinute();        
        //Delete
        // Log::info('[Start :'.date("l jS \of F Y h:i:s A").']');
        $schedule->call(function () {
            Log::info('[MainSite Delete] '.date("l jS \of F Y h:i:s A"));
            SitemapController::sitemapDelete();
        })->everyMinute();        
        // Log::info('[End :'.date("l jS \of F Y h:i:s A").']');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
