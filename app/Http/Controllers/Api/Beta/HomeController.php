<?php

namespace App\Http\Controllers\Api\Beta;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Manga;
use App\Models\Watch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /** Accueil */
    public function index()
    {
        $chapters = Chapter::with('manga')->orderBy('id', 'DESC')->take(15)->get();

        $mangas = Manga::with('chapters')->orderBy('id', 'DESC')->take(15)->get();


        // Récupérer toutes les entrées triées par le nombre décroissant de 'manga_id'
        $populars = Watch::select('manga_id', DB::raw('count(*) as total_views'))
        ->groupBy('manga_id')
        ->orderByDesc('total_views')
        ->get();

        return response()->json([
            'status' => true,
            'status_message' => 'Recuperation effectuer avec success',
            'data' => [
                'chapiters' => $chapters,
                'mangas' => $mangas,
                'populars' => $populars,
                ]
        ], 200);
    }

    /** Details Manga */
    public function  show(string $slug)
    {
        // $manga = [
        //     'id' => 1,
        //     'title' => 'Premier Manga',
        //     'slugManga' => 'ceManga'
        // ];
        
        // $titre = $request->input('titre');
        // $id = $request->user()->id;
        // $date = Carbon\Carbon::now();
    
        // $slug = str_slug($titre . '-' . $id . '-' . $date, '-');
        // mon-premier-article-5-2021-05-25-14-30
    
        $manga = Manga::where('slugManga', $slug)->firstOrFail();
        // $manga = Manga::all();
    
        if($manga){
            return response()->json([
                'status' => true,
                'data' => $manga,
            ]);
        }else{
            return response()->json([
                'status' => false,
            ]);
        }
    }
}
