<?php

namespace App\Http\Controllers;

use App\Events\ChatMessagePublished;
use App\Http\Requests\ChatStoreRequest;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Message::with('user')->select('id', 'user_id','content')->get();

        return inertia('Chat/IndexPage', [
            'messages' => $messages
        ]);
    }

    public function store(ChatStoreRequest $request)
    {
        $message = new Message([
            'user_id' => auth()->id(),
            'content' => $request['content']
        ]);
        $message->save();

        Event::dispatch(new ChatMessagePublished());

        return redirect()->route('chat.index');
    }
}
