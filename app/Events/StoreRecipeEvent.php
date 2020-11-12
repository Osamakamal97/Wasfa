<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StoreRecipeEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $images;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($images)
    {
        $this->images = $images;
    }
}
