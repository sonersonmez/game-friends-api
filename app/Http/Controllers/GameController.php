<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteGameRequest;
use App\Http\Requests\IndexGameRequest;
use App\Http\Requests\ShowGameRequest;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Http\Resources\GameResource;
use App\Models\Category;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexGameRequest $request)
    {
        $games = Game::paginate();

        return GameResource::collection($games);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGameRequest $request)
    {
        $game = Game::create([
            'name'        => $request->name,
            'category_id' => Category::getId($request->input('category.id'))
        ]);

        $game->load('category:id,uuid,name');

        return GameResource::make($game);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(ShowGameRequest $request)
    {
        $game = Game::uuid($request->game_id);

        $game->load(['category:id,uuid,name']);

        return GameResource::make($game);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGameRequest $request)
    {
        $game = Game::uuid($request->game_id);

        $game->update($request->payload());

        $game->load(['category:id,uuid,name']);

        return GameResource::make($game);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteGameRequest $request)
    {
        $game = Game::uuid($request->game_id);

        $game->delete();

        return Response::noContent();
    }
}
