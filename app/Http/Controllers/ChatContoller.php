<?php

namespace App\Http\Controllers;

use App\Chat;
use Illuminate\Http\Request;

class ChatContoller extends Controller
{
    public function createChat(Request $request)
    {   
        $response = array('code' => 400, 'error_msg' => []);

        if (isset($request)) {
            if (!$request->id_animal_owner) array_push($response['error_msg'], 'Id owner is required');
            if (!$request->id_adopter) array_push($response['error_msg'], 'Id adopter is required');
            if (!$request->id_animal) array_push($response['error_msg'], 'Id animal or gender is required');
            if (!count($response['error_msg']) > 0) { 
                try {
                    $chat = new Chat();
                    $chat->id_animal_owner = $request->id_animal_owner;
                    $chat->id_adopter = $request->id_adopter;
                    $chat->id_animal = $request->id_animal;
                    $chat->save();
                    $response = array('code' => 200, 'chat' => $chat, 'msg' => 'Chat created');
                } catch (\Exception $exception) {
                    $response = array('code' => 500, 'error_msg' => $exception->getMessage());
                }
            }

        } else {
            $response['error_msg'] = 'Nothing to create';
        }

       return response($response,$response['code']);
    }

     //Get an specific chat by ID
     public function getChat($id)
     {
         $response = array('code' => 400, 'error_msg' => []);
         if (isset($id)) {

             try {
                 $chat = Chat::find($id);
                 if ($chat!==null) {
                    $response = array('code' => 200, 'chat' => $chat->messages);
                } else {
                    $response = array('code' => 404, 'error_msg' => ['chat not found']);
                }
             } catch (\Exception $exception) {
                 $response = array('code' => 500, 'error_msg' => $exception->getMessage());
             }
             
         }
        return response($response,$response['code']);
     }
}
