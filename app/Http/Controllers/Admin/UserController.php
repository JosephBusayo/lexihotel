<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Users';
        $users = User::latest()->get();
        return view('admin.users.index', compact('pageTitle', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $pageTitle = 'Create User';
        $roles = Role::latest()->get();
        $user = new User();
        // Fill model with old input
        if (!empty($request->old())) {
            $user->fill($request->old());
        }
        return view('admin.users.create', compact('pageTitle', 'roles', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        //validate data
        $data = $request->validated();
        // dd($request->all());
        $data['password'] = Hash::make(trim($data['password']));
        $data['status'] = ($data['status'] == 1) ? true : false;

        // HANDLE FILE UPLOAD
        if ($request->hasFile('image')) {
            // validate file
            $request->validate([
                'image' => 'mimes:jpeg,jpg,png,gif|required|max:20000',
            ]);
            $fileName = uploadImage($request->file('image'), 'Avatar', $size = null, $old = null, '70x70');
            if ($fileName) {
                $data['image'] = $fileName;
            }
        }

        $data['is_admin'] = ($data['role'] == 'admin') ? true : false;

        // save user
        $user = User::create($data);

        // assign role to user
        $user->assignRole($data['role']);

        // redirect back with a message
        $notify[] = ['success', $user->name . ' has been created successfully'];
        return redirect()->route('admin.user.index')->withNotify($notify);
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
    public function edit($uid)
    {
        //
        $user = User::findByUid($uid);
        abort_if(!$user, 404);

        $pageTitle = 'Edit User; ' . $user->name;
        $roles = Role::latest()->get();
        return view('admin.users.edit', compact('pageTitle', 'roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $uid)
    {
        //find user
        $user = User::findByUid($uid);
        abort_if(!$user, 404);

        $data = $request->validated();

        if ($request->password) {
            $request->validate([
                'password' => '|required|string',
            ]);
            $data['password'] = Hash::make(trim($data['password']));
        }

        $data['status'] = ($data['status'] == 1) ? true : false;

        // HANDLE FILE UPLOAD
        if ($request->hasFile('image')) {
            // validate file
            $request->validate([
                'image' => 'mimes:jpeg,jpg,png,gif|required|max:20000',
            ]);

            // remove existing image
            if ($user->image) {
                removeFile('Avatar/' . $user->image);
            }

            $fileName = uploadImage($request->file('image'), 'Avatar', $size = null, $old = null, '70x70');
            if ($fileName) {
                $data['image'] = $fileName;
            }
        }

        $data['is_admin'] = ($data['role'] == 'admin') ? true : false;

        // save user
        $user->update($data);

        // assign role to user
        $user->assignRole($data['role']);

        // redirect back with a message
        $notify[] = ['success', $user->name . ' has been updated successfully'];
        return redirect()->back()->withNotify($notify);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uid)
    {
        //find user by ID
        $user = User::findByUid($uid);
        abort_if(!$user, 404);
        // remove image if exist
        if ($user->image) {
            removeFile('Avatar/' . $user->image);
        }

        $user->delete();

        $notify[] = ['success', $user->name . ' deleted successfully'];

        return redirect()->back()->withNotify($notify);
    }
}