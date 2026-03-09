<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class FeishuChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        if (! $url = $notifiable->routeNotificationFor('feishu')) {
            return;
        }

        $message = $notification->toFeishu($notifiable);

        Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($url, $message);
    }
}
