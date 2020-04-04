<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::all();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'alias'=>'required',
            'brand'=>'required',
            //'provider'=>'required'
        ]);

        $products = new Products([
            'name' => $request->get('name'),
            'alias' => $request->get('alias'),
            'brand' => $request->get('brand'),
            'provider' => $request->get('provider'),
            'stock' => $request->get('stock'),
            'details' => $request->get('details')
            
        ]);
        $products->save();
        return redirect('/products')->with('success', '');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
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
        $product = Products::find($id);
        return view('products.edit', compact('product')); 
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
        $request->validate([
            'name'=>'required',
            'alias'=>'required',
            'brand'=>'required',
            //'provider'=>'required'
        ]);

        $product = Products::find($id);
        $product->id =  $id;
        $product->name =  $request->get('name');
        $product->alias = $request->get('alias');
        $product->brand = $request->get('brand');
        $product->provider = $request->get('provider');
        $product->stock = $request->get('stock');
        $product->details = $request->get('details');
        $product->save();

        return redirect('/products')->with('success', '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Products::find($id);
        $products->delete();

        return redirect('/products')->with('success', '');
    }
}
