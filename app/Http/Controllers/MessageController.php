<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function home($id)
    {
        $user_receiver = Users::findOrFail($id);
        $user_sender = Auth::user();
        $messages = Message::where(function ($query) use ($user_sender, $user_receiver) {
            $query->where('sender_id', $user_sender->id)->where('receiver_id', $user_receiver->id);
        })->orWhere(function ($query) use ($user_sender, $user_receiver) {
            $query->where('sender_id', $user_receiver->id)->where('receiver_id', $user_sender->id);
        })->get();

        return view('user.message', [
            'user_s' => $user_sender,
            'user_r' => $user_receiver,
            'messages' => $messages,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'receiver_id' => 'required|exists:users,id'
        ]);

        Message::create([
            'content' => $request->content,
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
        ]);

        return redirect()->route('message', ['id' => $request->receiver_id])
            ->with('success', 'Message sent successfully.');
    }



    public function show()
    {
        $user_sender = Auth::user();

        // Get all users that the sender has sent or received messages from/to
        $user_ids = Message::where('sender_id', $user_sender->id)
            ->orWhere('receiver_id', $user_sender->id)
            ->pluck('sender_id', 'receiver_id')
            ->unique()
            ->values();

        $user_receivers = Users::whereIn('id', $user_ids)->get();

        // Get all messages between the sender and each receiver
        $messages = Message::where(function ($query) use ($user_sender) {
            $query->where('sender_id', $user_sender->id)
                ->orWhere('receiver_id', $user_sender->id);
        })->get();

        // Get all users
        $all_users = Users::all();

        return view('user.showMessage', [
            'user_s' => $user_sender,
            'user_r' => $user_receivers,
            'messages' => $messages,
            'all_users' => $all_users,
        ]);
    }
}
