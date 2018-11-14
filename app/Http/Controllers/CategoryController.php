<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'message' => 'Busca realizada com sucesso',
            'categories' => $categories
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
            'name' => ['required', 'string', 'max:255'],
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return response()->json([
            'message' => 'Registrado com sucesso',
            'category' => $category
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
        $category = Category::find($id);
        if(!isset($category)) {
            return response()->json([
                'message' => 'Categoria não encontrada',
            ], 500);
        }
        return response()->json([
            'message' => 'Busca realizada com sucesso',
            'category' => $category
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
            'name' => ['required', 'string', 'max:255'],
        ]);
        $category = Category::find($id);
        if(!isset($category)) {
            return response()->json([
                'message' => 'Categoria não encontrada',
            ], 500);
        }
        $category->name = $request->name;
        $category->save();
        return response()->json([
            'message' => 'Alterado com sucesso.',
            'category' => $category
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
        $category = Category::find($id);
        if (!isset($category)) {
            return response()->json([
                'message' => 'Categoria não encontrada',
            ], 500);
        }
        try {
            $category->delete();
            return response()->json([
                'message' => 'Categoria deletada com sucesso',
            ], 202);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Não foi possível remover a categoria selecionada.',
                'exception' => $e->getMessage(),
            ], 500);
        }
    }
}
