<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function notesIndex(Request $request, Note $note){
        $data = $note->paginate(10);
        return view('notes.index',[
            'notes' => $data
        ]);
    }

    public function notesCreate(){
        return view('notes.create',[]);
    }

    public function notesStore(Request $request, Note $note){
        $note->addNewNote($request->all());
        $data = $note->paginate(10);
        return view('notes.index',[
            'notes' => $data
        ]);
    }
}
