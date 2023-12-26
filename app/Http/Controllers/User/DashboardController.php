<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = auth()->user();

        $products = Product::where('warehouse_id', $user->warehouse_id);

        $productCount = $products->count();

        return view('user/dashboard/index', [
            'pageTitle' => 'User Dashboard',
            'user' => $user,
            'products' => $products->get(),
            'productCount' => $productCount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dispatchProduct(Request $request, $id)
    {
        //find product by id
        $product = Product::findorfail($id);

        // validate quantity
        $data = $request->validate([
            'quantity' => ['required'],
            'name' => ['required'],
            'staff_id' => ['required'],
        ]);

        // check if quantity is not more
        if ($product->quantity < $data['quantity']) {
            // show error message and redirect back
            $notify[] = ['error', 'Dispatch quantity cannot be higher than quantity in warehouse '];
            return redirect()->back()->with('notify', $notify);
        }

        // deduce dispatch quntity from quantity
        $newQuantity = $product->quantity - $data['quantity'];

        // update the new quantity
        $product->quantity = $newQuantity;

        $product->save();

        // $table->string('uid');
        //     $table->string('staff_name');
        //     $table->string('staff_id');
        //     $table->string('product_id');
        //     $table->string('quantity');
        //     $table->string('amount');

        Transaction::create([
            'uid' => uniqid('TR'),
            'staff_name' => $data['name'],
            'user_id' => auth()->user()->id,
            'staff_id' => $data['staff_id'],
            'product_id' => $product->id,
            'quantity' => $data['quantity'],
            'amount' => $data['quantity'] * $product->selling_price,
        ]);

        // redirect back with success message
        $notify[] = ['success', 'Product dispatch successfully'];
        return redirect()->back()->with('notify', $notify);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function report()
    {
        //
        $user = auth()->user();

        $transactions = Transaction::where('user_id', $user->id)->get();

        return view('user/report/index', [
            'pageTitle' => 'User  Report',
            'user' => $user,
            'transactions' => $transactions,
        ]);

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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}