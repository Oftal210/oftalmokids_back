<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use App\Models\Foro;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Support\Facades\Log;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


class ForoCreado implements ShouldBroadcast
{
    public $mensaje;

    public function __construct($mensaje)
    {
        $this->mensaje = $mensaje;
    }

    public function broadcastOn()
    {
        return ['canal-publico'];
    }

    public function broadcastWith()
    {
        return [
            'mensaje' => $this->mensaje
        ];
    }

    public function broadcastAs()
    {
        return 'mi-evento-publico';
    }
}
