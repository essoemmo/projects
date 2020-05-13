<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Help\Greg2HijriDate;

class Kernel extends ConsoleKernel {

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
    protected function schedule(Schedule $schedule) {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->call(function () {
            $year = date('Y');
            $greg_hijriDate = new Greg2HijriDate();
            $hijriDate = $greg_hijriDate->Greg2Hijri(1, 1, $year, false);
            $current_hijri_year = (int) $hijriDate["year"];
            //echo $hijri_year."pppppp";
            $data = DB::select("select MAX(created_at) as d from communications");
            if (count($data) > 0) {
                $last = substr($data[0]->d, 0, 4);
                $hijriDate = $greg_hijriDate->Greg2Hijri(1, 1, $last, false);
                $last_record = $hijriDate["year"];
                $current_hijri_year = 1441;
                if ($last_record != $current_hijri_year) {
                    //start archeive
                    DB::statement("insert into comm_operations_arch (comm_id,operation_type,destination,redirect_to_id,created,description,created_at,updated_at)" .
                            " select comm_id,operation_type,destination,redirect_to_id,created,description,created_at,updated_at from comm_operations");
                    DB::statement("delete from comm_operations");
                    DB::statement("insert into communications_arch (record_number,comm_type_id,creator_id,status,title,created,created_at,updated_at,year)" .
                            " select record_number,comm_type_id,creator_id,status,title,created,created_at,updated_at,{$last_record} from communications");
                    DB::statement("delete from communications");
                }
            }
        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands() {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

}
