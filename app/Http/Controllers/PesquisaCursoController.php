<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PesquisaCurso;

class PesquisaCursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            "name" => ['required', 'string'],
            "whatsapp" => ['required', 'string'],
            "question_1" => ['required', "string"],
            "question_2" => ['required', "string"],
            "question_3" => ['required', "string"],
            "question_4" => ['required', "string"],
            "question_5" => ['required', "string"],
            "question_6" => ['required', "string"],
            "id_user" => ['required', "integer", "exists:users,id_users"],
        ]);

        $storePesquisa = PesquisaCurso::create([
            "name" => $request->input("name"),
            "whatsapp" => $request->input("whatsapp"),
            "question_1" => $request->input("question_1"),
            "question_2" => $request->input("question_2"),
            "question_3" => $request->input("question_3"),
            "question_4" => $request->input("question_4"),
            "question_5" => $request->input("question_5"),
            "question_6" => $request->input("question_6"),
            "id_user" => $request->input("id_user"),
        ]);

        return response()->json([
            "status" => "201",
            "message" => "Formulário enviado com sucesso, obrigado por sua contribuição!",
            "data" => $storePesquisa
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = PesquisaCurso::with("user")->where("id_user", $id)->first();

        return response()->json([
            "data" => $response
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
