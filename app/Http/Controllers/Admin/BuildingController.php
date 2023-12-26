<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rooms\Building\StoreRequest;
use App\Http\Requests\Rooms\Building\UpdateRequest;
use App\Models\Building;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Building';
        $buildings = Building::latest()->get();
        return view('admin.rooms-management.buildings.index', compact('pageTitle', 'buildings'));
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
        Building::create($data);
        // redirect back with notification
        $notify[] = ['success', $data['name'] . ' created successfully'];
        return back()->withNotify($notify);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function show(Building $building)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function edit(Building $building)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $uid)
    {
        //find building
        $building = Building::findByUid($uid);
        abort_if(!$building, 404);
        // validated data
        $data = $request->validated();
        $data['status'] = ($data['status'] == 'active') ? true : false;
        $building->update($data);
        // redirect back with notification
        $notify[] = ['success', $building->name . ' updated successfully'];
        return back()->withNotify($notify);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function destroy($uid)
    {
        //find building
        $building = Building::findByUid($uid);
        abort_if(!$building, 404);
        $building->delete();
        $notify[] = ['success', $building->name . ' deleted successfully'];
        return back()->withNotify($notify);
    }
}