<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageStoreRequest;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MessageController extends Controller
{

    public function index(): AnonymousResourceCollection
    {
        $messages = Message::all();

        return MessageResource::collection($messages);
    }

    public function store(MessageStoreRequest $request)
    {
        $params = $request->validated();
        $message = Message::create($params);

        return MessageResource::make($message);
    }

    public function show(Message $message)
    {
        return MessageResource::make($message);
    }

    public function destroy(Message $message): MessageResource
    {
        $message->delete();

        return MessageResource::make($message);
    }
}
