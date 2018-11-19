<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shopping;
use App\Product;

class ShoppingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shoppings = Shopping::with(['products'])->get();
        if(!isset($shoppings)) {
            return response()->json([
                'message' => 'Nenhum pedido encontrado',
            ], 404);
        }
        return response()->json([
            'message' => 'Busca realizada com sucesso',
            'shoppings' => $shoppings
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
            'client_id' => ['required'],
            'products' => ['required', 'array'],
        ]);

        $shopping = new Shopping();

        $shopping->client_id  = $request->client_id;
        $shopping->date = now();

        $products = $request->products;
        $atach = [];       

        foreach($products as $product) {
            $productModel = Product::find($product['id']);
            if(!isset($productModel)) {
                continue;
            }

            $atach [$productModel->id] = [
               'quantity' => $product['quantity'],
               'unitary' => $productModel->price,
               'amount' => round(($productModel->price * $product['quantity']), 2),                
            ]; 
        }

        $shopping->save();

        if (count($atach)) {
            $shopping->products()->attach(
                $atach
            );
        }
        return response()->json([
            'message' => 'Registrado com sucesso',
            'shopping' => $shopping
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
        $shopping = Shopping::with(['products'])->find($id);
        if(!isset($shopping)) {
            return response()->json([
                'message' => 'Pedido não encontrado',
            ], 404);
        }
        return response()->json([
            'message' => 'Busca realizada com sucesso',
            'shopping' => $shopping
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
        return response()->json([
            'message' => 'Não implementado',
        ], 501);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shopping = Shopping::with(['products'])->find($id);
        if (!isset($shopping)) {
            return response()->json([
                'message' => 'Compra não encontrada',
            ], 404);
        }
        
        $shopping->products()->detach();
        
        try {
            $shopping->delete();
            return response()->json([
                'message' => 'Compra deletada com sucesso',
            ], 202);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Não foi possível remover o registro.',
                'exception' => $e->getMessage(),
            ], 500);
        }
    }
}
