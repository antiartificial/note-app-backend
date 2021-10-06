<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Http\Resources\Tag as TagResource;
use Illuminate\Support\Facades\Log;

class Tags extends Repository
{
    public function all(): Repository
    {
        try {
            $tags = Tag::all();
            $tagsList = TagResource::collection($tags);
        } catch(\Exception $e) {
            Log::error(
                'Something went wrong while getting the tags from the database',
                [
                    'message' => $e->getMessage()
                ]
            );
            $error = true;
        }

        return (new Repository())
            ->setError($error ?? false)
            ->setItems($tagsList ?? []);
    }

    public function store($data): Repository
    {
        try {
            $tag = Tag::create([
                'name' => $data['name'],
            ]);
            $singleItem = new TagResource($tag);
        } catch (\Exception $e) {
            Log::error(
                'Something went wrong while getting the tags from the database',
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
            $tag = Tag::find($id);
            $singleItem = new TagResource($tag);
        } catch (\Exception $e) {
            Log::error(
                'Something went wrong while getting the tags from the database',
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
            $tag =
                $this
                    ->show($id)
                    ->getItems();

            $tag->title = $data['title'];
            $tag->description = $data['description'];
            $tag->save();

            $singleItem = new TagResource($tag);
        } catch (\Exception $e) {
            Log::error(
                'Something went wrong while updating the tag in the database',
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
            $tag =
                $this
                    ->show($id)
                    ->getItems();
            $tag->delete();
        } catch (\Exception $e) {
            Log::error(
                'Something went wrong while deleting the tag from the database',
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
