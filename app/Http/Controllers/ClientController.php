<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::with(['user'])->get();
        return response()->json([
            'message' => 'Busca realizada com sucesso',
            'clients' => $clients
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
            'cpf' => ['required', 'min:11', 'max:14'],
            'phone' => ['required'],
            'birth' => ['required', 'date'],
        ]);

        $clients = new Client();

        $clients->name  = $request->name;
        $clients->cpf   = $request->cpf;
        $clients->phone = $request->phone;
        $clients->birth = $request->birth;        
        isset($request->address) ? $clients->address = $request->address : '';
        isset($request->photo)   ? $clients->photo   = $request->photo   : '';  
        isset($request->user_id) ? $clients->user_id = $request->user_id : '';

        $clients->save();
        return response()->json([
            'message' => 'Registrado com sucesso',
            'clients' => $clients
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
         $client = Client::find($id);
        if(!isset($client)) {
            return response()->json([
                'message' => 'Cliente não encontrado',
            ], 404);
        }
        return response()->json([
            'message' => 'Busca realizada com sucesso',
            'client' => $client
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
            'cpf' => ['min:11', 'max:14'],
            'birth' => ['date']
        ]);

        $client = Client::find($id);
        if(!isset($client)) {
            return response()->json([
                'message' => 'Cliente não encontrado',
            ], 404);
        }

        if (isset($request->name)) $client->name = $request->name;
        if (isset($request->cpf)) $client->cpf = $request->cpf;
        if (isset($request->phone)) $client->phone = $request->phone;
        if (isset($request->birth)) $client->birth = $request->birth;
        if (isset($request->address)) $client->address = $request->address;
        if (isset($request->photo)) $client->photo = $request->photo;
        if (isset($request->user_id)) $client->user_id = $request->user_id;
        
        $client->save();
        return response()->json([
            'message' => 'Alterado com sucesso.',
            'client' => $client
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
        $client = Client::find($id);
        if (!isset($client)) {
            return response()->json([
                'message' => 'Cliente não encontrado',
            ], 404);
        }
        try {
            $client->delete();
            return response()->json([
                'message' => 'Cliente deletado com sucesso',
            ], 202);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Não foi possível remover o produto selecionado.',
                'exception' => $e->getMessage(),
            ], 500);
        }
    }
}
