<?php

namespace App\Console\Commands;

use App\Status;
use App\User;
use Illuminate\Console\Command;

class RemindUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:remind {user?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends reminders to a user';

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
        $users = User::all();

        if ($this->argument('user') !== null) {
            $users = User::where('name', $this->argument('user'))
                        ->orWhere('id', $this->argument('user'));
        }

        $this->payments($users);
    }

    private function payments($users) {
        $verified = $users->filter(function($user, $key) {
           if ($user->status_id === Status::where('value', 'verified')->first()->id) {
               $user->sendPaymentReminderNotification();
           }
        });

    }
}
