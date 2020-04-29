<?php

namespace App\Http\Controllers\Admin;

use App\Team;
use App\User;
use App\TeamMembers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('team_access')) {
            return abort(401);
        }
        $teams = Team::all();

        return view('admin.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('team_create')) {
            return abort(401);
        }
        $users = User::where('is_active', 1)->pluck('name', 'id');

        return view('admin.teams.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('team_create')) {
            return abort(401);
        }
        $team = Team::create($request->all());
        return redirect()->route('admin.teams.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('team_edit')) {
            return abort(401);
        }
        $team = Team::findOrFail($id);
        $users = User::where('is_active', 1)->pluck('name', 'id');

        return view('admin.teams.edit', compact('team', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! Gate::allows('team_edit')) {
            return abort(401);
        }
        $team = Team::findOrFail($id);
        $team->update($request->all());

        return redirect()->route('admin.teams.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('team_delete')) {
            return abort(401);
        }
        $team = Team::findOrFail($id);
        $team->delete();

        return redirect()->route('admin.teams.index');
    }

    public function teamMembers(Request $request)
    {
        if (! Gate::allows('team_access')) {
            return abort(401);
        }
        $teams = Team::all();
        // print_r($teams[0]->members[0]->user->name);
        // edit();

        return view('admin.team_members.index', compact('teams'));
    }

    public function isSelected($id, $member_ids){
        $is_selected = 0;
        for($j = 0; $j < count($member_ids); $j++) {
            if($id == $member_ids[$j]){
                $is_selected = 1;
            }
        }
        return $is_selected;
    }

    public function teamMembersEdit(Request $request)
    {
        if (! Gate::allows('team_access')) {
            return abort(401);
        }

        $team_id = $request->input("team_id");

        $member_ids = TeamMembers::select('user_id')->where("team_id",$team_id)->pluck('user_id');
        $users = User::where("is_active", 1)->get();
        for($i = 0; $i < count($users); $i++){
            $users[$i]->is_selected = $this->isSelected($users[$i]->id, $member_ids);
        }
        
        return view('admin.team_members.edit', compact('team_id', 'users'));
    }

    public function teamMembersUpdate(Request $request) {
        if (! Gate::allows('team_access')) {
            return abort(401);
        }
        $member_ids = $request->input("member_id");
        $team_id = $request->input("team_id");
        TeamMembers::where("team_id", $team_id)->delete();

        foreach ($member_ids as $id) {
            TeamMembers::create(['team_id' => $team_id, "user_id" => $id]);
        }
        return redirect()->route('admin.team_members');
    }

    /**
     * Delete all selected Team at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('team_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = team::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
