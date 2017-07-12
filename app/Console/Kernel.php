<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use DB;
use Storage;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
    protected function schedule(Schedule $schedule)
    {
          $schedule->call(function(){

          $sources = [1,2];
          foreach ($sources as $source) {
                
            }  
          $filename = '/admin/files/statuscard/statuscard-21-' . date('ymd') . '-0000' . $source . '.txt';
          $short_filename = 'statuscard-21-' . date('ymd') . '-0000' . $source . '.txt';
          $path = public_path() . '/admin/files/statuscard/' . $short_filename;
          $fp = fopen($path, 'w');
      
          $status_count = 0;
          if ($cards = DB::table('ETK_BLOCKLISTS')
                      ->where('source', $source)
                      ->where('is_loaded', 0)
                      ->get()){
            foreach ($cards as $card) {
              $status_count++;
              $row = $card->chip . "\t" . $card->operation_type . "\r\n";
              fwrite($fp, $row);
            };
            fclose($fp);
            if (DB::table('ETK_STATUSCARDS')
                ->insert(['filename' => $filename,
                          'status_count' => $status_count,
                          'created_by' => 0])){
            DB::table('ETK_BLOCKLISTS')
              ->where('source', $source)
              ->where('is_loaded', 0)
              ->update(['is_loaded' => 1]);
            /**
             * LOAD FILE TO FTP
             */
            $ftp_file = fopen($path, 'r');
            Storage::disk('ftp-cott-blocklists')->put($short_filename, $ftp_file);
            fclose($ftp_file);
            }
          }
    })->dailyAt('10:35'); 

    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
