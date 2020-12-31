<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    function newChat(Request $request , $id){


      $Check = DB::table("chat")
      ->where('sender_id' , $id)
      ->where('receiver_id' ,  $request['receiver_id'])
      ->first();



      if(!$Check){
        $new = DB::table("chat")->insertGetId([
        'sender_id' => $id,
        'receiver_id' => $request['receiver_id'],
        'created_at' => date("Y-m-d H:i:s"),
      ]);
        
       
      }else {
        $new = $Check->id;
      }
      
      
       if($new){
          
        return $this->getChat($new);

      }else {
        return response_api(false, 422, null, []);
      }
      
      
      
      

    }


    function getChat($id){

      $GetChat = DB::table("chat")->where('id' , $id)->first();
      $GetChat = json_decode( json_encode($GetChat) , true);
      
      if($GetChat){
          $GetMsgs = DB::table("chat_msgs")->where('chat_id' , $id)->get();
          
        $GetChat['sender_info'] = DB::table("users")->where('id' , (int)$GetChat['sender_id'])->select("id" , "username" , "image" , "type")->first();
        $GetChat['receiver_info'] = DB::table("users")->where('id' , (int)$GetChat['receiver_id'])->select("id" ,"username" , "image" , "type")->first();

          
        return response_api(true, 200,  "The Chat Opend", ["chat" => $GetChat , "msgs" => $GetMsgs]);

      }else {
        return response_api(false, 422, "Not found the chat", []);
      }

    }

    function getChats($id){

      $GetChats = DB::table("chat")->where(['sender_id' => $id])->orWhere(['receiver_id' => $id])->get();

      if($GetChats->count() > 0){
        $GetChats = json_decode( json_encode($GetChats) , true);



        foreach ($GetChats as $key => $value) {
          $GetChats[$key]['type'] = $value['sender_id'] == $id ? "sender" : "receiver" ;

          if($value['sender_id'] == $id){
              $GetChats[$key]['receiver_info'] = DB::table("users")->where('id' , (int)$value['receiver_id'])->select("id" , "username" , "image" , "type")->first();
          }else {
            $GetChats[$key]['receiver_info'] = DB::table("users")->where('id' , (int)$value['sender_id'])->select("id" , "username" , "image" , "type")->first();
          }
        }

        return response_api(true, 200,  "The Chats found", ["chats" => $GetChats]);

      }else {
        return response_api(false, 422, "Not found the chats", []);
      }

    }




    function SendMsg(Request $request , $id){

      $new = DB::table("chat_msgs")->insert([
        'chat_id' => $id,
        'sender_id' => $request['sender_id'],
        'data' => json_encode($request['data']),
        'state' => 'send',
        'created_at' => date("Y-m-d H:i:s"),
      ]);

      if($new){

        return response_api(true, 200,  "The Msg send", [$new]);

      }else {
        return response_api(false, 422, null, []);
      }

    }




}
