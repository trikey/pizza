<?php

namespace App\Listeners;

use SaleUser;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AttachSaleUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param Login $event
     * @return void
     */
    public function handle(Login $event)
    {
        if ($event->user->saleUser) {
            SaleUser::attachSaleUserCookie($event->user->saleUser);
        }
        else {
            SaleUser::attachUserToSaleUser($event->user->getAuthIdentifier());
        }
    }
}
