<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $abouts = About::all();
        return view('abouts.index', compact('abouts'));
    }

    public function create()
    {
        return view('abouts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagepath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        About::create([
            'title' => $request->title,
            'description' => $request->description,
            'title' => $imagePath,
        ]);

        return redirect()->route('abouts.index')->with('success', 'Berhasil Dibuat.');
    }

    public function edit(About $about)
    {
        return view('abouts.edit', compact('about'));
    }

    public function update(Request $request, About $about)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($about->image) {
                Storage::delete('public/' . $about->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = $about->image;
        }

        $about->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('abouts.index')->with('Berhasil', 'Berhasil Di Update');
    }

    public function destroy(About $about)
    {
        if ($about->image) {
            Storage::delete('public/' . $about->image);
        }
        $about->delete();

        return redirect()->route('abouts.index')->with('Berhasil', 'Berhasil Di Hapus');
    }
}
