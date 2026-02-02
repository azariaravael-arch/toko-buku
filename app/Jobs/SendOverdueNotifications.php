<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendOverdueNotifications implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $overdueBorrowings = \App\Models\Borrowing::where('status', 'borrowed')
            ->where('return_date', '<', now())
            ->get();

        foreach ($overdueBorrowings as $borrowing) {
            $borrowing->update(['status' => 'overdue']);

            \Illuminate\Support\Facades\Mail::to($borrowing->user->email)
                ->send(new \App\Mail\OverdueBookNotification($borrowing));
        }
    }
}
