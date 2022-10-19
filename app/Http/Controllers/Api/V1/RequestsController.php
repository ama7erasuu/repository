<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\Requests;
use App\Http\Requests\Api\V1\CreateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RequestsController extends Controller
{
    public function RequestsAll(Request $request){


        if($request->filled('status')){
            $s=Validator::make($request->all(), [
                'status' => [
                    Rule::In(['Active', 'Resolved']),
                ],
            ]);
            $s->validate();
            return response()->json(Requests::where('status',$request->status)->get(),200);
        }

        return response()->json(Requests::get(),200);
    }

    public function NewRequestSave(CreateRequest $request){
        $validated = $request->validated();
        $Requests= new Requests;
        $Requests->name=$request->name;
        $Requests->email=$request->email;
        $Requests->message=$request->message;
        $Requests->status='Active';
        $Requests->created_at=time();
        $Requests->updated_at=null;
        $Requests->save();
        $message_out='Благодарим вас - '.$Requests->name.' Ваша заявка с уникальным номер : '.$Requests->id.' принята к обработке. По результатам её обработки вы получите ответ на свою почту - '.$Requests->email;
        return response()->json($message_out,201);
    }


}
