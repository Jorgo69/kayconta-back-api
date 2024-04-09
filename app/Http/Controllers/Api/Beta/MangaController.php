<?php

namespace App\Http\Controllers\Api\Beta;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Http\Requests\Api\Beta\MangaRequest;
use App\Models\Manga;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MangaController extends Controller
{
    /** Creation d'une Oeuvre */
    public function create(MangaRequest $request)
    {
        $manga = new Manga();
        $manga->title = $request -> title;
        $manga->summary = $request -> summary;
        $manga->blanket = $request -> blanket;
        
        // if ($image = $request->file('cover'))  {
        //     $destinationPath = 'images/covers'; // upload path
        //     $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        //     $image->move($destinationPath, $profileImage);
        //     $manga->cover = "$profileImage";
        // } else {
        //     return response()->json(['error'=>"Vous devez ajouter une image"],  401);
        // }
        $adder_id = auth()->user()->id;
        $manga->adder_id = $adder_id;

    $slug = Str::limit(Str::slug((integer) Carbon::now()->timestamp +(intval($adder_id)) .'_' . $request->title . '_' ), 200);
    $manga->slugManga = $slug;

        
        // if(!$manga->save()){
        //     return response()->json([
        //         'success' => false,
        //         'status_message' => 'Erreur lors de la creation de l\'oeuvre.'
        //     ], 501);
        // }

        // $manga->save();

        return response()->json([
            'success' => true,
            'status_message' => 'Oeuvre creer avec success',
            'data'=> [
                'manga' => $manga
            ]
        ],200);
    }
}
