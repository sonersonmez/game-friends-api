<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserToGroupRequest;
use App\Http\Requests\DeleteGroupRequest;
use App\Http\Requests\ShowGroupRequest;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\Game;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::paginate();

        $groups->load('game:id,uuid,name');

        return GroupResource::collection($groups);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupRequest $request)
    {
        $group = Group::create([
            'name'    => $request->name,
            'game_id' => Game::getId($request->input('game.id'))
        ]);

        $group->load('game:id,uuid,name');

        return GroupResource::make($group);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(ShowGroupRequest $request)
    {
        $group = Group::uuid($request->group_id);

        $group->load('game:id,uuid,name', 'users:id,uuid,name');

        return GroupResource::make($group);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGroupRequest $request)
    {
        $group = Group::uuid($request->group_id);

        $group->update($request->payload());

        $group->load('game:id,uuid,name');

        return GroupResource::make($group);     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteGroupRequest $request)
    {
        $group = Group::uuid($request->group_id);

        $group->delete();

        return Response::noContent();
    }

    public function addUserToGroup(AddUserToGroupRequest $request)
    {
        DB::table('group_user')->insert([
            'user_id'  => User::getId($request->user_id),
            'group_id' => Group::getId($request->group_id)
        ]);

        return Response::make();
    }
}
