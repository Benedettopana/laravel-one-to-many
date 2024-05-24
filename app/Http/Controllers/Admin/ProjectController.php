<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Functions\Helper as Help;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::paginate(15);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $route = route('admin.project.store');
        $method = 'POST';
        $project = null;
        $title = 'Nuovo Progetto';
        $btn = 'Aggiungi';

        return view('admin.projects.create-edit', compact('route', 'method', 'project', 'title','btn'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $form_data = $request ->all();
        $exist = Project::where('title', $form_data['title'])->first();
        if($exist){
            return redirect()->route('admin.project.create')->with('error', 'Titolo del progetto già esistente');
        } else{
            $new_project = new Project();
            $form_data['slug'] = Help::createSlug($form_data['title'], Project::class);

            //? Riempio e salvo
            $new_project->fill($form_data);
            $new_project->save();

            //? Ridireziono
            return redirect()->route('admin.project.index')->with('success', 'Progetto aggiunto correttamente!');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $route = route('admin.project.update', $project);
        $method = 'PUT';
        $title = 'Modifica un Progetto';
        $btn = 'Modifica';
        return view('admin.projects.create-edit', compact('route', 'method', 'project', 'title', 'btn'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $form_data = $request->all();

        if($form_data['title'] === $project->title){
        $form_data['slug'] = $project->slug;
        }else{
            $form_data['slug'] = Help::createSlug($form_data['title'], Project::class) ;
        }

        $project->update($form_data);
        return redirect()->route('admin.project.index',$project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.project.index')->with('deleted', 'Il progetto'. ' ' . $project->title. ' ' .'è stato cancellato con successo!');
    }
}
