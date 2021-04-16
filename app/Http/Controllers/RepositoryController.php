<?php

namespace App\Http\Controllers;

use App\Http\Requests\RepositoryRequest;
use Illuminate\Http\Request;
use App\Models\Repository;

class RepositoryController extends Controller
{
    public function index(Request $request)
    {
        $repositories = $request->user()->repositories;

        return view('repositories.index', compact('repositories'));
    }

    public function show(Request $request, Repository $repository)
    {
        if($request->user()->id != $repository->user_id)
        {
            abort(403);
        }
        return view('repositories.show', compact('repository'));
    }

    public function store(RepositoryRequest $request)
    {
        $request->user()->repositories()->create($request->all());

        return redirect()->route('repositories.index');
    }

    public function update(RepositoryRequest $request, Repository $repository)
    {
        if($request->user()->id != $repository->user_id)
        {
            abort(403);
        }

        $repository->update($request->all());

        return redirect()->route('repositories.edit', $repository);
    }

    public function destroy(Repository $repository)
    {
        $repository->delete();

        return redirect()->route('repositories.index');
    }
}
