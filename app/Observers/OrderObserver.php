<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderNotification;
use Illuminate\Support\Facades\Notification;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        $url = route('orders.index');
        $userId = $order->user_id;
        $email = User::whererole_id(1)->get();

        $details = [
            'greeting' => 'Greetings, ',
            'adminBody' => 'New Order was placed, with order id #' .$order->order_number .' Please click the button below to check the order details.',
            'body' => 'New Order was placed on your store, with order id #' .$order->order_number .' Please click the button below to check the order details.',
            'url' => $url,
            'userId' => $userId,
            'data' => 'New Order was placed on your store, with order id #' .$order->order_number .' Please click the button below to check the order details.',
            'actionText' => 'Click here',
            ];

            Notification::send($email, new OrderNotification($details));
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        //
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
