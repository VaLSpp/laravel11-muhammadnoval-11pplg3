<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    // Menampilkan semua project
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    // Menampilkan form untuk membuat project baru
    public function create()
    {
        return view('projects.create');
    }

    // Menyimpan project baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048', // Validasi untuk gambar
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/projects', 'public');
        }

        Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('projects.index')->with('success', 'Project berhasil disimpan!');
    }

    // Menampilkan form untuk mengedit project
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    // Mengupdate project
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048', // Validasi untuk gambar
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($project->image) {
                Storage::delete('public/' . $project->image);
            }
            $imagePath = $request->file('image')->store('images/projects', 'public');
        } else {
            $imagePath = $project->image;
        }

        $project->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('projects.index')->with('success', 'Project berhasil diperbarui!');
    }

    // Menghapus project
    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::delete('public/' . $project->image);
        }
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project berhasil dihapus!');
    }
}
