<?php

namespace App\Repositories;

use App\Note;
use App\Http\Resources\Note as NoteResource;
use Illuminate\Support\Facades\Log;

class Notes extends Repository
{
    public function all(): Repository
    {
        try {
            $notes = Note::all();
            $notesList = NoteResource::collection($notes);
        } catch(\Exception $e) {
            Log::error(
                'Something went wrong while getting the notes from the database',
                [
                    'message' => $e->getMessage()
                ]
            );
            $error = true;
        }

        return (new Repository())
            ->setError($error ?? false)
            ->setItems($notesList ?? []);
    }

    public function store($data): Repository
    {
        // todo
    }

    public function show($id): Repository
    {
        // todo
    }

    public function update($id, $data): Repository
    {
        // todo
    }

    public function delete($id): Repository
    {
        // todo
    }
}
