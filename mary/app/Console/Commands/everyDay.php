<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class everyDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'day:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check the table user_login to date';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = DB::table('user_logins')->where('active_data',date('y-m-d'))->get();
            foreach ($date as $dat){
                $users = User::where('id',$dat->user_id)->get();
                foreach ($users as $user){
                    User::where('id',$user->id)->update([
                        'userlog' => 1,
                    ]);
                }
            }

            echo 'done';
    }
}
