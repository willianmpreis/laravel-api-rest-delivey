<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

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
        return response()->json([
            'message' => 'Busca realizada com sucesso',
            'products' => $products
        ], 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            'message' => 'Não implementado',
        ], 501);
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
            'name' => ['required', 'string', 'max:255', 'unique:products'],
            'price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required','numeric', 'min:1'],
        ]);
        $product = new Product();
        $stock = isset($request->stock) ? $request->stock : '0';
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $stock;
        $product->category_id = $request->category_id;
        $product->save();
        return response()->json([
            'message' => 'Registrado com sucesso',
            'product' => $product
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if(!isset($product)) {
            return response()->json([
                'message' => 'Produto não encontrado',
            ], 500);
        }
        return response()->json([
            'message' => 'Busca realizada com sucesso',
            'product' => $product
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json([
            'message' => 'Não implementado',
        ], 501);
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
            'name' => ['string', 'max:255'],
            'price' => ['numeric', 'min:0'],
            'category_id' => ['numeric', 'min:1'],
        ]);

        $product = Product::find($id);
        if(!isset($product)) {
            return response()->json([
                'message' => 'Produto não encontrado',
            ], 500);
        }

        if (isset($request->name)) $product->name = $request->name;
        if (isset($request->price)) $product->price = $request->price;
        if (isset($request->stock)) $product->stock = $request->stock;
        if (isset($request->price)) $product->price = $request->price;
        if (isset($request->category_id)) $product->category_id = $request->category_id;
        
        $product->save();
        return response()->json([
            'message' => 'Alterado com sucesso.',
            'product' => $product
        ], 201);       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!isset($product)) {
            return response()->json([
                'message' => 'Produto não encontrado',
            ], 500);
        }
        try {
            $product->delete();
            return response()->json([
                'message' => 'Produto deletado com sucesso',
            ], 202);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Não foi possível remover o produto selecionado.',
                'exception' => $e->getMessage(),
            ], 500);
        }
    }
}
