<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Models\Foro;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Support\Facades\Log;

class ForoCreado extends Notification
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $foro;
    public $documento;

    /**
     * Create a new notification instance.
     */
    public function __construct(Foro $foro, $documento)
    {
        $this->foro = $foro;
        $this->documento = $documento;
    }

    public function broadcastOn() { 
        return new PrivateChannel('App.Models.User.' . $this->documento);
    }
    
    public function broadcastWith() {

        Log::info('Datos enviados a Pusher', [
            'foro_id' => $this->foro->id,
            'titulo' => $this->foro->subtitulo_foro,
            'descripcion' => $this->foro->contenido_foro,
            'documento' => $this->documento,
        ]);

        return [
            'foro_id' => $this->foro->id,
            'titulo' => $this->foro->subtitulo_foro,
            'descripcion' => $this->foro->contenido_foro,
            'documento' => $this->documento,
        ];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['broadcast'];
    }

    public function toBroadcast($notifiable) {
        return new BroadcastMessage([
            'foro_id' => $this->foro->id,
            'titulo' => $this->foro->subtitulo_foro,
            'descripcion' => $this->foro->contenido_foro,
            'documento' => $this->documento,
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'foro_id' => $this->foro->id,
            'titulo' => $this->foro->subtitulo_foro,
            'descripcion' => $this->foro->contenido_foro,
            'documento' => $this->documento,
        ];
    }
}
