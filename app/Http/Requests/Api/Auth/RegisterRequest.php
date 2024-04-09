<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:50',
            'firstname' => 'required|string|min:2|max:50',
            'gender' => 'required|string|in:M,F,O',
            'country' => 'required|string|min:2|max:50',
            'email' => 'required|string|email|unique:users,email|min:2 |max:255',
            'password' => 'required|min:7',
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        throw new HttpResponseException(response()->json([
            'success'=> false,
            'error' => true,
            'message' => 'Veillez fournie toutes les infos',
            'errorsList'=> $validator->errors(),
        ]));
    }

    /**
     * Message  d'erreur pour les champs du formulaire.
    */
    public function messages(){
        return[
            'name.required' => 'Le champs nom est obligatoire',
            'name.min' => 'Le champs nom doit avoir plus de 2 caractere',
            'name.max' => 'Le champs nom doit avoir moins de 255 caractere',

            'firstname.required' => 'Le champs prenom est obligatoire',
            'firstname.min' => 'Le champs prenom doit avoir plus de 2 caractere',
            'firstname.max' => 'Le champs prenom doit avoir moins de 255 caractere',

            'gender.required' => 'Vous devriez choisir un sexe',
            'gender.in' => 'Votre Choix devra etre parmi les element presents',

            'country.required' => 'Le champs nom est obligatoire',

            'email.required' => 'Adresse email est necessaire',
            'email.unique' => 'Adresse Email deja utilise',
            'email.email' => 'Email non valide',

            'password.required' => 'Un mot de passe est requis',
            'password.min' => 'Votre mot de passe doit avoir au moins 7 caractere',
        ];
    }
}
