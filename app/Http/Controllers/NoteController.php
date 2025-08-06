<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Activity;
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

        // Log activity
        Activity::log('note', 'created', "Catatan '{$note->title}' telah dibuat", 'fas fa-sticky-note');

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

        // Log activity
        Activity::log('note', 'updated', "Catatan '{$note->title}' telah diperbarui", 'fas fa-sticky-note');

        return redirect()->route('notes.index')->with('success', 'Catatan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $note = Note::find($id);
        if (!$note) {
            return redirect()->route('notes.index')->with('error', 'Catatan tidak ditemukan');
        }

        $noteTitle = $note->title;
        $note->delete();
        
        // Log activity
        Activity::log('note', 'deleted', "Catatan '{$noteTitle}' telah dihapus", 'fas fa-sticky-note');
        
        return redirect()->route('notes.index')->with('success', 'Catatan berhasil dihapus!');
    }
}