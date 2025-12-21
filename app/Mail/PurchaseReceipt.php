<?php

namespace App\Mail;

use App\Models\User;
use App\Models\PluginSubscription;
use App\Models\License;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PurchaseReceipt extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $subscription;
    public $license;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, PluginSubscription $subscription, License $license)
    {
        $this->user = $user;
        $this->subscription = $subscription;
        $this->license = $license;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.purchase_receipt')
                    ->subject('Your Purchase Receipt - Assertivlogix');
    }
}
