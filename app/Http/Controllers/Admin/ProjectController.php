<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Importazione modello Project
use App\Models\Admin\Project;
// Importazione modello Project
use App\Models\Admin\Type;
use App\Models\Admin\Technology;

// Importazione file Request
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

// Storage
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // assegniamo alla variabile $projects tutti i record della tabella projects grazie al metodo statico ( Project::All() )
        $projects = Project::All();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {        
        
        $form_data = $request->validated();
        
        // associamo a una variabile i dati passati con il form        
        // $form_data = $request->all();

        // trasformazione da titolo a slug grazie al metodo statico del model Project creato da noi
        $slug = Project::toSlug($request->title);

        // assegnazione e creazione del nuovo valore $slug
        $form_data['slug'] = $slug;

        /*    INSERIMENTO IMMAGINI    */
        // se il file immagine è presente
        if( $request->hasFile('image') ) {

            // generazione path il quale verrà salvato in post_images
            $img_path = Storage::disk('public')->put('post_images', $request->image);

            // assegnazione e creazione del nuovo valore $img_path
            $form_data['image'] = $img_path;
        }

        // dd($request->file('video'));
        /*    INSERIMENTO VIDEO    */
        // if( $request->hasFile('video') ) {

        //     // assegnazione path del video che verrà salavato nella cartella 'post_videos'
            // $video_path = Storage::disk('public')->put('post_videos', $request->file('video')->getClientOriginalName());
            // $form_data['video'] = $video_path;

        //     $path = $request->file('video')->store('post_videos', ['disk' =>'public']);
        //     $form_data['video'] = $path;

        // } 

        /* l'alternativa shortcut al salvataggio delle informazioni
        */
        $newProject = Project::create($form_data);
        // $newProject = new Project();
        // $newProject->fill($form_data);
        // $newProject->save();
        
        if($request->has('technology_id')) {
            
            /* 
                ->attach($request->technology_id;
                technology_id = nome colonna
                --- Collega le tecnologie prese al progetto salvato ---
            */
            $newProject->technology()->attach($request->technology_id);
        }

        return redirect()->route('projects.index')->with('success', 'Creazione del fumetto completata con successo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        // $project = Project::findOrFail($id);

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  preso l'elemento intero come parametro, lo passo all'interno del file edit.blade.php
    public function edit(Project $project)
    {        
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {

        $form_data = $request->validated();

        // trasformazione da titolo a slug grazie al metodo statico del model Project creato da noi
        $slug = Project::toSlug($request->title);

        // assegnazione e creazione del nuovo valore $slug
        $form_data['slug'] = $slug;

        /*    INSERIMENTO IMMAGINI    */
        // se il file immagine è presente
        if( $request->hasFile('image')) {
            
            // se l'immagine è presente cancellalo dalla cartella
            if($project->image) {
                Storage::delete($project->image);
            }
            // generazione path il quale verrà salvato in post_images
            $img_path = Storage::disk('public')->put('post_images', $request->image);

            // assegnazione e creazione del nuovo valore $img_path
            $form_data['image'] = $img_path;

        }
        
        // aggiorniamo l'elemento passato con il form, usando il metodo update()
        $project->update($form_data);

        // se esistono gli id
        if($request->has('technology_id')) {
            $project->technology()->sync($request->technology_id);

        // altrimenti va svuotato
        } else {
            $project->technology()->sync([]);
        }

        // facciamo un redirect verso la pagina contenente tutti i nostri comic dove possiamo avere una panoramica dei nostri elementi modificati
        return redirect()->route('projects.index')->with('success', 'Modifica completata con successo!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {

        /* Rimuovi le righe nella tabella pivot quando cancelli l'elemento, ma avendo già definito nella migration del pivot il metodo 'cascadeOnDelete()' non sarà più necessario */
        // $project->technology()->detach();
        // $project->technology()->sync([]);

        // se l'immagine è presente cancellalo dalla cartella
        if($project->image) {
            Storage::delete($project->image);
        }
        // se il video è presente cancellalo dalla cartella
        // if ($project->video) {
        //     Storage::disk('public')->delete($project->video);
        // }
        // cancelliamo l'elemento passato con il metodo destroy
        $project->delete();

        return redirect()->route('projects.index');
    }
}
