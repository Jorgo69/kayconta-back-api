<?php

namespace App\Http\Requests\Api\Beta;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MangaRequest extends FormRequest
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
            'title' => 'required|string|min:2|max:100',
            'summary' => 'required|string|min:5',
            'slugManga' => 'required|',
            // 'blanket' => 'required|image|mimes:jpeg,png,jpg',
            'blanket' => 'required',
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
            'title.required' => 'Le title de l\'oeuvre est obligatoire',
            'title.min' => 'Le title de l\'oeuvre doit avoir plus de 2 caractere',
            'title.max' => 'Le title de l\'oeuvre doit avoir moins de 100 caractere',

            'summary.required' => 'La description est obligatoire',
            'summary.min' => 'Le description doit avoir plus de 5 caractere',

            'slugManga.required' => 'Le slug n\'a pas ete correctement veuillez reessayer',

            'blanket.required' => 'Une image de couverture de l\'oeuvre est obligatoire',
            // 'blanket.image' => 'Sa devra etre une image de type  jpeg/png/jpg',
            // 'blanket.mimes' => 'L\'extension de la photo ne correspond pas à ce que nous acceptons (jpeg, png ou jpg)',
        ];
    }
}
