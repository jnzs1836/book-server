<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
//use Illuminate\Validation\Validator;
//use Illuminate\Support\Facades\Validator;
//use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\Validator;

use App\Reward;
use App\Book;
use App\Record;
use App\User;
use App\Message;

class MessageController extends Controller{
    
    public function send(Request $request){
        $rules = ['receiver' => 'required', 'content' => 'required'];
        $this->validate($request,$rules);
        $message = new Message;
        // Retrive sender
        $user = $request->user();
        

        // Retrive receiver
        $receiver = User::where('id', '=', $request->receiver)->first();
        
        
        $status = 404;
        $res = [];
        if($receiver){
            $message->sender()->associate($user);
            $message->receiver()->associate($receiver);
            $message->read = false;
            $messages = $this->getMessages($user);
            $message->content = $request->input("content");
            if($message->save()){
                $res = ['sent'=> true, 'messages'=>$messages];
                $status = 200;
            }else{
                $res = ['sent'=> false];
                $status = 500;
            }
        }else{
            $res = ['sent'=> false, message => "user not exists"];
            $status = 403;
        }

        return response()->json($res, $status);        
    }


    public function getMessagesBetweenUsers($user1, $user2){
        $user1SentMessgaes = $user1->sentMessages;
        $user2SentMessgaes = $user2->receivedMessages;
        $messages = [];

        foreach($user1SentMessgaes as $message){
            if($message->receiver_id == $user2->id){
                $message->receiver_name = $user2->name;
                $message->sender_name = $user1->name;
                array_push($messages, $message);
            }
        }

        foreach($user2SentMessgaes as $message){
            if($message->receiver_id == $user1->id){
                $message->receiver_name = $user1->name;
                $message->sender_name = $user2->name;
                array_push($messages, $message);
            }
        }
        return $messages;
    }
    public function getMessages($user){
        $user->sentMessages;
        $sentMessgaes = $user->sentMessages;
        $receivedMessgaes = $user->receivedMessages;
        $messages = [];
        foreach($receivedMessgaes as $message){
            $message->receiver_name = $user->name;
            $message->sender_name = User::where('id', '=', $message->id);
            array_push($messages, $message);
        }

        foreach($sentMessgaes as $message){
            $message->receiver_name = User::where('id', '=', $message->id);
            $message->sender_name = $user->name;
            array_push($messages, $message);
        }
        return $messages;
    }

    public function receive(Request $request){
        
        // Retrive sender
        $user = $request->user();
        $user->sentMessages;
        $sentMessgaes = $user->sentMessages;
        $receivedMessgaes = $user->receivedMessages;
        $messages = [];
        foreach($receivedMessgaes as $message){
            $message->receiver_name = $user->name;
            $message->sender_name = User::where('id', '=', $message->id);
            array_push($messages, $message);
        }

        foreach($sentMessgaes as $message){
            $message->receiver_name = User::where('id', '=', $message->id);
            $message->sender_name = $user->name;
            array_push($messages, $message);
        }
        // $messages = array_merge($receivedMessgaes, $sentMessgaes);
        return response()->json(['messages' => $messages], 200);        
    }

    public function bookOwnerMessages(Request $request){
        $user = $request->user();
        $book = Book::where('id', '=', $request->input('book_id'))->first();

        $messages =  $this->getMessagesBetweenUsers($user, $book->owner);
        return response()->json(['talker_id' => $book->owner->id, 'talker_name' => $book->owner->name, 'messages'=>$messages], 200);   

    }
}
