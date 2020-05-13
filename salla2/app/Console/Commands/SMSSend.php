<?php

namespace App\Console\Commands;

use App\Models\SMS;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SMSSend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $smsCheck = DB::table('sms')->where('status', 'pending')->get();
        foreach ($smsCheck as $check) {
            if (config("app.env") != "local") {
                \App\bll\SMS::SmsSender($check->to, $check->message);
                SMS::where('id', $check->id)->update([
                    'status' => 'sent',
                ]);
                echo 'done';
            } else {
                echo "your are on local";
            }
        }

        echo 'done';
    }
}
