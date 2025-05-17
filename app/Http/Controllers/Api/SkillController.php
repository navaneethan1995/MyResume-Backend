<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
   
    public function index()
    {
        return Skill::all();
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string',
            'icon' => 'required|string',
            'items' => 'required|array',
        ]);

        $skill = new Skill();
        $skill->category = $validated['category'];
        $skill->icon = $validated['icon'];
        $skill->items = json_encode($validated['items']); 
        $skill->save();

        return response()->json($skill, 201);
    }

    
    public function show($id)
    {
        $skill = Skill::findOrFail($id);
        return $skill;
    }

    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category' => 'required|string',
            'icon' => 'required|string',
            'items' => 'required|array',
        ]);

        $skill = Skill::findOrFail($id);
        $skill->category = $validated['category'];
        $skill->icon = $validated['icon'];
        $skill->items = json_encode($validated['items']); 
        $skill->save();

        return response()->json($skill);
    }

   
    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();

        return response()->json(['message' => 'Skill deleted successfully']);
    }
}
