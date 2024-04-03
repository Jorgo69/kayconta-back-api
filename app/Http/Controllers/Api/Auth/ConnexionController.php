<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\ConnexionRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ConnexionController extends Controller
{
    /** Incription */

    public function register(ConnexionRequest $request)
    {
        try {
            $register = User::create([
            'name' => $request['name'],
            'firstname' => $request['firstname'],
            'country' => $request['country'],
            'gender' => $request['gender'],
            'birthdate' => $request['birthdate'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            ]);
            // Envoi du jeton d'authentification
            $token = $register->createToken('auth_token')->plainTextToken;  
            // $register = new User();
            
    
            // dd($register);
    
            
            
            // $register->save();
    
             // Envoyer l'e-mail de confirmation
            // Mail::to($register->email)->send(new ConfirmationMail($register));
    
                return response()->json([
                    'status' => 'success',
                    'status_code' => 'Compte cree avec success',
                    'auth_token' => $token,
                    'data' => $register,
    
                ], 200);
                
            } catch (Exception $exception) {
                return response()->json($exception);
            }
    }
}
