<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\Requests;
use App\Http\Requests\Api\V1\CreateRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\FilterRequest;
use App\Http\Resources\Api\V1\RequestsResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Mail\MailSender;
use App\Http\Requests\Api\V1\UpdateRequest;
use Illuminate\Support\Facades\Mail;

class RequestsController extends Controller
{
    public function RequestsAll(FilterRequest $request){
        $validated = $request->validated();
        $date_start=null;
        $date_end=null;
        if ($request->filled('date_start')){
            $date_start=date('d.m.Y H:i:s',strtotime($request->date_start));
        }
        if ($request->filled('date_end')){
            $date_end=date('d.m.Y H:i:s',strtotime($request->date_end));
        }
        $requests=Requests::query()
        ->when($request->query('status'), fn(Builder $query, $status) => $query->where('status', $status))
        ->when($date_start, fn(Builder $query,$date_start) => $query->where('created_at', '>=', $date_start))
        ->when($date_end, fn(Builder $query,$date_start) => $query->where('created_at', '<=', $date_end))
        ->orderBy('id')
        ->get();
        return response()->json($requests,200);
    }

    public function RequestSave(CreateRequest $request){
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

    public function RequestUpdate(UpdateRequest $request ,$id){

        Requests::where('id',$id)->update(['status' =>'Resolved','comment'=>$request->comment,'updated_at'=>date('d.m.Y')]);
        $requests=Requests::where('id',$id)->first();
        $message_out='Заявка с id  '.$id.' обработана. Пользователю '.$requests->name.' отправлено пиьсмо на почту'.$requests->email.'c сообщением :" '.$requests->comment.' "';
        Mail::to( $requests->email)->send(new MailSender ($request) );
        return response()->json($message_out,200);
    }

}
