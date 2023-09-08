<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Carbon\Carbon;
use App\Mail\ReminderMail;
use Illuminate\Support\Facades\Mail;

class ScheduledMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendMail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $target_date = Carbon::now()->addDay()->format('Y-m-d');
        $send_users = Reservation::with('user')->whereDate('reservation_time',$target_date)->get();
        $myPageUrl = url('/mypage');
        
        foreach ($send_users as $send_user){
            $shop_desc = url("/detail/{$send_user->shop_id}");
            mail::to($send_user->user->email)->send(new ReminderMail($shop_desc,$myPageUrl));
        }
    }
}
