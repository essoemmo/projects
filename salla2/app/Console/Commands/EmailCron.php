<?php

namespace App\Console\Commands;

use App\Models\Email;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:cron';

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
        $emailCheck = DB::table('email')->where('status', 'pending')->get();
        foreach ($emailCheck as $check) {
            $user = User::findOrFail($check->user_id);
            $dataa = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'text_message' => $check->message,
            ];
            if (config("app.env") != "local") {
                Mail::send('emails.sendUser', $dataa, function ($message) use ($user) {
                    \App\sendemail::sendemail($message, $user);
                });
                Email::where('id', $check->id)->update([
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
