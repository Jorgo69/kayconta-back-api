<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ConnexionController extends Controller
{
    /** Incription */

    public function register(RegisterRequest $request)
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
            // $token = $register->createToken('auth_token')->plainTextToken;
    
             // Envoyer l'e-mail de confirmation
            // Mail::to($register->email)->send(new ConfirmationMail($register));
    
                return response()->json([
                    'status' => 'success',
                    'status_code' => 'Compte cree avec success',
                    // 'token' => $token,
                    'data' => $register,
    
                ], 200);
                
            } catch (Exception $exception) {
                return response()->json($exception);
            }
    }

    /** Connexion */
    public function login(LoginRequest $request)
    {
        try{
            if(auth()->attempt($request->only('email', 'password')))
            {
                $auth = auth()->user();
                $role = User::where('id', $auth->id)->firstOrFail();
                $token = $auth->createToken('auth_token')->plainTextToken;
                
                // $accessToken = $auth->createToken('access_token', [TokenAbility::ACCESS_API->value], Carbon::now()->addMinutes(config('sanctum.expiration')));
                // $refreshToken = $auth->createToken('refresh_token', [TokenAbility::ISSUE_ACCESS_TOKEN->value], Carbon::now()->addMinutes(config('sanctum.refresh')));

                return response()->json([
                    'status' => true,
                    'status_message' => 'Connectez avec success',
                    'auth_user' => $auth,
                    // 'token' => $accessToken->plainTextToken,
                    // 'refresh_token' => $refreshToken->plainTextToken,
                    'access_token' => $token,
                    'type_token' => 'Bearer',
                ], 200);
            }else{
                return response()->json([
                'staus' => 403,
                'status_code' => 'Information non valide',
                ]);
            }
        }catch(Exception $exception){
            return response()->json($exception);
        }
    }

    /** Deconnexion */

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deconnectez avec success',
        ], 200);
    }
}
