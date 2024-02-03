<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sondage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SondageController extends Controller
{

    public function store(Request $request)
    {
        $data = $request->validate([
            'subject' => 'required|string',
            'questions' => 'required|array',
        ]);

        if (Auth::check()) {
            $user = Auth::user();
            $sondage = $user->sondages()->create([
                'subject' => $data['subject'],
                'questions' => json_encode($data['questions']),
            ]);

            return response()->json($sondage, 201);
        } else {
            
            return response()->json(['error' => 'Utilisateur non authentifié'], 401);
        }
        

        return response()->json($sondage, 201);
    
    }
}
