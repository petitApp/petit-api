<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Chats_message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatContoller extends Controller
{
    public function createChat(Request $request)
    {
        $response = array('code' => 400, 'error_msg' => []);

        if (isset($request)) {
            if (!$request->id_animal_owner) array_push($response['error_msg'], 'Id owner is required');
            if (!$request->id_adopter) array_push($response['error_msg'], 'Id adopter is required');
            if (!$request->id_animal) array_push($response['error_msg'], 'Id animal or required');
            if (!count($response['error_msg']) > 0) {
                $chat = Chat::where('id_animal_owner', '=', $request->id_animal_owner)->where('id_adopter', '=', $request->id_adopter)
                    ->where('id_animal', '=', $request->id_animal)->first();
                if (!isset($chat)) {
                    try {
                        $chat = new Chat();
                        $chat->id_animal_owner = $request->id_animal_owner;
                        $chat->id_adopter = $request->id_adopter;
                        $chat->id_animal = $request->id_animal;
                        $chat->save();
                    } catch (\Exception $exception) {
                        $response = array('code' => 500, 'error_msg' => $exception->getMessage());
                    }
                }
                $chat->receiver = $chat->owner;
                $response = array('code' => 200, 'chat' => $chat, 'msg' => 'Chat found');
            }
        } else {
            $response['error_msg'] = 'Nothing to create';
        }

        return response($response, $response['code']);
    }

    //Get an specific chat by ID
    public function getChat($id)
    {
        $response = array('code' => 400, 'error_msg' => []);
        if (isset($id)) {

            try {
                $chat = Chat::find($id);
                if ($chat !== null) {
                    $response = array('code' => 200, 'messages' => $chat->messages,  'owner' => $chat->creator, 'adopter' => $chat->adopter);
                } else {
                    $response = array('code' => 404, 'error_msg' => ['chat not found']);
                }
            } catch (\Exception $exception) {
                $response = array('code' => 500, 'error_msg' => $exception->getMessage());
            }
        }
        return response($response, $response['code']);
    }

    public function createMessage(Request $request)
    {
        $response = array('code' => 400, 'error_msg' => []);

        if (isset($request)) {
            if (!$request->message) array_push($response['error_msg'], 'message owner is required');
            if (!$request->chat_id) array_push($response['error_msg'], 'chat id adopter is required');
            if (!$request->id_owner_message) array_push($response['error_msg'], 'id owner animal or gender is required');
            if (!count($response['error_msg']) > 0) {
                try {
                    $message = new Chats_message();
                    $message->message = $request->message;
                    $message->chat_id = $request->chat_id;
                    $message->id_owner_message = $request->id_owner_message;
                    $message->save();
                    $response = array('code' => 200, 'message' => $message, 'msg' => 'Message created');
                } catch (\Exception $exception) {
                    $response = array('code' => 500, 'error_msg' => $exception->getMessage());
                }
            }
        } else {
            $response['error_msg'] = 'Nothing to create';
        }

        return response($response, $response['code']);
    }
    //Get all animals function
    public function getAllUserChats($id)
    {
        $response = array('code' => 400, 'error_msg' => []);
        try {
            $chats = DB::table('chats')->where('id_adopter', $id)->orWhere('id_animal_owner', $id)->where('active', 1)->get();
            if (count($chats) > 0) {
                $chatArray = [];
                foreach ($chats as $chat) {
                    $chatData = Chat::find($chat->id);
                    if ($id == $chatData->id_animal_owner) {
                        $chatData->receiver = $chatData->adopter;
                    } else {
                        $chatData->receiver = $chatData->owner;
                    }
                    $chatArray[] = $chatData;
                }
                $response = array('code' => 200, 'chat' => $chatArray);
            } else {
                $response = array('code' => 404, 'error_msg' => ['chats not found']);
            }
        } catch (\Exception $exception) {
            $response = array('code' => 500, 'error_msg' => $exception->getMessage());
        }

        return response($response, $response['code']);
    }

    public function deactivateChat($id)
    {
        $response = array('code' => 400, 'error_msg' => []);
        try {
            $chat = Chat::find($id);
            if ($chat) {
                $chat->active = 0;
                $chat->save();
                $response = array('code' => 200, 'chat' => $chat);
            } else {
                $response = array('code' => 404, 'error_msg' => ['chats not found']);
            }
        } catch (\Exception $exception) {
            $response = array('code' => 500, 'error_msg' => $exception->getMessage());
        }

        return response($response, $response['code']);
    }
}
