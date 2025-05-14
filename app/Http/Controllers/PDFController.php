<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{

    public function export(){
        $dados = [
            'titulo' => 'Relatório de Tickets',
            'conteudo' => 'Esse é o conteúdo do PDF gerado.'
        ];

        $pdf = Pdf::loadView('pdf.exemplo', $dados);

        return $pdf->download('relatorio.pdf'); // ou ->stream() para exibir no navegador
    }

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
