<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemDetail;
use Illuminate\Http\Request;

class SystemDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'System Configuration';
        $system = systemDetail::first();
        return view('admin.systems.index', compact('pageTitle', 'system'));
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
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            // 'checkout_time' => 'required',
        ]);

        // check if
        $retVal = SystemDetail::find(1);
        $system = ($retVal) ? $retVal : new SystemDetail();

        $system->name = $request->name;
        $system->mobile = $request->mobile;
        $system->checkout_time = $request->checkout_time;
        // HANDLE FILE UPLOAD
        if ($request->hasFile('image')) {
            // validate file
            $request->validate([
                'image' => 'mimes:jpeg,jpg,png,gif|required|max:20000',
            ]);
            // remove existing image
            if ($system->logo) {
                removeFile('Logo/' . $system->image);
            }

            $fileName = uploadImage($request->file('image'), 'Logo', $size = null, $old = null, '70x70');
            if ($fileName) {
                $system->logo = $fileName;
            }
        }
        $system->save();
        // redirect back with a message
        $notify[] = ['success', 'updated successfully'];
        return redirect()->back()->withNotify($notify);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SystemDetail  $systemDetail
     * @return \Illuminate\Http\Response
     */
    public function show(SystemDetail $systemDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SystemDetail  $systemDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(SystemDetail $systemDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SystemDetail  $systemDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SystemDetail $systemDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SystemDetail  $systemDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(SystemDetail $systemDetail)
    {
        //
    }
}
