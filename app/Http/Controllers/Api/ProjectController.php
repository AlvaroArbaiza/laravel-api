<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Project;

class ProjectController extends Controller
{
    public function index(Request $request) {

        // if($request->has('type_id')) {
        //     $projects = Project::with( 'type', 'technology')->where('type_id', $request->type_id)->paginate(4);
        // } else {
            // $projects = Project::with( 'type', 'technology')->get();
        //     $projects = Project::with( 'type', 'technology')->paginate(4);
        // }

        $query = Project::with( ['type', 'technology'] );

        // se viene mandata l'informazione 'type_id' effettuiamo il filtraggio solo per gli elementi che hanno il valore di 'type_id'
        if( $request->has( 'type_id' ) ){
            $query->where( 'type_id', $request->type_id );
        }

        // nel caso di 'technology_id' abbiamo una stringa di valori separata da una virgola, con explode verrà trasformato in array e con la funzione di callback dove il metodo 'whereIn' confronta ogni ID di tecnologia nel database con gli ID presenti nell'array '$techsIds'. 
        if( $request->has( 'technology_id' ) ){

            $techsIds = explode( ',', $request->technology_id );
            $query->whereHas('technology',function($query) use ($techsIds)
            {
                $query->whereIn('id',$techsIds);
            });
        }

        $projects = $query->paginate(4);
                
        return response()->json([
            'success' => true,
            'projects' => $projects
        ]);
    }

    public function show($slug) {

        // $projects = Project::with( 'type', 'technology')->get();
        $project = Project::with( 'type', 'technology')->where('slug', $slug)->first();
        
        if($project) {

            return response()->json([
                'success' => true,
                'project' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => "Non c'è nessun elemento"
            ])->setStatusCode(404);
        }
    }
}
