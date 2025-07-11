<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::all();
        return view('note', compact('notes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $note = Note::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('notes.index')->with('success', 'Catatan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $note = Note::find($id);
        if (!$note) {
            return response()->json(['error' => 'Catatan tidak ditemukan'], 404);
        }
        return response()->json([
            'id' => $note->id,
            'title' => $note->title,
            'content' => $note->content,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $note = Note::find($id);
        if (!$note) {
            return response()->json(['error' => 'Catatan tidak ditemukan'], 404);
        }

        $note->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('notes.index')->with('success', 'Catatan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $note = Note::find($id);
        if (!$note) {
            return redirect()->route('notes.index')->with('error', 'Catatan tidak ditemukan');
        }

        $note->delete();
        return redirect()->route('notes.index')->with('success', 'Catatan berhasil dihapus!');
    }
}