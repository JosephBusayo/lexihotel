<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rooms\Amenity\StoreRequest;
use App\Http\Requests\Rooms\Amenity\UpdateRequest;
use App\Models\Amenity;
use Illuminate\Http\Request;

class AmenityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Room Amenity';
        $amenities = Amenity::latest()->get();
        return view('admin.rooms-management.amenities.index', compact('pageTitle', 'amenities'));
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
        $data['slug'] = slug($data['name']);
        // save category
        Amenity::create($data);
        // redirect back with notification
        $notify[] = ['success', $data['name'] . ' created successfully'];
        return back()->withNotify($notify);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function show(Amenity $amenity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function edit(Amenity $amenity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $uid)
    {
        //find category
        $amenity = Amenity::findByUid($uid);
        abort_if(!$amenity, 404);
        // validated data
        $data = $request->validated();
        $data['status'] = ($data['status'] == 'active') ? true : false;
        $amenity->update($data);
        // redirect back with notification
        $notify[] = ['success', $amenity->name . ' updated successfully'];
        return back()->withNotify($notify);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function destroy($uid)
    {
        //find amenity
        $amenity = Amenity::findByUid($uid);
        abort_if(!$amenity, 404);
        $amenity->delete();
        $notify[] = ['success', $amenity->name . ' deleted successfully'];
        return back()->withNotify($notify);
    }
}