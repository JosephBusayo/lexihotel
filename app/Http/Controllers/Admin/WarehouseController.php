<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WarehouseController extends Controller
{
    //
    public function index()
    {
        // this will get all warehouse
        $warehouses = Warehouse::all();

        return view('admin/warehouse/index', [
            'pageTitle' => 'All Warehouse',
            'warehouses' => $warehouses,
        ]);
    }

    public function create()
    {
        $states = State::all();

        return view('admin/warehouse/create', [
            'pageTitle' => 'Create Warehouse',
            'states' => $states,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'state' => ['required'],
            'name' => ['required'],
            'status' => ['required'],
        ]);

        Warehouse::create([
            'uid' => Str::random(7),
            'state_id' => $data['state'],
            'name' => $data['name'],
            'status' => ($data['status'] == 1) ? true : false,
        ]);

        $notify[] = ['success', 'Warehouse created successfully'];

        return redirect()->route('admin.warehouse.index')->with('notify', $notify);
    }

    public function edit($id)
    {
        // dd($id);
        // get all states
        $states = State::all();

        $warehouse = Warehouse::find($id);

        return view('admin/warehouse/edit', [
            'pageTitle' => 'Edit Warehouse: ' . $warehouse->name,
            'states' => $states,
            'warehouse' => $warehouse,
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($id);
        // find warehouse by id
        $warehouse = Warehouse::find($id);

        // validate data
        $data = $request->validate([
            'state' => ['required'],
            'name' => ['required'],
            'status' => ['required'],
        ]);

        // update warehouse
        $warehouse->update([
            'state_id' => $data['state'],
            'name' => $data['name'],
            'status' => ($data['status'] == 1) ? true : false,
        ]);

        $notify[] = ['success', 'Warehouse updated successfully'];
        return redirect()->route('admin.warehouse.index')->with('notify', $notify);
    }

    public function destroy($id)
    {
        // dd($id);
        // find warehouse by id
        $warehouse = Warehouse::find($id);

        // delete
        $warehouse->delete();

        $notify[] = ['success', 'Warehouse deleted successfully'];

        return redirect()->back()->with('notify', $notify);
    }
}