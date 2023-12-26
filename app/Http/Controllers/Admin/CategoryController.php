<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rooms\Category\StoreRequest;
use App\Http\Requests\Rooms\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Room Category';
        $categories = Category::latest()->get();
        return view('admin.rooms-management.category.index', compact('pageTitle', 'categories'));
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
        Category::create($data);
        // redirect back with notification
        $notify[] = ['success', $data['name'] . ' created successfully'];
        return back()->withNotify($notify);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $uid)
    {
        //find category
        $category = Category::findByUid($uid);
        abort_if(!$category, 404);
        // validated data
        $data = $request->validated();
        $data['status'] = ($data['status'] == 'active') ? true : false;
        $category->update($data);
        // redirect back with notification
        $notify[] = ['success', $category->name . ' updated successfully'];
        return back()->withNotify($notify);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($uid)
    {
        //find category
        $category = Category::findByUid($uid);
        abort_if(!$category, 404);
        $category->delete();
        $notify[] = ['success', $category->name . ' deleted successfully'];
        return back()->withNotify($notify);

    }
}