<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    
    public function index()
    {
        return Project::all();
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|string',
        ]);

        $project = Project::create($request->all());

        return response()->json($project, 201);
    }

    
    public function show(string $id)
    {
        $project = Project::findOrFail($id);
        return response()->json($project);
    }

    
    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|string',
        ]);

        $project->update($request->all());

        return response()->json($project);
    }

    
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
