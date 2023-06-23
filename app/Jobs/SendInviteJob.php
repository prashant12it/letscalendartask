<?php

namespace App\Jobs;

use App\Mail\SendInviteEmail;
use Illuminate\Bus\Queueable;
use App\Models\CampaignAttendees;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendInviteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        try {
            $email = $this->data['email'];
            if(Mail::to($email)->send(new SendInviteEmail($this->data))){
                $attendee = CampaignAttendees::find($this->data['id']);
                $attendee->invite_sent = 1;
                $attendee->invite_sent_at = Carbon::now()->format('Y-m-d H:i:s');
                $attendee->save();
            }
        } catch (Throwable $th) {
            Log::debug('Invite failure Throw',[$th->getMessage()]);
            throw new Exception($th->getMessage());
        }
    }
}
