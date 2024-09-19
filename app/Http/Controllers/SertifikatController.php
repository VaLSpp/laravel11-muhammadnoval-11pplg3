<?php

namespace App\Http\Controllers;

use App\Models\Sertifikat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class SertifikatController extends Controller
{
    public function index()
    {
        $certificates = Sertifikat::all();
        return view('certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('sertifikat.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateCertificate($request);

        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('certificates', 'public');
            $validatedData['image'] = $imagePath;
        }

        Sertifikat::create($validatedData);

        return redirect()->route('certificates.index')->with('success', 'Sertifikat Berhasil Di Buat');
    }

    public function edit(Sertifikat $certificate)
    {
        return view('sertifikat.edit', compact('sertifikat'));
    }

    public function update(Request $request, Sertifikat $certificate)
    {
        $validatedData = $this->validateCertificate($request);

        // Handle file upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($certificate->image) {
                Storage::disk('public')->delete($certificate->image);
            }

            $imagePath = $request->file('image')->store('certificates', 'public');
            $validatedData['image'] = $imagePath;
        }

        $certificate->update($validatedData);

        return redirect()->route('certificates.index')->with('success', 'Sertifikat Berhasil Di Perbaharui');
    }

    public function destroy(Sertifikat $certificate)
    {
        if ($certificate->image) {
            Storage::disk('public')->delete($certificate->image);
        }

        $certificate->delete();

    return redirect()->route('certificates.index')->with('success', 'Sertifikat Berhasil Di Hapus');
    }

    private function validateCertificate(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'issued_at' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
        ]);
    }
}
