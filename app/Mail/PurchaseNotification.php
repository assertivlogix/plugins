<?php

namespace App\Mail;

use App\Models\User;
use App\Models\PluginSubscription;
use App\Models\License;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PurchaseNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $subscription;
    public $license;
    public $product;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, PluginSubscription $subscription, License $license, Product $product)
    {
        $this->user = $user;
        $this->subscription = $subscription;
        $this->license = $license;
        $this->product = $product;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.purchase_notification')
                    ->subject('New Purchase Notification - ' . $this->product->name);
    }
}

