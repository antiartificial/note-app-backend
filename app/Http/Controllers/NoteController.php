<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Notes;

class NoteController extends Controller
{
    protected $notesRepository;

    public function __construct()
    {
        $this->notesRepository = new Notes();
    }

    public function index()
    {
        $noteFetch =
            $this
                ->notesRepository
                ->all();

        if ($noteFetch->hasError()) {
            return response()->json($noteFetch->getItems(), 500);
        }

        return response()->json($noteFetch->getItems(), 200);
    }

    public function store(Request $request)
    {
        $noteStore =
            $this
                ->notesRepository
                ->store($request->all());

        if ($noteStore->hasError()) {
            return response()->json($noteStore->getItems(), 500);
        }

        return response()->json($noteStore->getItems(), 201);
    }

    public function show($id)
    {
        $noteFetch =
            $this
                ->notesRepository
                ->show($id);

        if ($noteFetch->hasError()) {
            return response()->json($noteFetch->getItems(), 500);
        }

        return response()->json($noteFetch->getItems(), 200);
    }

    public function update($id, Request $request)
    {
        $noteUpdate =
            $this
                ->notesRepository
                ->update($id, $request->all());

        if ($noteUpdate->hasError()) {
            return response()->json($noteUpdate->getItems(), 500);
        }

        return response()->json($noteUpdate->getItems(), 200);
    }

    public function delete($id)
    {
        $noteDelete =
            $this
                ->notesRepository
                ->delete($id);

        if ($noteDelete->hasError()) {
            return response()->json($noteDelete->getItems(), 500);
        }

        return response()->json($noteDelete->getItems(), 200);
    }
}
