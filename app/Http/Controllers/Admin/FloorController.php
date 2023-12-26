<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rooms\Floor\StoreRequest;
use App\Http\Requests\Rooms\Floor\UpdateRequest;
use App\Models\Building;
use App\Models\Floor;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Floors';
        $floors = Floor::latest()->get();
        $buildings = Building::where('status', 1)->get(['name', 'id']);
        return view('admin.rooms-management.floors.index', compact('pageTitle', 'floors', 'buildings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['status'] = ($data['status'] == 'active') ? true : false;
        // save category
        Floor::create($data);
        // redirect back with notification
        $notify[] = ['success', $data['name'] . ' created successfully'];
        return back()->withNotify($notify);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function show(Floor $floor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function edit(Floor $floor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $uid)
    {
        //find floor
        $floor = Floor::findByUid($uid);
        abort_if(!$floor, 404);
        $data = $request->validated();
        $data['status'] = ($data['status'] == 'active') ? true : false;
        // save category
        $floor->update($data);
        // redirect back with notification
        $notify[] = ['success', $data['name'] . ' created successfully'];
        return back()->withNotify($notify);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function destroy($uid)
    {
        //find floor
        $floor = Floor::findByUid($uid);
        abort_if(!$floor, 404);
        $floor->delete();
        $notify[] = ['success', $floor->name . ' deleted successfully'];
        return back()->withNotify($notify);
    }
}