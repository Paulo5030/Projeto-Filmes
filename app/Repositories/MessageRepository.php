<?php

namespace App\Repositories;

use App\Models\Message;

class MessageRepository
{
    public function setMessage(Message $message, $type)
    {
        session()->flash('message', $message->getMessage());
        session()->flash('type', $type);
        return redirect()->back();
    }
}