<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyNotification;
use Carbon\Carbon;
use App\Models\Task;

class SendDailyEmail extends Command
{
    protected $signature = 'email:daily';
    protected $description = 'Send a daily email notification';

    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->startOfDay();
        $end = Carbon::tomorrow()->endOfDay();
        print $tomorrow;
        print $end;
        $tasks = Task::whereBetween('due_date', [$tomorrow, $end])->where('due_date_notification_send', 'false')->get();
        
        foreach ($tasks as $task) {
            if ($task->user && $task->user->email) {
                Mail::to($task->user->email)->send(new DailyNotification($task));
                $task->due_date_notification_send = true;
                $task->save();
                $this->info("Sent reminder for Job ID: {$task->id}");
            }
        }
    }
}