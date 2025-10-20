<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function saveToken(Request $request){

        $user = Auth::user();

        $tokensResult = User::where("token_firebase", $request->input("token"))
                        ->where("id_users", "!=", $user->id_users)
                        ->update(["token_firebase" => null]);

        
        $user->token_firebase = $request->input('token');
        $user->save();

        return response()->json([
            'status' => 200,
            'message' => 'Token enviado com sucesso',
            'data' => $user->refresh()
        ], 200);

    }

    public function sendTestNotification(Request $request)
    {


        $user = User::where("id_users",$request->input("id_destinatario"))->first();

        if(!$user->token_firebase){
            return response()->json(['error' => 'Usuário não tem token FCM'], 200);
        }

        $msg = $request->input("remetente")." (#".$request->input("codigo")."): ".$request->input("msg");

        $this->notificationService->sendToToken(
            $user->token_firebase,
            $request->input("status"),
            $msg,
            $request->input("codigo")
        );

        return response()->json(['message' => 'Notificação enviada com sucesso']);
    }
}
