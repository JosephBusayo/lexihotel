<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // this will get all produc
        $products = Product::orderBy('category_id', 'ASC')->get();

        return view('admin/product/index', [
            'pageTitle' => 'All Products',
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warehouses = Warehouse::all();

        return view('admin/product/create', [
            'pageTitle' => 'Create Product',
            'warehouses' => $warehouses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $data = $request->validate([
            "warehouse" => ['required'],
            "name" => ['required'],
            "cost_price" => ['required'],
            "selling_price" => ['required'],
            "quantity" => ['required'],
            "status" => ['required'],
        ]);
        $data['status'] = ($data['status'] == 1) ? true : false;
        $data['uid'] = uniqid("PR");

        // save product
        Product::create($data);

        // redirect to product list
        $notify[] = ['success', 'Product created successfully'];
        return redirect()->route('admin.product.index')->with('notify', $notify);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //find
        $product = Product::findorfail($id);

        $warehouses = Warehouse::all();

        return view('admin/product/edit', [
            'pageTitle' => 'Edit Product: ' . $product->name,
            'warehouses' => $warehouses,
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //find
        $product = Product::findorfail($id);

        //validate
        $data = $request->validate([
            "warehouse" => ['required'],
            "name" => ['required'],
            "cost_price" => ['required'],
            "selling_price" => ['required'],
            "quantity" => ['required'],
            "status" => ['required'],
        ]);

        $data['status'] = ($data['status'] == 1) ? true : false;

        // save product
        $product->update($data);

        // redirect to product list
        $notify[] = ['success', 'Product updated successfully'];
        return redirect()->route('admin.product.index')->with('notify', $notify);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findorfail($id);

        $product->delete();

        $notify[] = ['success', 'Product deleted successfully'];

        return redirect()->back()->with('notify', $notify);
    }
}