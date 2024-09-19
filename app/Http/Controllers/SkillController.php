<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::all();
        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skills.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
        ]);

        $imagePath = $request->file('image')->store('skills', 'public');

        Skill::create([
            'name' => $request->name,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.skill')->with('success', 'Skill Berhasil Di Buat');
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($skill->image);
            $data['image'] = $request->file('image')->store('skills', 'public');
        }

        $skill->update($data);

        return redirect()->route('admin.skill')->with('success', 'Skill Berhasil DiPerbaharui');
    }

    public function destroy(Skill $skill)
    {
        Storage::disk('public')->delete($skill->image);
        $skill->delete();
        return redirect()->route('admin.skill')->with('success', 'Skill Berhasil Dihapus');
    }
}
