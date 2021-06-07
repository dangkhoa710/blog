<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return $products;
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
        $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $product = new Product();
        $product['sku'] = substr(str_shuffle($permitted_chars), 0, 8);
        $product['branch_id'] = $request->branch_id;
        $product['name'] =   $request->name;
        $result = $product->save();
        if($result)
        {
            return response('Thành công', 201)
                ->header('Content-Type', 'json/application');
        }
        else
        {
            return response('Thất bại', 400)
                ->header('Content-Type', 'json/application');
        }
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
    public function update(Request $request)
    {
        $product = Product::find($request->id);
        $product['branch_id'] = $request->branch_id;
        $product['name'] =   $request->name;
        $result = $product->save();
        if($result)
        {
            return response('Cập nhật Thành công', 201)
                ->header('Content-Type', 'json/application');
        }
        else
        {
            return response('Cập nhật Thất bại', 400)
                ->header('Content-Type', 'json/application');
        }
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

    public function search(Request $request)
    {
        $product = Product::where('name','like',"%".$request->name."%")->get();
        return $product;
    }
}
