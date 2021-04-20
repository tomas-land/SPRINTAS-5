<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('projects', ['projects' => Project::all()]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
               'title' => 'required|unique:projects,title|min:5|max:20',
           ]);

        $project = new Project();
        $project->title = $request['title'];
        $project->save();
        // return redirect('/projects');

        if ($project->title == NULL)
            return redirect('/projects')->with('status_error', 'Field is empty!');

        return ($project->save() !== 1) ?
            redirect('/projects')->with('status_success', 'Project created!') :
            redirect('/projects')->with('status_error', 'Project was not created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('edit_project',['project' => Project::find($id)]);

    }

    /**ed resource.
     *
     * Show the form for editing the specifi
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
 
        public function update($id, Request $request){
            $this->validate($request, [
                'title' => 'required|unique:projects,title|min:5|max:20',
            ]);
                    $project = Project::find($id);
                    $project->title = $request['title'];
                    
                    return ($project->save() !== 1) ? 
                        redirect('/projects')->with('status_success', 'Post updated!') : 
                        redirect('/projects/'.$id)->with('status_error', 'Post was not updated!');
                }
            
                

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Project::destroy($id);
        return redirect('/projects')->with('status_success', 'Project deleted!');
    }




    
}
