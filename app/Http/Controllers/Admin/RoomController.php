<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rooms\Room\StoreRequest;
use App\Http\Requests\Rooms\Room\UpdateRequest;
use App\Models\Amenity;
use App\Models\Building;
use App\Models\Category;
use App\Models\Floor;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Rooms';
        $rooms = Room::orderBy('category_id', 'ASC')->get();
        return view('admin.rooms-management.rooms.index', compact('pageTitle', 'rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $pageTitle = 'Create Room';
        $categories = Category::where('status', 1)->latest()->get(['id', 'name']);
        $amenities = Amenity::where('status', 1)->latest()->get(['id', 'name']);
        $buildings = Building::where('status', 1)->latest()->get(['id', 'name']);
        $floors = Floor::where('status', 1)->latest()->get(['id', 'name']);
        $room = new Room();
        // Fill model with old input
        if (!empty($request->old())) {
            $room->fill($request->old());
        }
        $ids = [];
        return view('admin.rooms-management.rooms.create', compact('pageTitle', 'amenities', 'room', 'categories', 'ids', 'floors', 'buildings'));
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

        // check if Room name is already taken
        $existRoom = Room::where('category_id', $data['category_id'])->where('name', $data['name'])->first();

        if ($existRoom) {
            // redirect back with a message
            $notify[] = ['error', $existRoom->name . ' already exist in selected category'];
            return redirect()->back()->withNotify($notify);
        }

        // Handle AMENITIES
        if ($request->amenities) {
            $data['amenities'] = json_encode($request->amenities);
        }
        // HANDLE FILE UPLOAD
        if ($request->hasFile('image')) {
            // validate file
            $request->validate([
                'image' => 'mimes:jpeg,jpg,png,gif|required|max:20000',
            ]);
            $fileName = uploadImage($request->file('image'), 'Rooms', $size = null, $old = null, '70x70');
            if ($fileName) {
                $data['image'] = $fileName;
            }
        }
        if ($request->description) {
            $data['description'] = $request->description;
        }
        $data['status'] = ($data['status'] == 1) ? true : false;
        $data['user_id'] = auth()->user()->id;

        // save room
        $room = Room::create($data);

        // redirect back with a message
        $notify[] = ['success', $room->name . ' has been created successfully'];
        return redirect()->route('admin.room.index')->withNotify($notify);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit($uid)
    {
        $room = Room::findByUid($uid);
        abort_if(!$room, 404);

        $pageTitle = 'Edit Room; ' . $room->name;
        $categories = Category::where('status', 1)->latest()->get(['id', 'name']);
        $amenities = Amenity::where('status', 1)->latest()->get(['id', 'name']);
        $buildings = Building::where('status', 1)->latest()->get(['id', 'name']);
        $floors = Floor::where('status', 1)->latest()->get(['id', 'name']);
        if ($room->amenities) {
            $ids = json_decode($room->amenities);
        } else {
            $ids = [];
        }

        return view('admin.rooms-management.rooms.edit', compact('pageTitle', 'amenities', 'room', 'categories', 'ids', 'floors', 'buildings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $uid)
    {
        $room = Room::findByUid($uid);
        abort_if(!$room, 404);

        $data = $request->validated();

        // check if Room name is already taken
        $existRoom = Room::where('category_id', $data['category_id'])->where('name', $data['name'])->where('id', '!=', $room->id)->first();

        if ($existRoom) {
            // redirect back with a message
            $notify[] = ['error', $existRoom->name . ' already exist in another category'];
            return redirect()->back()->withNotify($notify);
        }

        // Handle AMENITIES
        if ($request->amenities) {
            $data['amenities'] = json_encode($request->amenities);
        }
        // HANDLE FILE UPLOAD
        if ($request->hasFile('image')) {
            // validate file
            $request->validate([
                'image' => 'mimes:jpeg,jpg,png,gif|required|max:20000',
            ]);
            // remove existing image
            if ($room->image) {
                removeFile('Rooms/' . $room->image);
            }

            $fileName = uploadImage($request->file('image'), 'Rooms', $size = null, $old = null, '70x70');
            if ($fileName) {
                $data['image'] = $fileName;
            }
        }
        if ($request->description) {
            $data['description'] = $request->description;
        }
        $data['status'] = ($data['status'] == 1) ? true : false;
        $data['user_id'] = auth()->user()->id;

        // save room
        $room->update($data);

        // redirect back with a message
        $notify[] = ['success', $room->name . ' has been updated successfully'];
        return redirect()->back()->withNotify($notify);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function clean(Request $request, $uid)
    {
        $room = Room::findByUid($uid);
        abort_if(!$room, 404);
        $room->is_clean = true;
        $room->save();
        $notify[] = ['success', $room->name . ' has been updated successfully'];
        return redirect()->back()->withNotify($notify);
    }
}
