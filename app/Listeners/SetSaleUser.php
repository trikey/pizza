<?php

namespace App\Listeners;

use App\Lib\Sale\SaleUserHelper;
use App\SaleUser;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetSaleUser
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
        $userId = $event->user->getAuthIdentifier();
        SaleUserHelper::attachUserToSaleUser($userId);
    }
}
