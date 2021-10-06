<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Tags;

class TagController extends Controller
{
    protected $tagsRepository;

    public function __construct()
    {
        $this->tagsRepository = new Tags();
    }

    public function index()
    {
        $tagFetch =
            $this
                ->tagsRepository
                ->all();

        if ($tagFetch->hasError()) {
            return response()->json($tagFetch->getItems(), 500);
        }

        return response()->json($tagFetch->getItems(), 200);
    }

    public function store(Request $request)
    {
        $tagStore =
            $this
                ->tagsRepository
                ->store($request->all());

        if ($tagStore->hasError()) {
            return response()->json($tagStore->getItems(), 500);
        }

        return response()->json($tagStore->getItems(), 201);
    }

    public function show($id)
    {
        $tagFetch =
            $this
                ->tagsRepository
                ->show($id);

        if ($tagFetch->hasError()) {
            return response()->json($tagFetch->getItems(), 500);
        }

        return response()->json($tagFetch->getItems(), 200);
    }

    public function update($id, Request $request)
    {
        $tagUpdate =
            $this
                ->tagsRepository
                ->update($id, $request->all());

        if ($tagUpdate->hasError()) {
            return response()->json($tagUpdate->getItems(), 500);
        }

        return response()->json($tagUpdate->getItems(), 200);
    }

    public function delete($id)
    {
        $tagDelete =
            $this
                ->tagsRepository
                ->delete($id);

        if ($tagDelete->hasError()) {
            return response()->json($tagDelete->getItems(), 500);
        }

        return response()->json($tagDelete->getItems(), 200);
    }
}
