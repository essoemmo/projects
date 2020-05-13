<?php

namespace App\Console\Commands;

use App\Mail\SendUserEmail;
use App\Notifications\SendUser;
use App\User;
use Illuminate\Console\Command;

class sendUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendUsersCommand:cron';

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
        $sendCheck = \App\Models\SendUser::where('status', 'pending')->get();
        foreach ($sendCheck as $check) {
            if ($check->type == 'notify') {
                $user = User::findOrFail($check->user_id);
                $user->notify(new SendUser($check->user_id, $check->message));
                \App\Models\SendUser::where('id', $check->id)->update([
                    'status' => 'sent',
                ]);
            } else {
                $user = User::findOrFail($check->user_id);
                \Mail::to($user->email)->send(new SendUserEmail(['user' => $user, 'body' => $check->message]));
                \App\Models\SendUser::where('id', $check->id)->update([
                    'status' => 'sent',
                ]);
            }
        }

        echo 'done';
    }
}
