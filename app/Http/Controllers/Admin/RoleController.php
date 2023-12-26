<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Roles\StoreRequest;
use App\Http\Requests\Roles\UpdateRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Roles and Priviledges';
        $roles = Role::latest()->get();
        return view('admin.roles.index', compact('pageTitle', 'roles'));
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
        // save category
        Role::create($data);
        // redirect back with notification
        $notify[] = ['success', $data['name'] . ' created successfully'];
        return back()->withNotify($notify);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->validated();
        // save category
        $role = Role::find($id);
        abort_if(!$role, 404);
        // update
        $role->update($data);
        // redirect back with notification
        $notify[] = ['success', $data['name'] . ' updated successfully'];
        return back()->withNotify($notify);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        abort_if(!$role, 404);
        if ($role->permissions()->count()) {
            $notify[] = ['warning', ' you cannot delete a role that has permissions assigned'];
            return back()->withNotify($notify);
        }
        $role->delete();
        $notify[] = ['success', $role->name . ' deleted successfully'];
        return back()->withNotify($notify);
    }

    /**
     * Show the form for updating permission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPermission($id)
    {
        $pageTitle = 'Permission Management';
        $role = Role::find($id);
        abort_if(!$role, 404);
        // permissions
        $rolesPermissions = $role->permissions;
        $ids = [];
        foreach ($rolesPermissions as $key => $value) {
            $ids[] = $value->id;
        }
        $permissions = Permission::latest()->get();
        return view('admin.roles.permission', compact('pageTitle', 'role', 'permissions', 'ids'));
    }

    public function updatePermission(Request $request, $id)
    {
        $role = Role::find($id);
        abort_if(!$role, 404);
        if (!$request->ids) {
            $notify[] = ['error', ' No Permissions Selected'];
            return back()->withNotify($notify);
        }
        // dd($request->all());
        $role->syncPermissions($request->ids);
        $notify[] = ['success', 'Permissions Granted Successfully'];
        return back()->withNotify($notify);
    }
}