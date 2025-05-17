<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PersonalInfo;
use Illuminate\Support\Facades\Storage;

class PersonalInfoController extends Controller
{
    public function index()
    {
        $infos = PersonalInfo::all();

        foreach ($infos as $info) {
            $info->background_image = Storage::url($info->background_image);
            $info->hero_image = Storage::url($info->hero_image);
            $info->about_image = Storage::url($info->about_image);
            $info->resume = $info->resume ? Storage::url($info->resume) : null;
        }

        return $infos;
    }

    public function store(Request $request)
    {
        $request->validate([
            'greeting' => 'required',
            'name' => 'required',
            'role' => 'required|array',
            'button_text' => 'required',
            'bio' => 'required',
            'gpa' => 'required',
            'degree' => 'required',
            'institution' => 'required',
            'duration' => 'required',
            'background_image' => 'required|file|image',
            'hero_image' => 'required|file|image',
            'about_image' => 'required|file|image',
            'resume' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $data = $request->except(['background_image', 'hero_image', 'about_image', 'resume']);
        $data['role'] = $request->input('role');

        if ($request->hasFile('background_image')) {
            $data['background_image'] = $request->file('background_image')->store('uploads', 'public');
        }
        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $request->file('hero_image')->store('uploads', 'public');
        }
        if ($request->hasFile('about_image')) {
            $data['about_image'] = $request->file('about_image')->store('uploads', 'public');
        }
        if ($request->hasFile('resume')) {
            $data['resume'] = $request->file('resume')->store('uploads', 'public');
        }

        $info = PersonalInfo::create($data);

        $info->background_image = Storage::url($info->background_image);
        $info->hero_image = Storage::url($info->hero_image);
        $info->about_image = Storage::url($info->about_image);
        $info->resume = $info->resume ? Storage::url($info->resume) : null;

        return $info;
    }

    public function show(string $id)
    {
        $info = PersonalInfo::findOrFail($id);

        $info->background_image = Storage::url($info->background_image);
        $info->hero_image = Storage::url($info->hero_image);
        $info->about_image = Storage::url($info->about_image);
        $info->resume = $info->resume ? Storage::url($info->resume) : null;

        return $info;
    }

    public function update(Request $request, string $id)
    {
        $personalInfo = PersonalInfo::findOrFail($id);

        $data = $request->except(['background_image', 'hero_image', 'about_image', 'resume']);

        if ($request->has('role')) {
            $data['role'] = $request->input('role');
        }

        if ($request->hasFile('background_image')) {
            Storage::disk('public')->delete($personalInfo->background_image);
            $data['background_image'] = $request->file('background_image')->store('uploads', 'public');
        }
        if ($request->hasFile('hero_image')) {
            Storage::disk('public')->delete($personalInfo->hero_image);
            $data['hero_image'] = $request->file('hero_image')->store('uploads', 'public');
        }
        if ($request->hasFile('about_image')) {
            Storage::disk('public')->delete($personalInfo->about_image);
            $data['about_image'] = $request->file('about_image')->store('uploads', 'public');
        }
        if ($request->hasFile('resume')) {
            if ($personalInfo->resume) {
                Storage::disk('public')->delete($personalInfo->resume);
            }
            $data['resume'] = $request->file('resume')->store('uploads', 'public');
        }

        $personalInfo->update($data);

        $personalInfo->background_image = Storage::url($personalInfo->background_image);
        $personalInfo->hero_image = Storage::url($personalInfo->hero_image);
        $personalInfo->about_image = Storage::url($personalInfo->about_image);
        $personalInfo->resume = $personalInfo->resume ? Storage::url($personalInfo->resume) : null;

        return $personalInfo;
    }

    public function destroy(string $id)
    {
        $personalInfo = PersonalInfo::findOrFail($id);

        foreach (['background_image', 'hero_image', 'about_image', 'resume'] as $field) {
            if ($personalInfo->$field) {
                Storage::disk('public')->delete($personalInfo->$field);
            }
        }

        $personalInfo->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
