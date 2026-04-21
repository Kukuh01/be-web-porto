<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $response = Http::post('https://n8n.silvanus.my.id/webhook/6d7146a2-b735-4aef-b1e4-0e751a19d061', [
            'message' => $request->message,
            'sessionid' => $request->sessionId,
        ]);

        return response()->json($response->json());
    }
}