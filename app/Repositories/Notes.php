<?php

namespace App\Repositories;

use App\Models\Note;
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
        try {
            $note = Note::create([
                'title' => $data['title'],
                'description' => $data['description'],
            ]);
            $singleItem = new NoteResource($note);
        } catch (\Exception $e) {
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
            ->setItems($singleItem ?? []);
    }

    public function show($id): Repository
    {
        try {
            $note = Note::find($id);
            $singleItem = new NoteResource($note);
        } catch (\Exception $e) {
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
            ->setItems($singleItem ?? []);
    }

    public function update($id, $data): Repository
    {
        try {
            $note =
                $this
                    ->show($id)
                    ->getItems();

            $note->title = $data['title'];
            $note->description = $data['description'];
            $note->save();

            $singleItem = new NoteResource($note);
        } catch (\Exception $e) {
            Log::error(
                'Something went wrong while updating the note in the database',
                [
                    'message' => $e->getMessage()
                ]
            );
            $error = true;
        }

        return (new Repository())
            ->setError($error ?? false)
            ->setItems($singleItem ?? []);
    }

    public function delete($id): Repository
    {
        try {
            $note =
                $this
                    ->show($id)
                    ->getItems();
            $note->delete();
        } catch (\Exception $e) {
            Log::error(
                'Something went wrong while deleting the note from the database',
                [
                    'message' => $e->getMessage()
                ]
            );
            $error = true;
        }

        return (new Repository())
            ->setError($error ?? false);
    }
}
