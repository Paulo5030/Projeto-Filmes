<?php

namespace App\Repositories;

use App\Models\Message;

class MessageRepository
{
    protected $message;
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function setMessage(Message $message, $type)
    {
        session()->flash('message', $message->getMessage());
        session()->flash('type', $type);
        return redirect()->back();
    }
}