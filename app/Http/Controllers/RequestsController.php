<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requests;

class RequestsController extends Controller
{
    //


    public function NewRequestSave(Request $req){
        $validated = $req->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'message' => 'required|max:500',
        ]);
        $Requests= new Requests;
        $Requests->name=$req->name;
        $Requests->email=$req->email;
        $Requests->message=$req->message;
        $Requests->status='Active';
        $Requests->created_at=time();
        $Requests->updated_at=null;
        $Requests->save();
        $message_out='Благодарим вас - '.$Requests->name.' Ваша заявка с уникальным номер : '.$Requests->id.' принята к обработке. По результатам её обработки вы получите ответ на свою почту - '.$Requests->email;
        return response()->json($message_out,201);
    }
}
